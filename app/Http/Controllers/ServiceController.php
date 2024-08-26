<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Service;
use App\Models\ServiceHistory;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ServiceController extends Controller
{
    public function getServicePage()
    {

        return view('admin.service');
    } 
    
    public function viewServices(Request $request)
    {
        if ($request->ajax()) {
            // Subquery to get the latest service record for each individual
            $latestServiceSubquery = DB::table('services')
                ->select('customer_id', DB::raw('MAX(created_at) as latest_service_date'))
                ->groupBy('customer_id');
    
            // Fetch the latest service records for all individuals
            $recentServices = DB::table('services')
                ->joinSub($latestServiceSubquery, 'latest_services', function ($join) {
                    $join->on('services.customer_id', '=', 'latest_services.customer_id')
                         ->on('services.created_at', '=', 'latest_services.latest_service_date');
                })
                ->join('individuals', 'services.customer_id', '=', 'individuals.individual_id')
                ->join('installations', 'installations.customer_id', '=', 'services.customer_id')
                ->join('products', 'individuals.product_id', '=', 'products.product_id')
                ->select('services.*', 'individuals.p_name', 'individuals.mobile', 'products.product_name', 'installations.created_at as installation_date')
                ->whereIn('individuals.status', ['completed'])
                ->orderBy('services.created_at', 'desc') // Order by services.created_at in descending order
                ->get(); // Fetch all records
    
            return response()->json([
                'draw' => request()->get('draw'),
                'recordsTotal' => $recentServices->count(),
                'recordsFiltered' => $recentServices->count(),
                'data' => $recentServices // Return the data
            ]);
        }
    }
    
    public function details($id) {
        $service = Service::find($id);
    
        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }
    
        $custId = $service->customer_id; 
    
        // Fetch the data from the database for the specific customer_id
        $history = DB::table('services')
            ->join('individuals', 'services.customer_id', '=', 'individuals.individual_id')
            ->join('installations', 'installations.customer_id', '=', 'services.customer_id')
            ->join('products', 'individuals.product_id', '=', 'products.product_id')
            ->select('services.*', 'individuals.p_name', 'individuals.mobile', 'products.product_name', 'installations.created_at as installation_date')
            ->where('services.customer_id', $custId) // Filter by the specific customer_id
            ->where('individuals.status', 'completed')
            ->orderBy('services.created_at', 'desc') // Order by services.created_at in descending order
            ->get()
            ->map(function ($item) {
                // Format the dates as DD-MM-YYYY hh:mm A
                $item->created_at = Carbon::parse($item->created_at)->format('d-m-Y h:i A');
                $item->installation_date = Carbon::parse($item->installation_date)->format('d-m-Y h:i A');
                // Format nextService if it exists
                $item->nextService = isset($item->nextService) ? Carbon::parse($item->nextService)->format('d-m-Y') : 'N/A';
                return $item;
            });
    
        return response()->json(['history' => $history]);
    }
    

public function douserService(Request $request)
{
    // Create a new validator instance
    $validator = Validator::make($request->all(), [
        'tos' => 'required|string',
        'partsChanged' => 'required|array',
        'partsChanged.*' => 'exists:parts,parts_id',
        'nextService' => 'required_if:duration,null|date',
        'amount' => 'nullable|numeric',
        'remarks' => 'nullable|string',
        'customer_id' => 'required|exists:individuals,individual_id',
        'staff_id' => 'required|exists:users,id',
    ], [
        'tos.required' => 'Type of Service is required.',
        'partsChanged.required' => 'Parts changed is required',
        'nextService.required' => 'Next Service is required',
    ]);

    // Check if validation fails
    if ($validator->fails()) {
        // Return validation errors as JSON
        return response()->json([
            'status' => 0,
            'error' => $validator->errors()
        ]);
    }

    // Retrieve validated data
    $validatedData = $validator->validated();

    // Create a new instance of your model and assign values
    $service = new Service();
    $service->tos = $validatedData['tos'];
    $service->partsChanged = json_encode($validatedData['partsChanged']); // Convert array to JSON
    $service->nextService = $validatedData['nextService'];
    $service->amount = $validatedData['amount'];
    $service->remarks = $validatedData['remarks'];
    $service->customer_id = $validatedData['customer_id'];
    $service->staff_id = $validatedData['staff_id'];
    
    // Save the model instance to the database
    $service->save(); 


    // Return a success response
    return response()->json([
        'status' => 1,
        'message' => 'Service created successfully!',
    ]);
}


