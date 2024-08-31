<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Corporate;
use Carbon\Carbon;
class CorporateController extends Controller
{
    public function getCorporatePurchase()
    {
        $users = DB::table('users')->where('role','=','1')->get();
        $categories = DB::table('categories')->get(); 
        $subcat = DB::table('subcategories')->get();
        return view('admin.corporate',['users' => $users, 'categories' => $categories,'subcat' => $subcat]);
    } 
    public function doCorporatePurchase(Request $request)
    {
        $validator = Validator::make($request->all(), 
                [
            'company_name' => 'required|min:2',
            'center_name' => 'required',
            'sub_center' => 'required',
            'contact_person' => 'required',
            'contact_mobile' => 'required|digits:10',
            'center_address' =>'required',
            'category_id' => 'required|exists:categories,category_id',
            'subcat_id' => 'required|exists:subcategories,subcat_id',
            'product_id' => 'exists:products,product_id',
            'filter_change_on' =>'required',
            'assigned_to' => 'required|string',
         
          
                ], 
                [
                    'company_name.required' => 'Company Name is required.',
                    'company_name.min' => 'Name must be at least 2 characters.',
                    'center_name.required' => 'Center Name is required',
                    'sub_center.required' => 'Sub Center is required',
                    'contact_person.required' => 'Contact Person is required',
                    'contact_mobile.required' => 'Contact Mobile is required',
                    'contact_mobile.digits' => 'Mobile Number must be 10 digits',
                    'center_address.required' => 'Center Address is required',
                    'category_id.required' => 'Please select a Category',
                    'subcat_id.required' => 'Please select a Sub Category',
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
            'company_name' =>$request->input('company_name'),
            'center_name' =>$request->input('center_name'),
            'sub_center' =>$request->input('sub_center'),
            'contact_person' =>$request->input('contact_person'),
            'contact_mobile' =>$request->input('contact_mobile'),
            'center_address' =>$request->input('center_address'),
            'category_id' => $request->input('category_id'),
            'subcat_id' => $request->input('subcat_id'),
            'product_id' => $request->input('product_id'),
            'filter_change_on' =>$request->input('filter_change_on'),
            'assigned_to' => $request->input('assigned_to'),
            'remarks' => $request->input('remarks'),      
        ];  
        if (DB::table('corporates')->insert($data))
        {
            return response()->json([
                'status' => 1,
                'message' => 'Company created successfully!',
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
            ->join('categories', 'corporates.category_id', '=', 'categories.category_id')
            ->join('subcategories','corporates.subcat_id','=','subcategories.subcat_id')
            ->join('products', 'corporates.product_id', '=', 'products.product_id')
            ->join('users','corporates.assigned_to','=','users.id')
            ->select('corporates.corporate_id','corporates.company_name', 'corporates.center_address','corporates.center_name','corporates.sub_center','corporates.contact_person','corporates.contact_mobile','corporates.filter_change_on','categories.category_name', 'subcategories.subcategory_name','products.product_name','users.name')
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
        ->join('categories', 'corporates.category_id', '=', 'categories.category_id')
        ->join('subcategories','corporates.subcat_id','=','subcategories.subcat_id')
        ->join('products', 'corporates.product_id', '=', 'products.product_id')
        ->join('users','corporates.assigned_to','=','users.id')
        ->select('corporates.corporate_id','corporates.company_name', 'corporates.center_address','corporates.center_name','corporates.sub_center','corporates.contact_person','corporates.contact_mobile','corporates.filter_change_on','categories.category_name', 'subcategories.subcategory_name','products.product_name','users.name')
        ->where('corporates.corporate_id','=',$comid)
        ->first();
        $date =  $companyPurchase->filter_change_on;
        $formattedDate = Carbon::parse($date)->format('d-m-Y');
        return response()->json(['companyPurchase'=>$companyPurchase,'formattedDate'=>$formattedDate]);
    }

    public function edit($id)
    {

        $companyid = Corporate::findOrFail($id);
        $comid = $companyid->corporate_id;
        $company = DB::table('corporates')
        ->join('categories', 'corporates.category_id', '=', 'categories.category_id')
        ->join('subcategories','corporates.subcat_id','=','subcategories.subcat_id')
        ->join('products', 'corporates.product_id', '=', 'products.product_id')
        ->join('users','corporates.assigned_to','=','users.id')
        ->select('corporates.corporate_id','corporates.company_name', 'corporates.center_address','corporates.center_name','corporates.sub_center','corporates.contact_person','corporates.contact_mobile','corporates.filter_change_on','categories.category_name', 'subcategories.subcategory_name','products.product_name','users.name')
        ->where('corporates.corporate_id','=', $comid)
        ->first();
        return response()->json($company);
    }

    public function update(Request $request, $id)
    {
        try {
            $upid = Corporate::findOrFail($id);
            $upid->update($request->all());
            return response()->json(['status' => 1, 'message' => 'Company updated successfully']);
        } catch (\Exception $e) {
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
