<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentController extends Controller
{
    public function AgentDashboard(){
        return view('agent.index');
    }//Fin de la mehode

    public function AgentLogin(){
        return view('agent.agent_login');
    }
    //end method

    public function AgentRegister(Request $request){

        $user = User::created([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password'=> $request->password,
            'role'=> $request->agent,
            'status'=> $request->inactive
        ]);
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::AGENT);

    }// end method

    public function AgentLogout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $notification = array(
            'message'=> 'Vous etes déconnecté avec succéss',
            'alert-type'=> 'success'
        );
        return redirect('/agent/login')->with($notification);
    }//end method

    public function AgentProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('agent.agent_profile',compact('profileData'));
    }//end methode

    public function AgentProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/agent_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/agent_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message'=> 'Votre profile a été mise en jour avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }//end method

    public function AgentChangePassword(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('agent.agent_change_password',compact('profileData'));
    }//end method

    public function AgentUpdatePassword(Request $request){
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
