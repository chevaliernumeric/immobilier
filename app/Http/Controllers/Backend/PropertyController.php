<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\MultiImage;
use App\Models\User;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image As Image;


class PropertyController extends Controller
{
    public function AllProperty(){
        $property = Property::latest()->get();
        return view('backend.property.all_property',compact('property'));
    }//end methode

    public function AddProperty(){
        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.property.add_property',compact('propertytype','amenities','activeAgent'),);
    }//end methode

    public function StoreProperty(Request $request){
        $amen = $request->amenities_id;
        $amenities = implode(",",$amen);
        $pcode = IdGenerator::generate([
            'table'=> 'properties',
            'field'=> 'property_code',
            'length'=>5,
            'prefix'=> 'PC' 
        ]);
        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/property/thambnail/'.$name_gen);
        $save_url = 'upload/property/thambnail/'.$name_gen;
        $property_id = Property::insertGetId([
            'ptype_id'=> $request->ptype_id,
            'amenities_id'=>$amenities,
            'property_name'=>$request->property_name,
            'property_slug'=> strtolower(str_replace(' ','-',$request->property_name)),
            'property_code'=> $pcode,
            'property_status'=>$request->property_status,

            'lowest_price'=>$request->lowest_price,
            'max_price'=>$request->max_price,
            'short_descp'=>$request->short_descp,
            'long_descp'=>$request->long_descp,
            'bedrooms'=>$request->bedrooms,
            'bathrooms'=>$request->bathrooms,
            'garage'=>$request->garage,
            'garage_size'=>$request->garage_size,

            'property_size'=>$request->property_size,
            'property_video'=>$request->property_video,
            'address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'postal_code'=>$request->postal_code,

            'neighborhood'=>$request->neighborhood,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'featured'=>$request->featured,
            'hot'=>$request->hot,
            'agent_id'=>$request->agent_id,
            'status'=>1,
            'created_at'=>Carbon::now(),
            'property_thambnail'=>$save_url,

        ]);
        //multi-image upload from here
        $images = $request->file('multi_img');
        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(770,520)->save('upload/property/multi_imge/'.$make_name);
            $uploadPath = 'upload/property/multi_imge/'.$make_name;

            MultiImage::insert([
                'property_id'=>$property_id,
                'photo_name'=>$uploadPath,
                'created_at'=>Carbon::now()
            ]);

        } // end foreach
        //methode multiple image upload from here
    
        //facilities add from here
    
