<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    
    public function getCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    public function getProductsBySubCategory($id)
{
    $products = Product::where('subcategoryId', $id)->get();
    return response()->json($products);
}

public function edit($id)
{      
   $pro = DB::table('products')
   ->join('categories','categories.category_id','=','products.category_id')
   ->join('subcategories','subcategories.subcat_id','=','products.subcategoryId')
   ->select('products.*','categories.*','subcategories.*')
   ->where('products.product_id','=',$id)
   ->first();

   return response()->json($pro);
   
} public function update(Request $request)
{
    $productid = $request->product_id;

    // Validate incoming data
    $validator = Validator::make($request->all(), [
        'category_id' => 'required',
    ], [
        'category_id.required' => 'Category name is required',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 0, 'error' => $validator->errors()]);
    } else {
        // Update product in the database
        $query = DB::table('products')->where('product_id', $productid)->update([
            'category_id' => $request->category_id,
            'subcategoryId' => $request->subcategoryId, // Make sure this field exists in your table
            'product_name' => $request->product_name,
            'remarks' =>$request->remarks,
        ]);

        if ($query) {
            return response()->json(['status' => 1, 'message' => 'Product updated successfully']);
        } else {
            return response()->json(['status' => 0, 'error' => ['message' => 'Product update failed']]);
        }
    }
}

public function destroy($id)
{
    try {
        Product::findOrFail($id)->delete();
        return response()->json(['status' => 1, 'message' => 'Product deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['status' => 0, 'error' => 'Product deletion failed']);
    }
} 


}
