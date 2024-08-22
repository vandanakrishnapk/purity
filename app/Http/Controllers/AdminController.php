<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Individual; 
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    } 
   
    public function doIndividual(Request $request)
{
    $validator = Validator::make($request->all(), [
        'p_name' => 'required|string|max:255',
        'address' => 'required|string|max:500',
        'mobile' => 'required|string|max:15',
        'whatsapp' => 'required|string|max:15',
        'landmark' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,category_id',
        'subcat_id' => 'required|exists:subcategories,subcat_id',
        'product_id' => 'required|exists:products,product_id',
        'filter_change_on' =>'required',
        'assigned_to' => 'nullable|string|max:255',
        'remarks' => 'nullable|string|max:500',
    ], [
        'p_name.required' => 'Person name is required',
        'address.required' => 'Address is required',
        'mobile.required' => 'Mobile is required',
        'whatsapp.required' => 'WhatsApp is required',
        'landmark.required' => 'Landmark is required',
        'category_id.required' => 'Please select a category',
        'subcat_id.required' => 'Please select a category',
        'product_id.required' => 'Please select a category',
        'filter_change_on.required' =>'Please select Filter Change',
        'assigned_to.required' => 'Staff name is required',
        'remarks.required' => 'Please add remarks',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 0,
            'errors' => $validator->errors()
        ]);
    }

    $data = [
        'p_name' => $request->input('p_name'),
        'address' => $request->input('address'),
        'mobile' => $request->input('mobile'),
        'whatsapp' => $request->input('whatsapp'),
        'landmark' => $request->input('landmark'),
        'category_id' => $request->input('category_id'),
        'subcat_id' => $request->input('subcat_id'),
        'product_id' => $request->input('product_id'),
        'filter_change_on' =>$request->input('filter_change_on'),
        'assigned_to' => $request->input('assigned_to'),
        'remarks' => $request->input('remarks'),
        'created_at' => Carbon::now(),  // Add current timestamp
        'updated_at' => Carbon::now(),
    ];

    if (DB::table('individuals')->insert($data)) {
        return response()->json([
            'status' => 1,
            'message' => 'Purchase created successfully!',
        ]);
    } else {
        return response()->json([
            'status' => 2,
            'message' => 'Something went wrong!',
        ]);
    }
}
    public function viewIndividualPurchase()
    {
        
        $users = DB::table('users')->where('role','=','1')->get();
        $categories = DB::table('categories')->get(); 
        $subcat = DB::table('subcategories')->get();
        return view('admin.view_individual_purchase',['users' => $users, 'categories' => $categories,'subcat' => $subcat]);
    }
    public function viewIndividualData()
    {
        $purchase = DB::table('individuals')
        ->join('categories', 'individuals.category_id', '=', 'categories.category_id')
        ->join('subcategories','individuals.subcat_id','=','subcategories.subcat_id')
        ->join('products', 'individuals.product_id', '=', 'products.product_id')
        ->join('users','individuals.assigned_to','=','users.id')
        ->select('individuals.individual_id','individuals.p_name', 'individuals.address','individuals.mobile','individuals.whatsapp','individuals.landmark','categories.category_name', 'subcategories.subcategory_name','products.product_name','users.name','individuals.remarks')
        ->get();
        $totalRecords = count($purchase); // Total records in your data source
        $filteredRecords = count($purchase); // Number of records after applying filters
    
        return response()->json(['draw' => request()->get('draw'),
                                'recordsTotal' => $totalRecords,
                                 'recordsFiltered' => $filteredRecords,
                                  'data' => $purchase]);
        return response()->json(['error' => 'Invalid request'], 400);
    }  

    public function show($id)
    {
       
        $purchase = DB::table('individuals')
        ->join('categories', 'individuals.category_id', '=', 'categories.category_id')
        ->join('products', 'individuals.product_id', '=', 'products.product_id')
        ->join('users', 'individuals.assigned_to', '=', 'users.id')
        ->select('individuals.individual_id', 'individuals.p_name', 'individuals.address', 'individuals.mobile', 'individuals.whatsapp', 'individuals.landmark', 'categories.category_name', 'products.product_name', 'users.name', 'individuals.remarks')
        ->where('individuals.individual_id', $id)
        ->first();
        
    if ($purchase) {
       
        return response()->json($purchase);
    } else {
        return response()->json(['error' => 'Purchase not found'], 404);
    }
    }

    public function edit($id)
     {    
   
        $purchase = Individual::findOrFail($id);   

        return response()->json($purchase);
        
    } 
    public function update(Request $request)
    {
       $purchaseid = $request->purchase_edit;
    
            $Validator = Validator::make($request->all(),[
                'p_name' => 'required',
                'mobile'  => 'required',
            ],
            [
                'p_name.required' => 'Please select the name!',
            ]);

            if ($Validator->fails()) {
                return response()->json(['status'=>0,'error'=>$Validator->errors()]);
            } 
            else 
            {
               
            $query = DB::table('individuals')->where('individual_id','=',$purchaseid)->update([
                'p_name' =>$request->p_name,
                'address' =>$request->address,
                'mobile' =>$request->mobile,
                'whatsapp' =>$request->whatsapp,
                'landmark' =>$request->landmark,
                'category_id' =>$request->category_id,
                'product_id' =>$request->product_id,
                'assigned_to' =>$request->assigned_to,
                'remarks' =>$request->remarks,
                'subcat_id' =>$request->subcat_id,               

            ]);
            if($query)
            {

            return response()->json(['status' => 1, 'message' => 'purchase updated successfully']);
        } 
        else 
        {
            return response()->json(['status' => 0, 'error' => ['message' => 'purchase update failed']]);
        }
    } 
}

    public function productSelect(Request $request)
    {
        $html = '';
        $products = DB::table('products')
                        ->where('category_id','=',$request->category_id)
                        ->get();
        // $html .= '<option selected disabled>Open this select menu</option>';
            foreach ($products as $product) {
                $html .= '<option value="'.$product->product_id.'">'.$product->product_name.'</option>';
            }
        return response()->json(['html' => $html]);

    } 
    public function subcatSelect(Request $request)
    {
        $html = '';
        $subcats = DB::table('subcategories')
                        ->where('category_id','=',$request->category_id)
                        ->get();
        // $html .= '<option selected disabled>Open this select menu</option>';
            foreach ($subcats as $subcat) {
                $html .= '<option value="'.$subcat->subcat_id.'">'.$subcat->subcategory_name.'</option>';
            }
        return response()->json(['html' => $html]);

    }


    public function destroy($id)
    {
        try {
            Individual::findOrFail($id)->delete();
            return response()->json(['status' => 1, 'message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 0, 'error' => 'User deletion failed']);
        }
    } 
    
   public function getAddProduct()
   { 
    $categories = Category::all();
    return view('admin.AddProduct',compact('categories'));
   } 
   public function doAddCategory(Request $request)
   {
    $request->validate([
        'category' =>$request->category_name,
    ]);
    Category::create([
        'category_name' =>$request->category_name,
    ]);
    return response()->json([
        'status' =>1,
        'message' =>'category created successfully',
    ]);
   }
 public function doAddProduct(Request $request)
 { 
    $request->validate([
        'category_id' =>'required',
        'subcategoryId' =>'required',
        'product_name' =>'required',
        'remarks' =>'nullable',
    ]);
    Product::create([
        'category_id' =>$request->category_id,
        'subcategoryId' =>$request->subcategoryId,
        'product_name' =>$request->product_name,
        'remarks' =>$request->remarks,
    ]);
    return response()->json([
        'status' =>1,
        'message' =>'product added successfully',
    ]);
   
 } 
 public function getProductData(Request $request)
 {
     $purchase = DB::table('products')
         ->join('categories', 'products.category_id', '=', 'categories.category_id')
         ->join('subcategories', 'products.subcategoryId', '=', 'subcategories.subcat_id') // Assuming subcategory_id is the correct column name
         ->select('products.product_id', 'products.product_name','products.remarks', 'categories.category_name', 'subcategories.subcategory_name')
         ->get();
   
                       $totalRecords = count($purchase); // Total records in your data source
                       $filteredRecords = count($purchase); // Number of records after applying filters
                   
                       return response()->json(['draw' => request()->get('draw'),
                                               'recordsTotal' => $totalRecords,
                                                'recordsFiltered' => $filteredRecords,
                                                 'data' => $purchase]);
                       return response()->json(['error' => 'Invalid request'], 400);
               
 }
  public function datatable()
  {
    return view('admin.datatable');
  }
    
}