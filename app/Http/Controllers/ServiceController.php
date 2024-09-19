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
use App\Models\User;
use App\Models\Installation;
use App\Models\Individual;
use Illuminate\Support\Facades\Log;
class ServiceController extends Controller
{ 

//admin functions
    public function getServicePage()
    {

        return view('admin.service');
    }   

    public function viewServices(Request $request)
{
    if ($request->ajax()) {
        // Get parameters for pagination, sorting, and search
        $start = $request->get('start'); // Pagination start
        $length = $request->get('length'); // Pagination length
        $searchValue = $request->get('search')['value']; // Search term
        $orderColumnIndex = $request->get('order')[0]['column']; // Column index to sort
        $orderDirection = $request->get('order')[0]['dir']; // Sort direction (asc/desc)

        // Subquery to get the latest service record for each individual
        $latestServiceSubquery = DB::table('services')
            ->select('customer_id', DB::raw('MAX(created_at) as latest_service_date'))
            ->groupBy('customer_id');  

        // Build query
        $query = DB::table('services')
            ->joinSub($latestServiceSubquery, 'latest_services', function ($join) {
                $join->on('services.customer_id', '=', 'latest_services.customer_id')
                     ->on('services.created_at', '=', 'latest_services.latest_service_date');
            })
            ->join('individuals', 'services.customer_id', '=', 'individuals.individual_id')
            ->join('installations', 'installations.customer_id', '=', 'services.customer_id')
            ->join('products', 'individuals.product_id', '=', 'products.product_id')
            ->join('users', 'services.staff_id', '=', 'users.id')
            ->select('services.*', 'services.status as serviceStatus', 'individuals.p_name', 'individuals.mobile', 'individuals.remarks', 'products.product_name', 'installations.created_at as installation_date', 'users.name')
            ->whereIn('individuals.status', ['Completed', 'Service_Completed']);

        // Apply search
        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('individuals.p_name', 'like', "%{$searchValue}%")
                      ->orWhere('individuals.mobile', 'like', "%{$searchValue}%")
                      ->orWhere('products.product_name', 'like', "%{$searchValue}%")
                      ->orWhere('services.status', 'like', "%{$searchValue}%")
                      ->orWhere('users.name', 'like', "%{$searchValue}%");
            });
        }

        // Get total records count (before applying pagination and search)
        $totalRecords = $query->count();

        // Apply sorting
        $columns = ['services.serviceId', 'individuals.p_name', 'individuals.mobile', 'products.product_name', 'installations.created_at', 'services.created_at', 'services.next_service_date', 'users.name', 'services.status', 'individuals.remarks']; // Column names
        if (isset($columns[$orderColumnIndex])) {
            $query->orderBy($columns[$orderColumnIndex], $orderDirection);
        }

        // Apply pagination
        $recentServices = $query->offset($start)->limit($length)->get();

        // Get filtered records count (after applying search)
        $filteredRecords = $query->count();

        return response()->json([
            'draw' => $request->get('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $recentServices
        ]);
    }

    return response()->json(['error' => 'Invalid request'], 400);
}

    
    // public function viewServices(Request $request)
    // {
    //     if ($request->ajax()) {
    //         // Subquery to get the latest service record for each individual
    //         $latestServiceSubquery = DB::table('services')
    //             ->select('customer_id', DB::raw('MAX(created_at) as latest_service_date'))
    //             ->groupBy('customer_id');
    
    //         // Fetch the latest service records for all individuals
    //         $recentServices = DB::table('services')
    //             ->joinSub($latestServiceSubquery, 'latest_services', function ($join) {
    //                 $join->on('services.customer_id', '=', 'latest_services.customer_id')
    //                      ->on('services.created_at', '=', 'latest_services.latest_service_date');
    //             })
    //             ->join('individuals', 'services.customer_id', '=', 'individuals.individual_id')
    //             ->join('installations', 'installations.customer_id', '=', 'services.customer_id')
    //             ->join('products', 'individuals.product_id', '=', 'products.product_id')
    //             ->join('users','services.staff_id','=','users.id')
    //             ->select('services.*', 'services.status as serviceStatus','individuals.p_name', 'individuals.mobile','individuals.remarks', 'products.product_name','installations.created_at as installation_date','users.name')
    //             ->whereIn('individuals.status', ['Completed','Service_Completed'])
    //             ->orderBy('services.created_at', 'desc') // Order by services.created_at in descending order
    //             ->get(); // Fetch all records
           
    //         return response()->json([
    //             'draw' => request()->get('draw'),
    //             'recordsTotal' => $recentServices->count(),
    //             'recordsFiltered' => $recentServices->count(),
    //             'data' => $recentServices // Return the data
    //         ]);
    //     }
    // }
    
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
            ->where('individuals.status', 'Service_Completed','Completed')
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
        'status' =>'required|string',
        'staff_id' => 'required|exists:users,id',
    ], [
        'tos.required' => 'Type of Service is required.',
        'partsChanged.required' => 'Parts changed is required',
        'nextService.required' => 'Next Service is required',
        'status.required' =>'Status is required',
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
    $service->status = $validatedData['status'];
    $service->remarks = $validatedData['remarks'];
    $service->customer_id = $validatedData['customer_id'];
    $service->staff_id = $validatedData['staff_id'];  
    $service->save(); 
    $individual = Individual::find($request->input('customer_id'));
    if($service->status == 'Completed' && $individual) 
    { 
        $individual->status = 'Service_Completed'; // Update status as needed
        $individual->save();
    }
    
    // Save the model instance to the database
 


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
    if ($validator->fails()) 
     {
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
            'message' => 'Parts created successfully!',
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
        $staffId = Auth::user()->id;

        // Extract parameters for pagination, sorting, and search
        $start = $request->get('start'); // Pagination start (offset)
        $length = $request->get('length'); // Pagination length (limit)
        $searchValue = $request->get('search')['value']; // Search term
        $orderColumnIndex = $request->get('order')[0]['column']; // Column index to sort
        $orderDirection = $request->get('order')[0]['dir']; // Sort direction (asc/desc)

        // Define column names for sorting
        $columns = [
            '0' => 'individuals.individual_id',
            '1' => 'individuals.p_name',
            '2' => 'products.product_name',
            '3' => 'individuals.status',
            '4' => 'individuals.created_at',
        ];

        // Base query
        $query = DB::table('individuals')
            ->join('products', 'individuals.product_id', '=', 'products.product_id')
            ->select('individuals.*', 'products.product_name')
            ->where('individuals.assigned_to', '=', $staffId)
            ->whereIn('individuals.status', ['Completed']);

        // Apply search
        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('individuals.p_name', 'like', "%{$searchValue}%")
                      ->orWhere('products.product_name', 'like', "%{$searchValue}%")
                      ->orWhere('individuals.status', 'like', "%{$searchValue}%");
            });
        }

        // Apply sorting
        if (isset($columns[$orderColumnIndex])) {
            $query->orderBy($columns[$orderColumnIndex], $orderDirection);
        }

        // Get total records count (before applying pagination and search)
        $totalRecords = $query->count();

        // Apply pagination
        $insDetails = $query->offset($start)->limit($length)->get();

        // Get filtered records count (after applying search)
        $filteredRecords = $query->count();

        return response()->json([
            'draw' => $request->get('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $insDetails
        ]);
    }

    return response()->json(['error' => 'Invalid request'], 400);
}

    // public function viewuserServices(Request $request)
    // { 
    //      $staffId = Auth::user()->id;
    //     if ($request->ajax()) {
        
    //         $insDetails = DB::table('individuals')
    //                       ->join('products','individuals.product_id','=','products.product_id')                                        
    //                       ->select('individuals.*','products.product_name')
    //                       ->where('individuals.assigned_to','=',$staffId)
    //                       ->whereIn('individuals.status', ['Completed'])
    //                       ->get();
    //         $totalRecords = count($insDetails); // Total records in your data source
    //         $filteredRecords = count($insDetails); // Number of records after applying filters
       
    //         return response()->json(['draw' => request()->get('draw'),
    //                                 'recordsTotal' => $totalRecords,
    //                                 'recordsFiltered' => $filteredRecords,
    //                                 'data' => $insDetails]);
    //     }
    //     return response()->json(['error' => 'Invalid request'], 400);
    // } 
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



