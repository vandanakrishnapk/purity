<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Individual;
use App\Models\Installation;



class InstallationController extends Controller
{

    //user functions
    public function viewInstallation()
    {
        return view('user.Install');
    } 
    public function getInstallationData(Request $request)
    {
        if ($request->ajax()) {
            $staffId = Auth::user()->id;
            $insDetails = DB::table('individuals')
                          ->join('products','individuals.product_id','=','products.product_id')
                          ->join('categories','categories.category_id','=','individuals.category_id')
                          ->join('subcategories','subcategories.subcat_id','=','individuals.subcat_id')
                          ->where('individuals.assigned_to','=',$staffId)
                          ->select('individuals.*','products.product_name','categories.category_name','subcategories.subcategory_name')
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

    public function getInstallationbid(Request $request,$id)
    {
        $stId = Auth::user()->id;
        if ($request->ajax()) { 
            $insDetails = DB::table('individuals')
                ->join('products', 'individuals.product_id', '=', 'products.product_id')
                ->where('individuals.individual_id', $id)
                ->select('individuals.*', 'products.product_name')
                ->first();
    
            return response()->json(['insDetails'=>$insDetails,'staff_id'=>$stId]);
        }
} 

public function doInstallation(Request $request)
{
    $validator = Validator::make($request->all(), [
        'rawWater' => 'required|min:2',
        'sow' => 'required|array',
        'nextService' => 'required',
        'customer_id' =>'required',
        'staff_id' =>'required',
    ], 
    [
        'rawWater.required' => 'Raw Water is required.',
        'sow.required' => 'Source of Water is required',
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

    $installation = new Installation();
    $installation->rawWater = $request->input('rawWater');
    $installation->sow = $request->input('sow'); // Mutator will handle JSON conversion
    $installation->nextService = $request->input('nextService');
    $installation->customer_id = $request->input('customer_id');
    $installation->staff_id = $request->input('staff_id');
    
    $installation->save();
    $individual = Individual::find($request->input('customer_id'));
    if ($individual) {
        $individual->status = 'Completed'; // Update status as needed
        $individual->save();
    }

    return response()->json([
        'status' => 1,
        'message' => 'Installation done successfully!',
    ]);
}   


//admin functions 
public function getInstallationPage()
{
    return view('admin.installation');
}
public function getInstallations(Request $request)
{
    if ($request->ajax()) {
        
        $insDetails = DB::table('individuals')
                      ->join('products','individuals.product_id','=','products.product_id')                    
                      ->select('individuals.*','products.product_name')
                      ->whereIn('individuals.status', ['Completed', 'Assigned','Service_Completed'])
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

}
