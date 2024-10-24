@extends('agent.agent_dashboard')

@section('agent')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<div class="page-content">

    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <div>
                <img class="wd-70 rounded-circle" src="{{(!empty($profileData->photo)) ? url('upload/agent_images/'.$profileData->photo):url('upload/no_image.jpg')}}" alt="profile">
                <span class="h4 ms-3 text-light">{{$profileData->username}}</span>
              </div>
             
            </div>
            <p>Hi! I'm Amiah the Senior UI Designer at NobleUI. We hope you enjoy the design and quality of Social.</p>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Nom:</label>
              <p class="text-muted">{{$profileData->name}}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
              <p class="text-muted">{{$profileData->email}}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Téléphone:</label>
              <p class="text-muted">{{$profileData->phone}}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Adresse:</label>
              <p class="text-muted">{{$profileData->address}}</p>
            </div>
            <div class="mt-3 d-flex social-links">
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="github"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="twitter"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Modifier votre mot de passe</h6>
  
                <form  method="POST" action="{{route('agent.update.password')}}" enctype="multipart/form-data" class="forms-sample">
                  @csrf
                  <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Acienne mot de passe</label>
                        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" autocomplete="off">
                        @error('old_password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                  </div>

                  <div class="mb-3">
                        <label for="exampleInputUsername1" class="form-label">Nouveau mot de passe</label>
                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" autocomplete="off">
                        @error('new_password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputUsername1" class="form-label">Confirmation mot de passe</label>
                    <input type="password" name="new_password_confirmation"  class="form-control" id="new_password_confirmation" autocomplete="off">
                 
              </div>
                  
                     <button type="submit" class="btn btn-primary me-2">Mettre à jour</button>
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