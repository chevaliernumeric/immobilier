<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('frontend.index');
    }//end methode

    public function UserProfile(){
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.dashboard.edit_profile',compact('userData'));
    }//end methode

    public function UserProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message'=> 'Votre profile a été mise en jour avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }//end methode

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message'=> 'Vous etes déconnecté avec succéss',
            'alert-type'=> 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function UserChangePassword(){
        return view('frontend.dashboard.change_password');
    }//end method

    public function UserPasswordUpdate(Request $request){
        //validation
        $request->validate([
            'old_password'=> 'required',
            'new_password'=> 'required|confirmed'
        ]);
        //match l'ancien mot de passe
        if(!Hash::check($request->old_password,auth::user()->password)){
            $notification = array(
                'message'=> 'l\'ancien mot de passe ne corresponds pas',
                'alert-type'=> 'error'
            );
            return redirect()->back()->with($notification);
        }

        //update the new password
        User::whereId(auth()->user()->id)->update([
            'password'=> Hash::make($request->new_password)
        ]);
        $notification = array(
            'message'=> 'Mot de passe changer avec success',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }

}
