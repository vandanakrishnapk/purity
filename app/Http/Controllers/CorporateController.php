<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Corporate;
class CorporateController extends Controller
{
    public function getCorporatePurchase()
    {
        return view('admin.corporate');
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
                ], 
                [
                    'company_name.required' => 'Name is required.',
                    'company_name.min' => 'Name must be at least 2 characters.',
                    'center_name.required' => 'Center Name is required',
                    'sub_center.required' => 'Sub Center is required',
                    'contact_person.required' => 'Contact Person is required',
                    'contact_mobile.required' => 'Contact Mobile is required',
                    'contact_mobile.digits' => 'Mobile Number must be 10 digits',
                    'center_address.required' => 'Center Address is required',
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
            'company_name' =>$request->input('company_name'),
            'center_name' =>$request->input('center_name'),
            'sub_center' =>$request->input('sub_center'),
            'contact_person' =>$request->input('contact_person'),
            'contact_mobile' =>$request->input('contact_mobile'),
            'center_address' =>$request->input('center_address'),      
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
            $companyPurchase = Corporate::select(['corporate_id','company_name','center_name','sub_center','contact_person','contact_mobile','center_address',])->get();
            $totalRecords = count($companyPurchase); // Total records in your data source
            $filteredRecords = count($companyPurchase); // Number of records after applying filters
        
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
        return response()->json($company);
    }

    public function edit($id)
    {
        $company = Corporate::findOrFail($id);
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
