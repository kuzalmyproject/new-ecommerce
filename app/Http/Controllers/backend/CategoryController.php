<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function CategoryView(){

        $categories= Category::latest()->get();
        return view('backend.category.category_view',compact('categories'));


    }

    public function CategoryStore(Request $request){
        $validatedData=$request->validate([

            'category_name'=>'required|string|min:3',
            'category_image'=>'required|mimes:jpg,bmp,png'],
            [

           'category_name.required'=>'please enter category name',
           'category_image.mimes'=>'please enter the correct format',

            ]);

            $data=new Category();
            $image=$request->file('category_image');
            $namegen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
           Image::make($image)->resize(300,300)->save('upload/category/'.$namegen);
            $image_url='upload/category/'.$namegen;

            $data->category_name=$request->category_name;
            $data->category_slug=strtolower(str_replace('','-',$request->category_name));
            $data->category_image=$image_url;

            $data->save();

            $notification=array(

                'message' => 'Category Inserted Succesfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('category.view')->with($notification);


    }

    public function CategoryEdit($id){
        $category=Category::findOrfail($id);

        return view('backend.category.category_edit',compact('category'));

    }

    public function CategoryUpdate(Request $request){

        $validatedData=$request->validate([

            'category_name'=>'required|string|min:3',
            'category_image'=>'mimes:jpg,bmp,png'],
            [

           'category_name.required'=>'please enter category name',
           'category_image.mimes'=>'please enter the correct format',

            ]);


            $data=Category::findOrfail($request->id);
            $old_image = $request->old_image;

            if($request->file('category_image')){
                @unlink($old_image);

                $image=$request->category_image;
                $namegen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

                Image::make($image)->resize(300,300)->save('upload/category/'.$namegen);
                $save_url = 'upload/category/'.$namegen;


                $data->category_name=$request->category_name;
                $data->category_slug=strtolower(str_replace('','-',$request->category_name));
                $data->category_image=$save_url;

                $data->save();

                $notification=array(
                    'message' => 'Category Updated Successfully',
            'alert-type' => 'info'
         );
        
         return redirect()->route('category.view')->with($notification);


            


            }

            else{

                $data->category_name=$request->category_name;
                $data->category_slug=strtolower(str_replace('','-',$request->category_name));
                $data->save();

                $notification=array(
                    'message' => 'Category Updated Without image',
            'alert-type' => 'warning'
         );
        
         return redirect()->route('category.view')->with($notification);





            }
    }
    public function CategoryDelete($id){

        $category=Category::findOrfail($id);

        $image=$category->category_image;
        @unlink($image);

$category->subcategory()->delete();
$category->subsubcategory()->delete();

$category->delete();
        $notification=array(
            'message' => 'Category deleted Successfully',
    'alert-type' => 'danger'
 );

 return redirect()->route('category.view')->with($notification);
    
        
        
    }
}
