<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use PhpParser\Builder\Property;

class PropertyTypeController extends Controller
{
    public function AllType(){
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type',compact('types'));
    }//end methode

    public function AddType(){
        return view('backend.type.add_type');
    }//end methode

    public function StoreType(Request $request){
        //validate
        $request->validate([
            'type_name'=>'required|unique:property_types|max:200',
            'type_icon'=> 'required'
        ]);
        PropertyType::insert([
            'type_name'=>$request->type_name,
            'type_icon'=> $request->type_icon
        ]);
        $notification = array(
            'message'=> 'Bien immobilier ajouté avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.type')->with($notification);

    }//end methode

    public function EditType($id){
        $types = PropertyType::findOrFail($id);
        return view('backend.type.edit_type',compact('types'));
    }

    public function UpdateType(Request $request){
       $pid = $request->id;
        PropertyType::findOrFail($pid)->update([
            'type_name'=>$request->type_name,
            'type_icon'=> $request->type_icon
        ]);
        $notification = array(
            'message'=> 'Bien immobilier modifié avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.type')->with($notification);

    }//end methode

    public function DeleteType($id){
        PropertyType::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Bien immobilier supprimée avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.type')->with($notification);

    }
    ////////////all Amenities methodes ///////////

    public function AllAmenitie(){
        $amenities = Amenities::latest()->get();
        return view('backend.amenitie.all_amenities',compact('amenities'));
    }//end methode

    public function AddAmenitie(){
        return view('backend.amenitie.add_amenitie');
    }//end methode

    public function StoreAmenitie(Request $request){
        Amenities::insert([
            'amenities_name'=>$request->amenities_name,
        ]);
        $notification = array(
            'message'=> 'Equipement ajouté avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.amenitie')->with($notification);

    }//end methode
    public function EditAmenitie($id){
        $amenities = Amenities::findOrFail($id);
        return view('backend.amenitie.edit_amenitie',compact('amenities'));
    }

    public function UpdateAmenitie(Request $request){
        $pid = $request->id;
         Amenities::findOrFail($pid)->update([
             'amenities_name'=>$request->amenities_name,
         ]);
         $notification = array(
             'message'=> 'Equipement modifié avec succéss',
             'alert-type'=> 'success'
         );
         return redirect()->route('all.amenitie')->with($notification);
 
     }//end methode

     public function DeleteAmenitie($id){
        Amenities::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Equipement supprimée avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.amenitie')->with($notification);

    }//end methode
}
