@extends('admin.admin_dashboard')

@section('admin')
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<div class="page-content">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
                    <h6 class="card-title">Property details</h6>
                    <p class="text-muted mb-3">Add class <code>.table</code></p>
                    <div class="table-responsive">
                            <table class="table table-striped">
                            
                                <tbody>
                                    <tr>
                                        <th>Nom propriétaire</th>
                                        <td><code>{{$property->property_name}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><code>{{$property->property_status}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Prix le plus bas</th>
                                        <td><code>{{$property->lowest_price}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Prix maximum</th>
                                        <td><code>{{$property->max_price}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>chambres à coucher</th>
                                        <td><code>{{$property->bedrooms}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>salles de bains</th>
                                        <td><code>{{$property->bathrooms}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Garage</th>
                                        <td><code>{{$property->garage}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Taille du garage</th>
                                        <td><code>{{$property->garage_size}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><code>{{$property->address}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>ville</th>
                                        <td><code>{{$property->city}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>État</th>
                                        <td><code>{{$property->state}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>code postal</th>
                                        <td><code>{{$property->postal_code}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Main image</th>
                                        <td>
                                            <img src="{{asset($property->property_thambnail)}}" style="width: 100px; height:70px;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($property->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                            <span class="badge rounded-pill bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                    
                            
                                </tbody>
                             </table>
                    </div>
  </div>
</div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
                    <h6 class="card-title">Hoverable Table</h6>
                    <p class="text-muted mb-3">Add class <code>.table-hover</code></p>
                    <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>Taille de propriété</th>
                                        <td><code>{{$property->property_size}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>vidéo de propriété</th>
                                        <td><code>{{$property->property_video}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Quartier</th>
                                        <td><code>{{$property->neighborhood}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Latitude</th>
                                        <td><code>{{$property->latitude}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Longitude</th>
                                        <td><code>{{$property->longitude}}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Equipement du propriété</th>
                                        <td>
                                            <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">
                                                @foreach ($amenities as $ameni)
                                                <option value="{{$ameni->id}}">{{$ameni->amenities_name}}</option>                                                
                                            @endforeach
                                                
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Agent</th>
                                       
                                            @if ($property->agent_id == NULL)
                                                <td><code>Admin</code></td>
                                            @else
                                            <td><code>{{$property['user']['name']}}</code></td>
                                            @endif
                                        
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            @if ($property->status == 1)
                            <form method="POST" action="{{route('inactive.property')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$property->id}}"/>
                                <button type="submit" class="btn btn-primary">InActive</button>
                            </form>
                                
                            @else
                            <form method="POST" action="{{route('active.property')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$property->id}}"/>
                                <button type="submit" class="btn btn-primary">Active</button>
                            </form>
                            @endif
                    </div>
  </div>
</div>
        </div>
    </div>
</div>
 
@endsection