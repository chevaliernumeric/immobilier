<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function AdminDashboard(){
        return view('admin.index');
    }//fin de la methode

    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $notification = array(
            'message'=> 'Vous etes déconnecté avec succéss',
            'alert-type'=> 'success'
        );
        return redirect('/admin/login')->with($notification);
    }//fin de la methode

    public function Adminlogin(){
        return view('admin.admin_login');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile',compact('profileData'));
    }//end methode
    

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message'=> 'Votre profile a été mise en jour avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password',compact('profileData'));
    }//end method

    public function AdminUpdatePassword(Request $request){
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
