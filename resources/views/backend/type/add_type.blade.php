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
                    <h6 class="card-title">Ajouter un type de bien immobilier</h6>
  
                <form  method="POST" action="{{route('store.type')}}" enctype="multipart/form-data" class="forms-sample">
                  @csrf
                  <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Nom du type</label>
                        <input type="text" name="type_name" class="form-control @error('type_name') is-invalid @enderror" >
                        @error('type_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputUsername1" class="form-label">Type d'icon</label>
                    <input type="text" name="type_icon" class="form-control @error('type_icon') is-invalid @enderror" >
                    @error('type_icon')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
              </div>
                  
                     <button type="submit" class="btn btn-primary me-2">Ajouter</button>
                   </form>
  
                </div>
              </div>
        
        </div>
      </div>
      <!-- middle wrapper end -->
      <!-- right wrapper start -->
    
      <!-- right wrapper end -->
    </div>

    </div>


@endsection