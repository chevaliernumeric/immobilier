@extends('admin.admin_dashboard')

@section('admin')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<div class="page-content">

    <div class="row profile-body">
      <!-- middle wrapper start -->
      <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                        <form method="POST" action="{{route('update.property')}}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$property->id}}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Nom du propriété</label>
                                        <input type="text" name="property_name" value="{{$property->property_name}}" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Status du propriété</label>
                                        <select name="property_status" class="form-select" id="exampleFormControlSelect1">
											<option selected="" disabled="">Séléctionner un status</option>
											<option value="Louer" {{$property->property_status == 'Louer' ? 'selected' :''}}>Louer</option>
											<option value="Acheter" {{$property->property_status == 'Acheter' ? 'selected' :''}}>Acheter</option>
											
										</select>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Prix le plus bas</label>
                                        <input type="text" name="lowest_price" value="{{$property->lowest_price}}" class="form-control">
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Prix maximum</label>
                                        <input type="text" name="max_price" value="{{$property->max_price}}"  class="form-control">
                                    </div>
                                </div><!-- Col -->
                                
                            
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">chambres à coucher</label>
                                        <input type="number" name="bedrooms" value="{{$property->bedrooms}}" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">salles de bains</label>
                                        <input type="text" name="bathrooms" value="{{$property->bathrooms}}" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Garage</label>
                                        <input type="text" name="garage" value="{{$property->garage}}" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-3">
                                    <div class="mb-3">
                                        <label class="form-label">Taille du garage</label>
                                        <input type="text" name="garage_size" value="{{$property->garage_size}}" class="form-control">
                                    </div>
                                </div><!-- Col -->
                            

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" value="{{$property->address}}" class="form-control">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">ville</label>
                                            <input type="text" name="city" value="{{$property->city}}" class="form-control">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">État</label>
                                            <input type="text" name="state" value="{{$property->state}}" class="form-control">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label class="form-label">code postal</label>
                                            <input type="text" name="postal_code" value="{{$property->postal_code}}" class="form-control">
                                        </div>
                                    </div><!-- Col -->
                            
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Taille de propriété</label>
                                                <input type="text" name="property_size" value="{{$property->property_size}}" class="form-control">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">vidéo de propriété</label>
                                                <input type="text" name="property_video" value="{{$property->property_video}}" class="form-control">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Quartier</label>
                                                <input type="text" name="neighborhood" value="{{$property->neighborhood}}" class="form-control">
                                            </div>
                                        </div> <!-- Col -->

                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="text" name="latitude" value="{{$property->latitude}}" class="form-control">
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get latitude from address</a>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="text" name="longitude" value="{{$property->longitude}}" class="form-control" >
                                        <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get longitude from address</a>
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-3">
                                        <label class="form-label">Type de propriété</label>
                                        <select name="ptype_id" class="form-select" id="exampleFormControlSelect1">
											<option selected="" disabled="">Séléctionner un type de propriété</option>
                                            @foreach ($propertytype as $ptype)
                                                <option value="{{$ptype->id}}" {{ $ptype->id == $property->ptype_id  ? 'selected' :''}}  >{{$ptype->type_name}}</option>                                                
                                            @endforeach
										</select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Equipement du propriété</label>
                                        <label class="form-label">Séléction vos équipement</label>
									<select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                        @foreach ($amenities as $ameni)
                                        <option value="{{$ameni->id}}" {{(in_array($ameni->id,$property_ami)) ? 'selected' : ''}}>{{$ameni->amenities_name}}</option>                                                
                                    @endforeach
										
									</select>
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        <label class="form-label">Agent</label>
                                        <select name="agent_id" class="form-select" id="exampleFormControlSelect1">
											<option selected="" disabled="">Séléctionner un agent</option>
                                            @foreach ($activeAgent as $agent)
                                                <option value="{{$agent->id}}" {{ $agent->id == $property->agent_id  ? 'selected' :''}}>{{$agent->name}}</option>                                                
                                            @endforeach
										</select>
                                    </div>
                                </div> <!-- Col -->

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description courte</label>
                                        <textarea name="short_descp" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$property->short_descp}}</textarea>
                                    </div>
                                </div><!-- Col -->

                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description longue</label>
                                        <textarea class="form-control" name="long_descp" id="tinymceExample" rows="10">{{$property->long_descp}}</textarea>
                                    </div>
                                </div><!-- Col -->
                                <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="featured" {{$property->featured == '1' ? 'checked':''}} value="1" class="form-check-input" id="checkInline1">
                                    <label class="form-check-label"  for="checkInline1">features property</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="hot" {{$property->hot == '1' ? 'checked':''}} value="1" class="form-check-input" id="checkInline">
                                    <label class="form-check-label" for="checkInline">hot property</label>
                                </div>
                                </div>
                            <!---end row-->
                            <div class="col-mb3">
                                <button type="submit" class="btn btn-primary">Enrigister</button>
                                </form>

                            </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>

    
    <!-- Main thumbnail edit image -->
