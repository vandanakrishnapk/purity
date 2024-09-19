<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Individual;
use App\Models\Installation; 
use Carbon\Carbon;



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
            '3' => 'categories.category_name',
            '4' => 'subcategories.subcategory_name',
            '5' => 'individuals.created_at',
        ];

        // Base query
        $query = DB::table('individuals')
            ->join('products', 'individuals.product_id', '=', 'products.product_id')
            ->join('categories', 'categories.category_id', '=', 'individuals.category_id')
            ->join('subcategories', 'subcategories.subcat_id', '=', 'individuals.subcat_id')
            ->where('individuals.assigned_to', '=', $staffId)
            ->select('individuals.*', 'products.product_name', 'categories.category_name', 'subcategories.subcategory_name');

        // Apply search
        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('individuals.p_name', 'like', "%{$searchValue}%")
                      ->orWhere('products.product_name', 'like', "%{$searchValue}%")
                      ->orWhere('categories.category_name', 'like', "%{$searchValue}%")
                      ->orWhere('subcategories.subcategory_name', 'like', "%{$searchValue}%");
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
         // This may be optional if we set it later
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

    // Create a new Installation record
    $installation = new Installation();
    $installation->rawWater = $request->input('rawWater');
    $installation->sow = $request->input('sow'); // Mutator will handle JSON conversion
    $installation->nextService = $request->input('nextService');
    $installation->customer_id = $request->input('customer_id');
    $installation->staff_id = $request->input('staff_id');
    
    // Save the installation to get the created_at timestamp
    $installation->save();

    // Calculate the mainService date one year after the created_at timestamp
    $mainServiceDate = Carbon::parse($installation->created_at)->addYear();

    // Update the mainService field with the calculated date
    $installation->mainService = $mainServiceDate;
    $installation->save();

    // Update the status of the Individual
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
        // Get parameters for pagination, sorting, and search
        $start = $request->get('start'); // Pagination start
        $length = $request->get('length'); // Pagination length
        $searchValue = $request->get('search')['value']; // Search term
        $orderColumnIndex = $request->get('order')[0]['column']; // Column index to sort
        $orderDirection = $request->get('order')[0]['dir']; // Sort direction (asc/desc)

        // Build query
        $query = DB::table('individuals')
            ->join('products', 'individuals.product_id', '=', 'products.product_id')
            ->select('individuals.*', 'products.product_name')
            ->whereIn('individuals.status', ['Completed', 'Assigned']);

        // Apply search
        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('individuals.p_name', 'like', "%{$searchValue}%")
                      ->orWhere('individuals.mobile', 'like', "%{$searchValue}%")
                      ->orWhere('products.product_name', 'like', "%{$searchValue}%");
            });
        }

        // Get total records count (before applying pagination and search)
        $totalRecords = $query->count();

        // Apply sorting
        $columns = [ 'p_name', 'mobile', 'product_name', 'created_at', 'status', 'remarks']; // Column names
        if (isset($columns[$orderColumnIndex])) {
            $query->orderBy($columns[$orderColumnIndex], $orderDirection);
        }

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

}
