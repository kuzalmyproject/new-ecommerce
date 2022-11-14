<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;
use Carbon\Carbon;


class BrandController extends Controller
{
    public function BrandView(){

        $brands=Brand::latest()->get();
        return view('backend.brand.brand_view',compact('brands'));
    }

    public function BrandStore(Request $request){
 $validatedData=$request->validate([

'brand_name_en'=>'string|required|max:255',
'brand_image'=>'required'],
[
    'brand_image.required'=>'please upload an image',

 ]);
$data=new Brand;

$image=$request->file('brand_image');

$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
$save_url = 'upload/brand/'.$name_gen;

 $data->brand_name=$request->brand_name_en;
 $data->brand_slug	=strtolower(str_replace(' ','-',$request->brand_name_en));
$data->brand_image=$save_url;

$data->save();

$notification=array(
    'message' => 'Brand Inserted Succesfully!',
    'alert-type' => 'success'
 );

 return redirect()->route('brand.view')->with($notification);

  
    }


    Public function BrandEdit($id){
        $brand=Brand::findorFail($id);
        return view('backend.brand.brand_edit',compact('brand'));
    }

    public function BrandUpdate(Request $request){
        $validatedData=$request->validate([

        'brand_name_en'=>'required|string|max:255'],
        [
            'brand_name_en.required'=>'Please insert brand name',

        ]);



        $brand_id = $request->id;
        $old_image = $request->old_image;
        $data=Brand::findOrfail($brand_id);


        if($request->file('brand_image')){
  @unlink($old_image);

  $image=$request->brand_image;

  $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

  Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
  $save_url = 'upload/brand/'.$name_gen;

$data->brand_name=$request->brand_name_en;
$data->brand_slug	=strtolower(str_replace(' ','-',$request->brand_name_en));
$data->brand_image=$save_url;
$data->save();
$notification = array(
    'message' => 'Brand Data Update Successfully',
    'alert-type' => 'info'
 );

 return redirect()->route('brand.view')->with($notification);
        

}
else{
    $data->brand_name=$request->brand_name_en;
    $data->brand_slug	=strtolower(str_replace(' ','-',$request->brand_name_en));

$data->save();

$notification=array(
'message'=>'Brand Data updated Without Image',
'alert-type'=>'warning'


);
return redirect()->route('brand.view')->with($notification);

}

    }

    public function BrandDelete($id){
$brand=Brand::findOrfail($id);

$image=$brand->brand_image;
@unlink($image);

Brand::findorFail($id)->delete();



$notification = array(
    'message' => 'Brand deleted Successfully',
    'alert-type' => 'danger'
 );

 return redirect()->route('brand.view')->with($notification);
    }


}
