<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Service;
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
        
        $insDetails = DB::table('individuals')
                      ->join('products','individuals.product_id','=','products.product_id') 
                      ->join('installations','individuals.individual_id','=','installations.customer_id')                   
                      ->select('individuals.*','products.product_name','installations.nextService')
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

public function getFixService(Request $request,$id)
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






public function doService(Request $request)
{
   
    $validator = Validator::make($request->all(), [
        'tos' => 'required',
        'partsChanged' => 'required',
        'nextService' => 'required',
    ], 
    [
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
    $service =new Service;
    $service->tos =$request->input('tos');
    $service->partsChanged = $request->input('partsChanged');
    $service->nextService = $request->input('nextService');
    $service->save();

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
                      ->join('installations','individuals.individual_id','=','installations.customer_id')                   
                      ->select('individuals.*','products.product_name','installations.nextService')
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