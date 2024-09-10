<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Corporate; 
use App\Models\Company;
use Carbon\Carbon;
class CorporateController extends Controller
{
    public function getCorporatePurchase()
    {
        $users = DB::table('users')->where('role','=','1')->get();
        $categories = DB::table('categories')->get(); 
        $subcat = DB::table('subcategories')->get();
        $company = Company::all();
        return view('admin.corporate',['users' => $users, 'categories' => $categories,'subcat' => $subcat,'company' =>$company]);
    } 
    public function doCorporatePurchase(Request $request)
    {
        $validator = Validator::make($request->all(), 
                [
            'company_id' => 'required',
            'centre_id' => 'required',
            'subcentre_id' => 'required',
            'contact_person' => 'required',
            'contact_mobile' => 'required|digits:10',
            'center_address' =>'required',
            'category_id' => 'required|exists:categories,category_id',
            'subcat_id' => 'required|exists:subcategories,subcat_id',
            'product_id' => 'nullable', 
            'located_on' =>'required|string',
            'purchased_from' =>'required|string',
            'filter_change_on' =>'required',
            'assigned_to' => 'required|string',
         
          
                ], 
                [
                    'company_id.required' => 'Company Name is required.',
                    'centre_id.required' => 'Center Name is required',
                    'subcentre_id.required' => 'Sub Center is required',
                    'contact_person.required' => 'Contact Person is required',
                    'contact_mobile.required' => 'Contact Mobile is required',
                    'contact_mobile.digits' => 'Mobile Number must be 10 digits',
                    'center_address.required' => 'Center Address is required',
                    'category_id.required' => 'Please select a Category',
                    'subcat_id.required' => 'Please select a Sub Category', 
                    'located_on.required' =>'Please select located on',
                    'purchased_from.required' =>'Please Select Purchased From',
                    'filter_change_on.required' =>'Please select Filter Change',
                    'assigned_to.required' => 'Staff name is required',
                ]);
    
        // Check if validation fails
        if ($validator->fails()) 
        {
            // Return validation errors as JSON
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()]);
        }  
        
        $data = [
            'company_name' =>$request->input('company_id'),
            'center_name' =>$request->input('centre_id'),
            'sub_center' =>$request->input('subcentre_id'),
            'contact_person' =>$request->input('contact_person'),
            'contact_mobile' =>$request->input('contact_mobile'),
            'center_address' =>$request->input('center_address'),
            'category_id' => $request->input('category_id'),
            'subcat_id' => $request->input('subcat_id'),
            'product_id' => $request->input('product_id'), 
            'located_on' =>$request->input('located_on'),
            'purchased_from' =>$request->input('purchased_from'),
            'filter_change_on' =>$request->input('filter_change_on'),
            'assigned_to' => $request->input('assigned_to'),
            'remarks' => $request->input('remarks'),      
        ];  
        if (DB::table('corporates')->insert($data))
        {
            return response()->json([
                'status' => 1,
                'message' => 'Company Purchase created successfully!',
            ]);
        }   
        else 
        {
            return response()->json([
                'status' => 2,
                'message' => 'Something went wrong!', 
            ]);
        }
    } 

    public function viewCorporatePurchase(Request $request)
    {
        if ($request->ajax()) {
            $companyPurchase = DB::table('corporates')
            ->join('companies','corporates.company_name','=','companies.company_id')
            ->join('centres','corporates.center_name','=','centres.centre_id')
            ->join('subcentres','corporates.sub_center','=','subcentres.subcentre_id')
            ->join('categories', 'corporates.category_id', '=', 'categories.category_id')
            ->join('subcategories','corporates.subcat_id','=','subcategories.subcat_id')
            ->join('products', 'corporates.product_id', '=', 'products.product_id')
            ->join('users','corporates.assigned_to','=','users.id')
            ->select('corporates.corporate_id','companies.company_name', 'corporates.center_address','centres.centre_name','subcentres.subcentre_name','corporates.contact_person','corporates.contact_mobile','corporates.purchased_from','corporates.filter_change_on','categories.category_name', 'subcategories.subcategory_name','products.product_name','corporates.located_on','users.name')
            ->get();        
            
            $totalRecords = count($companyPurchase); // Total records in your data source
            $filteredRecords = count($companyPurchase); // Number of records after applying filters
            $companyPurchase = $companyPurchase->map(function($item) {
                $item->filter_change_on = Carbon::parse($item->filter_change_on)->format('d-m-Y');
                return $item;
            });
    
            return response()->json(['draw' => request()->get('draw'),
                                    'recordsTotal' => $totalRecords,
                                     'recordsFiltered' => $filteredRecords,
                                      'data' => $companyPurchase]);
        }
        return response()->json(['error' => 'Invalid request'], 400);
   
    } 
    
    public function show($id)
    {
        $company = Corporate::findOrFail($id);
        $comid = $company->corporate_id;
        $companyPurchase = DB::table('corporates')
        ->join('companies','corporates.company_name','=','companies.company_id')
        ->join('centres','corporates.center_name','=','centres.centre_id')
        ->join('subcentres','corporates.sub_center','=','subcentres.subcentre_id')      
        ->join('categories', 'corporates.category_id', '=', 'categories.category_id')
        ->join('subcategories','corporates.subcat_id','=','subcategories.subcat_id')
        ->join('products', 'corporates.product_id', '=', 'products.product_id')
        ->join('users','corporates.assigned_to','=','users.id')
        ->select('corporates.corporate_id','companies.company_name', 'corporates.center_address','corporates.located_on','centres.centre_name','subcentres.subcentre_name','corporates.contact_person','corporates.contact_mobile','corporates.filter_change_on','categories.category_name', 'subcategories.subcategory_name','products.product_name','corporates.purchased_from','users.name')
        ->where('corporates.corporate_id','=',$comid)
        ->first();
        
        $companyPurchase->filter_change_on = Carbon::parse($companyPurchase->filter_change_on)->format('d-m-Y');
        return response()->json(['companyPurchase'=>$companyPurchase]);
    }

    public function edit($id)
    {
        $companyid = Corporate::findOrFail($id);
        $comid = $companyid->corporate_id;
        $company = DB::table('corporates')
        ->join('companies','corporates.company_name','=','companies.company_id')
        ->join('centres','corporates.center_name','=','centres.centre_id')
        ->join('subcentres','corporates.sub_center','=','subcentres.subcentre_id')     
        ->join('categories', 'corporates.category_id', '=', 'categories.category_id')
        ->join('subcategories','corporates.subcat_id','=','subcategories.subcat_id')
        ->join('products', 'corporates.product_id', '=', 'products.product_id')
        ->join('users','corporates.assigned_to','=','users.id')
        ->select('corporates.corporate_id','companies.company_name', 'companies.company_id','corporates.located_on','corporates.center_address','centres.centre_name','centres.centre_id','subcentres.subcentre_name','subcentres.subcentre_id','corporates.contact_person','corporates.purchased_from','corporates.contact_mobile','corporates.filter_change_on','categories.category_name', 'subcategories.subcategory_name','products.product_name','users.name')
        ->where('corporates.corporate_id','=', $comid)
        ->first();
        return response()->json($company);
    }

    public function update(Request $request, $id)
    { 

        $corporate = Corporate::findOrFail($id);

        try {
            // Update each field individually
            $corporate->company_name = $request->input('company_id');
            $corporate->center_name = $request->input('centre_id');
            $corporate->sub_center = $request->input('subcentre_id');
            $corporate->contact_person = $request->input('contact_person');
            $corporate->contact_mobile = $request->input('contact_mobile');
            $corporate->center_address = $request->input('center_address');
            $corporate->category_id = $request->input('category_id');
            $corporate->subcat_id = $request->input('subcat_id');
            $corporate->product_id = $request->input('product_id');
            $corporate->located_on = $request->input('located_on');
            $corporate->purchased_from = $request->input('purchased_from');
            $corporate->filter_change_on = $request->input('filter_change_on');
            $corporate->assigned_to = $request->input('assigned_to');
            $corporate->remarks = $request->input('remarks');
            
            // Save the updated model
            $corporate->save();
    
            // Return a JSON response indicating success
            return response()->json(['status' => 1, 'message' => 'Company updated successfully']);
        } catch (\Exception $e) {
            // Return a JSON response indicating failure
            return response()->json(['status' => 0, 'error' => ['message' => 'Company update failed']]);
        }
    
    }
    public function destroy($id)
    {
        try {
            Corporate::findOrFail($id)->delete();
            return response()->json(['status' => 1, 'message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => 'User deletion failed']);
        }
    }
    

}