<div class="page-content" style="margin-top: -20px; margin:0px;">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('update.property_thambnail')}}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$property->id}}"/>
                            <input type="hidden" name="old_img" value="{{$property->property_thambnail}}"/>
                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Main Thumbnail</label>
                                    <input type="file" name="property_thambnail" onchange="mainThamUrl(this)" class="form-control">
                                    <img src="" id="mainThmb"/>
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="form-label"></label>
                                    <img src="{{asset($property->property_thambnail)}}" style="width: 100px;height: 100px;"/>
                                </div>
                            </div><!-- Col -->

                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main thumbnail edit image -->

<!-- Multiple edit image -->
<div class="page-content" style="margin-top: -20px;">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('update.property.multiimage')}}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>S1</th>
                                            <th>Image</th>
                                            <th>Change Image</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($multiImage as $item => $img)
                                        <tr>
                                            <td>{{$item + 1}}</td>
                                            <td class="py-1">
                                                <img src="{{asset($img->photo_name)}}" alt="image" style="width: 50px; height:50px;">
                                            </td>
                                            <td><input type="file" class="form-control" name="multi_img[{{$img->id}}]"/></td>
                                            <td>
                                                <input type="submit" class="btn btn-primary px-4" value="Mettre à jour"/>
                                                <a href="{{route('property.multiimg.delete', $img->id)}}" class="btn btn-danger" id="delete">Supprimer</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <form method="POST" action="{{route('store.new.multiimage')}}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="imageid" value="{{$property->id}}"/>
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="file" class="form-control" name="multi_img"/>
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-primary px-4" value="Ajouter une image"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Multiple edit image -->

