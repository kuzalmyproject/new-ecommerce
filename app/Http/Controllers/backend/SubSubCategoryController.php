<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use App\Models\Category;
use Image;
use Carbon\Carbon;

class SubSubCategoryController extends Controller
{
    public function SubSubCategoryView(){

       $subsubcategories = SubSubCategory::latest()->get();
       $categories = Category::orderBy('category_name','ASC')->get();
       return view('backend.category.subsubcategory_view',compact('subsubcategories','categories'));

    }

    public function subCategoryLoad($category_id){

        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);


    }

    public function SubSubCategoryLoad($subcategory_id){

        $subsubcat = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name','ASC')->get();

        return json_encode($subsubcat);


    }

    public function SubSubCategoryStore(Request $request)
    {    
        $validatedData = $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name' => 'required|string|max:255',
            
        ],[
            'category_id.required' => 'Please Select Relevent Category',
            'subsubcategory_name' => 'Input SubSubCategory English Name',
        ]);

        SubSubCategory::insert([

            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name_en,
            'subsubcategory_slug' => strtolower(str_replace(' ','-',$request->subsubcategory_name)),
         ]);


         $notification = array(
           'message' => 'New Sub-SubCategory Add Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('all.subsubcategory')->with($notification);

     }

    public function SubSubCategoryEdit($id){

        $subsubcategory = SubSubCategory::findorFail($id);
        $categories = Category::orderBy('category_name','ASC')->get();
        $subcategories = SubCategory::orderBy('subcategory_name','ASC')->get();
        return view('backend.category.subsubcategory_edit',compact('subsubcategory','categories','subcategories'));

     }

     public function SubSubCategoryUpdate(Request $request){

        $subsubcategory_id = $request->id;

        SubSubCategory::findorFail($subsubcategory_id)->update([
            
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name' => $request->subsubcategory_name_en,
            'subsubcategory_slug' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            
         ]);


         $notification = array(
           'message' => 'Sub-SubCategory Data Update Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('all.subsubcategory')->with($notification);


     }

     public function SubSubCategoryDelete($id){

        $subsubcategory = SubSubCategory::findorFail($id);

        SubSubCategory::findorFail($id)->delete();

        $notification = array(
           'message' => 'Sub-SubCategory deleted Successfully',
           'alert-type' => 'danger'
        );

        return redirect()->route('all.subsubcategory')->with($notification);
     }
}
