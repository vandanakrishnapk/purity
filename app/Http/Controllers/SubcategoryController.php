<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
class SubcategoryController extends Controller
{
    public function SubgetCategories()
    {
        $categories = Category::all();

        return response()->json($categories);
    } 

    public function subcategory()
    {
        return view('admin.subcategory');
    } 
  
    public function doSubcategory(Request $request)
    {
        
        $request->validate([
            'category_id' => 'nullable|exists:categories,category_id',
            'subcategory_name' => 'required|string|max:255',
        ]);

       $subcat = new Subcategory();
       $subcat->category_id =$request->category_id;
       $subcat->subcategory_name =$request->subcategory_name;
       $subcat->save();
        return response()->json(['message' => 'Subcategory submitted successfully']);
} 
     public function subcategoryChange($category_id)
     {
    $sub1 = DB::table('subcategories')->where('category_id',$category_id)->get();
    return response()->json($sub1);
     }
}