<!-- Start Facility Form edit -->
<div class="page-content" style="margin-top: -50px; margin:0px;">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('update.property.facilities')}}" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$property->id}}" />
                            @foreach ($facilities as $item)
                            <div class="whole_extra_item_add" id="whole_extra_item_add">
                            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                <div class="container mt-2">
                                   <div class="row">
                                      <div class="form-group col-md-4">
                                         <label for="facility_name">Facilities</label>
                                         <select name="facility_name[]" id="facility_name" class="form-control">
                                               <option value="">Select Facility</option>
                                               <option value="Hospital"{{$item->facility_name == 'Hospital' ? 'selected':''}}>Hospital</option>
                                               <option value="SuperMarket" {{$item->facility_name == 'SuperMarket' ? 'selected':''}}>Super Market</option>
                                               <option value="School" {{$item->facility_name == 'School' ? 'selected':''}}>School</option>
                                               <option value="Entertainment" {{$item->facility_name == 'Entertainment' ? 'selected':''}}>Entertainment</option>
                                               <option value="Pharmacy" {{$item->facility_name == 'Pharmacy' ? 'selected':''}}>Pharmacy</option>
                                               <option value="Airport" {{$item->facility_name == 'Airport' ? 'selected':''}}>Airport</option>
                                               <option value="Railways" {{$item->facility_name == 'Railways' ? 'selected':''}}>Railways</option>
                                               <option value="Bus Stop" {{$item->facility_name == 'Bus Stop' ? 'selected':''}}>Bus Stop</option>
                                               <option value="Beach" {{$item->facility_name == 'Beach' ? 'selected':''}}>Beach</option>
                                               <option value="Mall" {{$item->facility_name == 'Mall' ? 'selected':''}}>Mall</option>
                                               <option value="Bank" {{$item->facility_name == 'Bank' ? 'selected':''}}>Bank</option>
                                         </select>
                                      </div>
                                      <div class="form-group col-md-4">
                                         <label for="distance">Distance</label>
                                         <input type="text" name="distance[]" value="{{$item->distance}}" id="distance" class="form-control" placeholder="Distance (Km)">
                                      </div>
                                      <div class="form-group col-md-4" style="padding-top: 20px">
                                         <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                                         <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                                      </div>
                                   </div>
                                </div>
                             </div>
                            </div>     
                            @endforeach
                            <button type="submit" class="btn btn-primary">save change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Facility form -->


   <!--========== Start of add multiple class with ajax ==============-->
   <div style="visibility: hidden">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
       <div class="whole_extra_item_delete" id="whole_extra_item_delete">
          <div class="container mt-2">
             <div class="row">
               
                <div class="form-group col-md-4">
                   <label for="facility_name">Facilities</label>
                   <select name="facility_name[]" id="facility_name" class="form-control">
                         <option value="">Select Facility</option>
                         <option value="Hospital">Hospital</option>
                         <option value="SuperMarket">Super Market</option>
                         <option value="School">School</option>
                         <option value="Entertainment">Entertainment</option>
                         <option value="Pharmacy">Pharmacy</option>
                         <option value="Airport">Airport</option>
                         <option value="Railways">Railways</option>
                         <option value="Bus Stop">Bus Stop</option>
                         <option value="Beach">Beach</option>
                         <option value="Mall">Mall</option>
                         <option value="Bank">Bank</option>
                   </select>
                </div>
                <div class="form-group col-md-4">
                   <label for="distance">Distance</label>
                   <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                </div>
                <div class="form-group col-md-4" style="padding-top: 20px">
                   <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                   <span class="btn btn-danger btn-sm removeeventmore"><i class="fa fa-minus-circle">Remove</i></span>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div> 
 <button type="submit" class="btn btn-primary">Enrigister</button>
      </form>
                </div>
            </div>
        </div>
      </div>
    </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    property_name: {
                        required : true,
                    },
                    property_status: {
                        required : true,
                    }, 
                    lowest_price: {
                        required : true,
                    }, 
                    max_price: {
                        required : true,
                    }, 
                    ptype_id: {
                        required : true,
                    }, 
                   
                    
                },
                messages :{
                    property_name: {
                        required : 'Veuillez entrer le nom du propriété',
                    }, 
                    property_status: {
                        required : 'Veuillez séléctionner le status du propriété',
                    }, 
                    lowest_price: {
                        required : 'Veuillez entrer le prix minimal du propriété',
                    }, 
                    max_price: {
                        required : 'Veuillez entrer le prix maximal du propriété',
                    }, 
                    ptype_id: {
                        required : 'Veuillez séléctionner un ptype du propriété',
                    }, 
                    
                     
    
                },
                errorElement : 'span', 
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
        
    </script>
        <script type="text/javascript">
            function mainThamUrl(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#mainThmb').attr('src',e.target.result).width(80).height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

<script> 
 
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
     
    </script>
    <!----For Section-------->
 <script type="text/javascript">
    $(document).ready(function(){
       var counter = 0;
       $(document).on("click",".addeventmore",function(){
             var whole_extra_item_add = $("#whole_extra_item_add").html();
             $(this).closest(".add_item").append(whole_extra_item_add);
             counter++;
       });
       $(document).on("click",".removeeventmore",function(event){
             $(this).closest("#whole_extra_item_delete").remove();
             counter -= 1
       });
    });
 </script>

        <script type="text/javascript">
            function mainThamUrl(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#mainThmb').attr('src',e.target.result).width(80).height(80);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
@endsection