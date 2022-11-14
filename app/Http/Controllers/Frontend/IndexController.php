<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\MultiImg;
use Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){


         

         return view('frontend.index');
    }

    public function UserLogout(){

       Auth::logout();

       return redirect()->route('login');
    }

    public function UserProfile(){

        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile',compact('user'));
    }

        public function UserProfileUpdate(Request $request) {   

             $user_id=$request->id;

    
            $validatedData=$request->validate([
                'name'=>'required|string|max:255',
                'email'=>'required|string|max:255|email|unique:users,email,'.$user_id,
                'phone' => 'required|string|max:10'
                

                ]);


                $data=User::findOrFail($user_id);

                $data->email=$request->email;
                $data->name=$request->name;
                $data->phone=$request->phone;




                if($request->file('profile_photo_path')){

                    $file=$request->file('profile_photo_path');
                    @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
                    $filename=date('YmdHi').$file->getClientOriginalName();
                    $file->move(public_path('upload/user_images'),$filename);
                    $data['profile_photo_path'] = $filename;
        

                
                }

                 $data->save();

                 $notification=array(
                    'message' => 'User profile updated Successfully',
                    'alert-type' => 'success'
                 );

                 return redirect()->route('dashboard')->with($notification);
            }



public function UserPassword(){
 
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('frontend.profile.change_password',compact('user'));
}

public function UserPasswordChange(Request $request){

    $validatedData=$request->validate([

        
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        



    ]);

    $id = Auth::user()->id;


    $hashedpassword=Auth::user()->password;

    if(Hash::check($request->oldpassword,$hashedpassword)){

        $user=User::find($id);

        $user->password=Hash::make($request->password);
        $user->save();
        //Auth::logout();

        return redirect()->route('user.logout');
    }
    else{

        $notification=array(
            'message' => 'Please type your old password correcty',
            'alert-type' => 'error'
         );

         return redirect()->route('dashboard')->with($notification);
    }

}


 


 


    }