        $facilities = count($request->facility_name);
        if($facilities != null){
            for ($i=0; $i < $facilities ; $i++) { 
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }
        }
        // end facility add from here
        $notification = array(
            'message'=> 'Bien immobilié ajouté avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.property')->with($notification);
    }// End Methode

    public function EditProperty($id){
        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_ami = explode(",",$type);

        $multiImage = MultiImage::where('property_id',$id)->get();

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.property.edit_property',compact('property','propertytype','amenities','activeAgent','property_ami','multiImage','facilities'),);

    }//END METHODE

    public function UpdateProperty(Request $request){
        $amen = $request->amenities_id;
        $amenities = implode(",",$amen);
        
        $property_id = $request->id;
        Property::findOrFail($property_id)->update([
            'ptype_id'=> $request->ptype_id,
            'amenities_id'=>$amenities,
            'property_name'=>$request->property_name,
            'property_slug'=> strtolower(str_replace(' ','-',$request->property_name)),
            'property_status'=>$request->property_status,

            'lowest_price'=>$request->lowest_price,
            'max_price'=>$request->max_price,
            'short_descp'=>$request->short_descp,
            'long_descp'=>$request->long_descp,
            'bedrooms'=>$request->bedrooms,
            'bathrooms'=>$request->bathrooms,
            'garage'=>$request->garage,
            'garage_size'=>$request->garage_size,

            'property_size'=>$request->property_size,
            'property_video'=>$request->property_video,
            'address'=>$request->address,
            'city'=>$request->city,
            'state'=>$request->state,
            'postal_code'=>$request->postal_code,

            'neighborhood'=>$request->neighborhood,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'featured'=>$request->featured,
            'hot'=>$request->hot,
            'agent_id'=>$request->agent_id,
            'updated_at'=>Carbon::now(),
        ]);
        $notification = array(
            'message'=> 'Bien immobilié modifié avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.property')->with($notification);
    }//end methode

    public function UpdatePropertyThambnail(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/property/thambnail/'.$name_gen);
        $save_url = 'upload/property/thambnail/'.$name_gen;

        if(file_exists($oldImage)){
            unlink($oldImage);
        }
        Property::findOrFail($pro_id)->update([
            'property_thambnail'=> $save_url,
            'updated_at'=>Carbon::now()
        ]);
        $notification = array(
            'message'=> 'Bien modifié modifié avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.property')->with($notification);
    }//END METHODE


    public function UpdatePropertyMultiimage(Request $request){
        $imgs = $request->multi_img;
        
        foreach($imgs as $id => $img){
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(770,520)->save('upload/property/multi_imge/'.$make_name);
            $uploadPath = 'upload/property/multi_imge/'.$make_name;

            MultiImage::where('id',$id)->update([
                'photo_name'=>$uploadPath,
                'updated_at'=> Carbon::now()
            ]);
        }//End foreach
        $notification = array(
            'message'=> 'Multi-image modifié modifié avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.property')->with($notification);
    }

    public function PropertyMultiimgDelete($id){
        $oldImage = MultiImage::findOrFail($id);
        unlink($oldImage->photo_name);

        MultiImage::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Multi-image supprimé avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);

    }//END METHODE

    public function StoreNewMultiimage(Request $request){
        $new_multi = $request->imageid;
        $image = $request->file('multi_img');
        $make_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(770,520)->save('upload/property/multi_imge/'.$make_name);
            $uploadPath = 'upload/property/multi_imge/'.$make_name;

            MultiImage::insert([
                'property_id'=>$new_multi,
                'photo_name'=>$uploadPath,
                'created_at'=> Carbon::now()
            ]);

            $notification = array(
                'message'=> 'Multi-image ajouté avec succéss',
                'alert-type'=> 'success'
            );
            return redirect()->back()->with($notification);

    }//End method

    public function UpdatePropertyFacilities(Request $request){
        $pid = $request->id;
        if($request->facility_name == NULL){
            return redirect()->back();
        }else{
            Facility::where('property_id',$pid)->delete();
            $facilities = count($request->facility_name);
            if($facilities != null){
                for ($i=0; $i < $facilities ; $i++) { 
                    $fcount = new Facility();
                    $fcount->property_id = $pid;
                    $fcount->facility_name = $request->facility_name[$i];
                    $fcount->distance = $request->distance[$i];
                    $fcount->save();
                }
            }//end if
            $notification = array(
                'message'=> 'Facilities modifié avec succéss',
                'alert-type'=> 'success'
            );
            return redirect()->back()->with($notification);
        }

    }//end method

    public function DeleteProperty($id){
        $property = Property::findOrFail($id);
        unlink($property->property_thambnail);
        Property::findOrFail($id)->delete();
        $image = MultiImage::where('property_id',$id)->get();
        foreach($image as $img){
            unlink($img->photo_name);
            MultiImage::where('property_id',$id)->delete();
        }
        $facilitiesData = Facility::where('property_id',$id)->get();
        foreach($facilitiesData as $item){
            $item->facility_name;
            Facility::where('property_id',$id)->delete();
        }
        $notification = array(
            'message'=> 'propriété supprimé avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }//end method

    public function DetailsProperty($id){
        $facilities = Facility::where('property_id',$id)->get();
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_ami = explode(",",$type);

        $multiImage = MultiImage::where('property_id',$id)->get();

        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.property.details_property',compact('property','propertytype','amenities','activeAgent','property_ami','multiImage','facilities'),);

    }//END METHODE

    public function InactiveProperty(Request $request){
        $pid = $request->id;
        Property::findOrFail($pid)->update([
            'status'=> 0,
        ]);
        $notification = array(
            'message'=> 'propriété inactive avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.property')->with($notification);
    }//End method

    public function ActiveProperty(Request $request){
        $pid = $request->id;
        Property::findOrFail($pid)->update([
            'status'=> 1,
        ]);
        $notification = array(
            'message'=> 'propriété active avec succéss',
            'alert-type'=> 'success'
        );
        return redirect()->route('all.property')->with($notification);
    }//End method
}