//admin functions 
public function getPartsData(Request $request)
{
    if ($request->ajax()) {
        // Retrieve parameters from DataTables
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $searchValue = $request->get('search')['value'];
        $orderColumn = $request->get('order')[0]['column'];
        $orderDir = $request->get('order')[0]['dir'];

        $partsQuery = Part::select(['parts_id', 'parts_name']);

        // Apply search filter
        if (!empty($searchValue)) {
            $partsQuery->where('parts_name', 'like', "%{$searchValue}%");
        }

        // Apply sorting
        $columns = ['parts_id', 'parts_name'];
        if (isset($columns[$orderColumn])) {
            $partsQuery->orderBy($columns[$orderColumn], $orderDir);
        }

        // Total records without filtering
        $totalRecords = $partsQuery->count();

        // Apply pagination
        $parts = $partsQuery->offset($start)->limit($length)->get();

        // Filtered records count
        $filteredRecords = $partsQuery->count();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $parts
        ]);
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


   
    public function changeStaff($id)
    {
        $service = Service::find($id); 
        $users = User::where('role','=',1)->get(); // Get all users
        
        return response()->json([
            'serviceId' => $service->serviceId,
            'currentStaff' => $service->staff_id, // Adjust based on your relationship
            'users' => $users
        ]);
    } 

    public function updateStaff(Request $request,$serviceId)
    {
        $request->validate([
            'assigned_to' => 'required|exists:users,id',
            'customer_id' => 'required' // Validate customer ID if needed
        ]);
    
       // You may need to pass service_id too
        $customerId = $request->input('customer_id');
    
        // Find and update the Service model
        $service = Service::find($serviceId);
        if (!$service) {
            return response()->json(['status' => 0, 'message' => 'Service not found'], 404);
        }
        $service->staff_id = $request->input('assigned_to');
        $service->save();
    
        // Find and update the Individual model
        $individual = Individual::where('individual_id', $customerId)->first();
        if (!$individual) {
            return response()->json(['status' => 0, 'message' => 'Individual not found'], 404);
        }
        $individual->assigned_to = $request->input('assigned_to');
        $individual->status ='Completed';
        $individual->save();
    
        return response()->json(['status' => 1, 'message' => 'Staff updated successfully']);
    }
    

    //change next service view 
    public function changeNextService($id)
    {
        $service = Service::find($id);
             
        return response()->json([
            'serviceId' => $service->serviceId,
            'currentnextService' => $service->nextService, // Adjust based on your relationship
            
        ]);
    } 

    //update next service 

    public function updateNextService(Request $request,$id)
    {
    
        $request->validate([
         
            'nextService' => 'required', // Assuming 'users' is the table for staff
        ]);

        // Find the service by ID
        $service = Service::find($id);

        // Update the assigned staff
    
        
        $service->nextService = $request->input('nextService'); // Adjust field names as needed
        
        $service->save(); // Save changes to the database

        // Return a success response
        return response()->json(['status' => 1, 'message' => 'Next Service updated successfully']);
    
         
    } 


    //service due section 
   
}