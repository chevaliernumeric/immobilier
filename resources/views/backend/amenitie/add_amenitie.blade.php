@extends('admin.admin_dashboard')

@section('admin')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<div class="page-content">

    <div class="row profile-body">
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Ajouter un équipement</h6>
  
                <form id="myForm" method="POST" action="{{route('store.amenitie')}}" enctype="multipart/form-data" class="forms-sample">
                  @csrf
                  <div class="form-group mb-3">
                        <label for="exampleInputUsername1" class="form-label">Nom d'équipement</label>
                        <input type="text" name="amenities_name" class="form-control">
                        
                  </div>                  
                     <button type="submit" class="btn btn-primary me-2">Ajouter</button>
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
                    amenities_name: {
                        required : true,
                    }, 
                    
                },
                messages :{
                    amenities_name: {
                        required : 'Veuillez entrer le nom des équipements',
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

@endsection