//add new parts by admin 
public function partsViewPage()
{
return view('admin.AddParts');
} 
public function doParts(Request $request)
{
    $validator = Validator::make($request->all(), [
        'parts_name' => 'required',
        
            ], 
            [
                'parts_name.required' => 'Parts name is required.',
               ]);

    // Check if validation fails
    if ($validator->fails()) {
        // Return validation errors as JSON
        return response()->json([
            'status' => 0,
            'error' => $validator->errors()]);
    }

    $data = [
        'parts_name' =>$request->input('parts_name'),
        'created_at' => Carbon::now(),  // Add current timestamp
        'updated_at' => Carbon::now(),

    ]; 
    if (DB::table('parts')->insert($data)) {
        return response()->json([
            'status' => 1,
            'message' => 'parts created successfully!',
        ]);
    } else {
        return response()->json([
            'status' => 2,
            'message' => 'Something went wrong!', 
        ]);
    }  
} 


//user service functions
public function getuserServicePage()
    {

        return view('user.servicebyUser');
    } 
    public function getuserParts()
    {
     $parts = Part::all();
     return response()->json([
        'status' =>1,
        'data' =>$parts,
     ]);
    } 
    public function viewuserServices(Request $request)
{
    if ($request->ajax()) {
        
        $insDetails = DB::table('individuals')
                      ->join('products','individuals.product_id','=','products.product_id')                                        
                      ->select('individuals.*','products.product_name')
                      ->whereIn('individuals.status', ['completed'])
                      ->get();
        $totalRecords = count($insDetails); // Total records in your data source
        $filteredRecords = count($insDetails); // Number of records after applying filters
   
        return response()->json(['draw' => request()->get('draw'),
                                'recordsTotal' => $totalRecords,
                                'recordsFiltered' => $filteredRecords,
                                'data' => $insDetails]);
    }
    return response()->json(['error' => 'Invalid request'], 400);
} 

public function getuserFixService(Request $request,$id)
{
    $stId = Auth::user()->id;
    if ($request->ajax()) { 
        $insDetails = DB::table('individuals')
            ->join('products', 'individuals.product_id', '=', 'products.product_id')
            ->join('installations','individuals.individual_id','=','installations.customer_id')
            ->where('individuals.individual_id', $id)
            ->select('individuals.*', 'products.product_name','installations.nextService')
            ->first();

        return response()->json(['insDetails'=>$insDetails,'staff_id'=>$stId]);
    }
} 
public function getPartsData(Request $request)
{
    if ($request->ajax()) {
        $parts = Part::select(['parts_id','parts_name'])->get();
        $totalRecords = count($parts); // Total records in your data source
        $filteredRecords = count($parts); // Number of records after applying filters
    
        return response()->json(['draw' => request()->get('draw'),
                                'recordsTotal' => $totalRecords,
                                 'recordsFiltered' => $filteredRecords,
                                  'data' => $parts]);
    }
    return response()->json(['error' => 'Invalid request'], 400);


} 
public function edit($id)
    {
        $parts = Part::findOrFail($id);
        return response()->json($parts);
    }
    public function update(Request $request, $id)
    {
        try {
            $user = Part::findOrFail($id);
            $user->update($request->all());
            return response()->json(['status' => 1, 'message' => 'Parts updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => ['message' => 'Parts update failed']]);
        }
    } 
    public function destroy($id)
    {
        try {
            Part::findOrFail($id)->delete();
            return response()->json(['status' => 1, 'message' => 'Parts deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => 'Parts deletion failed']);
        }

 } 
 public function getParts()
    {
     $parts = Part::all();
     return response()->json([
        'status' =>1,
        'data' =>$parts,
     ]);
    } 
}