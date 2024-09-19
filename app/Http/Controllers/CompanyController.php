<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Company;
use App\Models\Centre; 
use App\Models\Subcentre; 
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function getsubcentreView()
    { 
        $company = Company::all();

        return view('admin.subcentres',['company' =>$company]);
    } 

    public function getcentres(Request $request)
    {
        $html = '';
        $centres = DB::table('centres')
                        ->where('company_id','=',$request->company_id)
                        ->get(); 
                       
        $html .= '<option selected disabled>Select Centre</option>';
            foreach ($centres as $centre) {
                $html .= '<option value="'.$centre->centre_id.'">'.$centre->centre_name.'</option>';
            }
        return response()->json(['html' => $html]);

    }  

    
    public function getsubcentres(Request $request)
    {
        $html = '';
        $subcentres = DB::table('subcentres')
                        ->where('centre_id','=',$request->centre_id)
                        ->get(); 
                       
        $html .= '<option selected disabled>Select Sub Centre</option>';
            foreach ($subcentres as $subcentre) {
                $html .= '<option value="'.$subcentre->subcentre_id.'">'.$subcentre->subcentre_name.'</option>';
            }
        return response()->json(['html' => $html]);

    } 

    public function getCompanies()
    {
        $companies = Company::all();

        return response()->json($companies);
    }  

    public function doCentres(Request $request)
    {
        $request->validate([
            'company_id' => 'nullable|exists:companies,company_id',
            'centre_name' => 'required|string|max:255',
        ]);

      $centre = new Centre();
      $centre->company_id =$request->company_id;
      $centre->centre_name =$request->centre_name;
      $centre->save();
        return response()->json(['message' => 'Centre submitted successfully']);

    } 

    public function doCompany(Request $request)
    {
     $request->validate([
        'company_name' =>'required',
     ]);
     Company::create([
         'company_name' =>$request->company_name,
     ]);
     return response()->json([
         'status' =>1,
         'message' =>'Company created successfully',
     ]);
    } 

    public function doSubcentre(Request $request)
    {
        $request->validate([
            'company_id' =>'required|Integer',
            'centre_id' =>'required|Integer',
            'subcentre_name' =>'required|string',
            'remarks' =>'nullable|string',
        ]);

   $data =     Subcentre::create([
            'company_id' =>$request->company_id,
            'centre_id' =>$request->centre_id,
            'subcentre_name' =>$request->subcentre_name,
            'remarks' =>$request->remarks,
        ]);
        if ($data)
        {
            return response()->json([
                'status' => 1,
                'message' => 'Sub Centre created successfully!',
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

    public function getsubcentreData(Request $request)
{
    if ($request->ajax()) {
        // Extract parameters from the request
        $start = $request->get('start'); // Pagination start (offset)
        $length = $request->get('length'); // Pagination length (limit)
        $searchValue = $request->get('search')['value']; // Search term
        $orderColumnIndex = $request->get('order')[0]['column']; // Column index to sort
        $orderDirection = $request->get('order')[0]['dir']; // Sort direction (asc/desc)

        // Define column names for sorting
        $columns = [
            '0' => 'subcentres.subcentre_id',
            '1' => 'subcentres.subcentre_name',
            '2' => 'subcentres.remarks',
            '3' => 'companies.company_name',
            '4' => 'centres.centre_name',
        ];

        // Base query
        $query = DB::table('subcentres')
            ->join('companies', 'subcentres.company_id', '=', 'companies.company_id')
            ->join('centres', 'subcentres.centre_id', '=', 'centres.centre_id')
            ->select('subcentres.subcentre_id', 'subcentres.subcentre_name', 'subcentres.remarks', 'companies.company_name', 'centres.centre_name');

        // Apply search
        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('subcentres.subcentre_name', 'like', "%{$searchValue}%")
                      ->orWhere('subcentres.remarks', 'like', "%{$searchValue}%")
                      ->orWhere('companies.company_name', 'like', "%{$searchValue}%")
                      ->orWhere('centres.centre_name', 'like', "%{$searchValue}%");
            });
        }

        // Apply sorting
        if (isset($columns[$orderColumnIndex])) {
            $query->orderBy($columns[$orderColumnIndex], $orderDirection);
        }

        // Get total records count (before applying pagination and search)
        $totalRecords = $query->count();

        // Apply pagination
        $subcentres = $query->offset($start)->limit($length)->get();

        // Get filtered records count (after applying search)
        $filteredRecords = $query->count();

        return response()->json([
            'draw' => $request->get('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $subcentres
        ]);
    }

    return response()->json(['error' => 'Invalid request'], 400);
}


    // public function getsubcentreData(Request $request)
    // {
    //     $sub = DB::table('subcentres')
    //      ->join('companies', 'subcentres.company_id', '=', 'companies.company_id')
    //      ->join('centres', 'subcentres.centre_id', '=', 'centres.centre_id') // Assuming subcategory_id is the correct column name
    //      ->select('subcentres.subcentre_id', 'subcentres.subcentre_name','subcentres.remarks', 'companies.company_name', 'centres.centre_name')
    //      ->get();
   
    //                    $totalRecords = count($sub); // Total records in your data source
    //                    $filteredRecords = count($sub); // Number of records after applying filters
                   
    //                    return response()->json(['draw' => request()->get('draw'),
    //                                            'recordsTotal' => $totalRecords,
    //                                             'recordsFiltered' => $filteredRecords,
    //                                              'data' => $sub]);
    //                    return response()->json(['error' => 'Invalid request'], 400);
        
    // } 

    public function editSubcentre($id)
    {
        $editId = Subcentre::find($id);
       
$sid = $editId->subcentre_id;
$sub = DB::table('subcentres')
        ->join('companies','companies.company_id','=','subcentres.company_id')
        ->join('centres','centres.centre_id','=','subcentres.centre_id')
        ->select('companies.company_name','companies.company_id','centres.centre_name','centres.centre_id','subcentres.subcentre_name','subcentres.subcentre_id')
        ->where('subcentre_id','=',$sid)
        ->first();
        return response()->json([
            'data'=>$sub,
          
        ]);

    }  

    public function updateSubcentre(Request $request)
{
    $request->validate([
        'company_id' => 'required|integer',
        'centre_id' => 'required|integer',
        'subcentre_name' => 'required|string|max:255',
        'remarks' => 'nullable',
    ]);
   $id = $request->input('subcentre_id');
    $subcentre = Subcentre::findOrFail($id);
    $subcentre->company_id = $request->input('company_id');
    $subcentre->centre_id = $request->input('centre_id');
    $subcentre->subcentre_name = $request->input('subcentre_name');
    $subcentre->remarks = $request->input('remarks');
    $subcentre->save();

    return response()->json([
        'status' =>1,
        'success' => true, 
        'message' => 'Subcentre updated successfully']);
} 

public function deleteSubcentre($id)
{
    try {
        Subcentre::findOrFail($id)->delete();
        return response()->json(['status' => 1, 'message' => 'Subcentre deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['status' => 0, 'error' => 'Subcentre deletion failed']);
    }
} 

}
