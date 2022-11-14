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
        return view('backend.category.category_view');


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
}
