@extends('layouts.vertical', ['title' => 'Create Category'])
@section('content')
<?php
  $sessionatcentre = false;
  if(Config('client_connected') && (Config::get("client_data")->domain_name=="physiotherapist") && $category->id===2)
    $sessionatcentre = true;
 ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 <!-- Start Content-->
<div class="container-fluid">
  <div class="row">
        <div class="col-12 mt-2">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.index')}}"> Categories</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ol>
                </div>
                @if(isset($category))
                  @if($sessionatcentre)
                    <h4 class="page-title">Add {{ __('text.Sub Category') }}</h4>
                  @else
                    <h4 class="page-title">Create Child Category of {{ $category->name }}</h4>
                  @endif
                @else
                  <h4 class="page-title">Create Main Category</h4>
                @endif
                <!-- <h4 class="page-title">Add Service Type</h4> -->
            </div>
        </div>
    </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
          <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @if(isset($category))
                <div class="form-group row">
                  <div class="col-md-6">
                    <label>Parent Category:</label>
                    <input type="text" disabled="" id="category_selected" class="form-control" value="{{ $category->name }}" readonly="">

                    <input type="hidden" name="parent_id" class="form-control" value="{{ $category->id }}">
                  </div>
                  @if($sessionatcentre)
                    <input type="hidden" id="search_latitude" name="lat">
                    <input type="hidden" id="search_longitude" name="long">
                    <input type="hidden" id="city" name="city">
                    <input type="hidden" id="state" name="state">
                    <div class="col-md-6">
                        <label for="name">Centre Email</label>
                         <input type="email" placeholder="Centre Contact Email" class="form-control" value="{{ old('email') }}" name="email" required="">
                        @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                  @endif
              </div>
              @endif
              <div class="form-group row">
                <div class="col-md-6">
                  <label>{{ ($sessionatcentre)?'Centre Name':'Category Name'}}</label>
                  <input type="text" name="name" id="category_selected" class="form-control" value="{{ old('name') }}" placeholder="{{ ($sessionatcentre)?'Centre Name':'Category Name'}}" required>
                  @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                <div class="col-md-6">
                  <label>Color Code:</label>
                  <input id="example-color" type="color" name="color_code" value="{{ old('color_code') }}" class="form-control" required>
                   @if ($errors->has('color_code'))
                    <span class="text-danger">{{ $errors->first('color_code') }}</span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                    <label for="name">Enable Services</label>
                    <select class="form-control show-tick" name="enable_service_type">
                      <option <?php echo (old('enable_service_type')=='1')?"selected":'' ?> value="1">Yes</option>
                      <option <?php echo (old('enable_service_type')=='0')?"selected":'' ?> value="0">No</option>
                    </select>
                    @if ($errors->has('enable_service_type'))
                            <span class="text-danger">{{ $errors->first('enable_service_type') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                  <label>{{ ($sessionatcentre)?'Centre Address':'Description'}}</label><br>
                  <textarea class="form-control" placeholder="{{ ($sessionatcentre)?'Centre Address':'Description'}}" id="{{ ($sessionatcentre)?'page_body__search':'page_body__' }}" name="description" row="5" required>{{ old('description') }}</textarea>
                  @if ($errors->has('description'))
                      <span class="text-danger">{{ $errors->first('description') }}</span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                    <label for="name">Show On Front End</label>
                    <select class="form-control show-tick" name="enable">
                      <option <?php echo (old('enable')=='1')?"selected":'' ?> value="1">Yes</option>
                      <option <?php echo (old('enable')=='0')?"selected":'' ?> value="0">No</option>
                    </select>
                    @if ($errors->has('enable'))
                            <span class="text-danger">{{ $errors->first('enable') }}</span>
                    @endif
                </div>
                @if(Config('client_connected') && Config::get("client_data")->domain_name=="mataki")
                <div class="col-md-6">
                    <label for="name">Services</label>
                    <select class="form-control show-tick" name="services">
                      <option <?php echo (old('services')=='Prescription')?"selected":'' ?> value="Prescription">Prescription</option>
                      <option <?php echo (old('services')=='Recommendation')?"selected":'' ?> value="Recommendation">Recommendation</option>
                    </select>
                    @if ($errors->has('services'))
                            <span class="text-danger">{{ $errors->first('services') }}</span>
                    @endif
                </div>
                @endif
                @if(Config('client_connected') && Config::get("client_data")->domain_name=="careworks")
                <div class="col-md-6">
                    <label for="name">Category Time Slot</label>
                    <select class="form-control show-tick" required id="time_slot" name="time_slot[]">
                      <option <?php echo (old('time_slot')=='1')?"selected":'' ?> value="1">Hourly</option>
                      <option <?php echo (old('time_slot')=='2')?"selected":'' ?> value="2">Full Day</option>
                    </select>
                    @if ($errors->has('enable'))
                            <span class="text-danger">{{ $errors->first('enable') }}</span>
                    @endif
                </div>
                @endif
                </div>
                @if(Config('client_connected') && Config::get("client_data")->domain_name=="care_connect_live")
                <div class="col-md-6">
                    <label for="">Percentage</label>
                    <input class="form-control" type="text" value="" name="percentage" />
                    @if ($errors->has('percentage'))
                            <span class="text-danger">{{ $errors->first('percentage') }}</span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="name">Enable Percentage</label>
                    <select class="form-control show-tick" name="enable_percentage">
                      <option <?php echo (old('enable_percentage')=='1')?"selected":'' ?> value="1">Yes</option>
                      <option <?php echo (old('enable_percentage')=='0')?"selected":'' ?> value="0">No</option>
                    </select>
                    @if ($errors->has('enable_percentage'))
                            <span class="text-danger">{{ $errors->first('enable_percentage') }}</span>
                    @endif
                </div>
                @endif
                @if($sessionatcentre)
                <div class="col-md-6">
                    <label for="name">Centre Price</label>
                     <input type="number" placeholder="Centre Price Per Session" class="form-control" value="{{ old('price') }}" name="price" required="">
                    @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                    @endif
                </div>
                @endif


              <div class="form-group row">
                <div class="col-md-6">
                <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div >
                        <input type="file" value="{{ old('category_image') }}" name="category_image" id="exampleInputFile">
                        @if ($errors->has('category_image'))
                      <span class="text-danger">{{ $errors->first('category_image') }}</span>
                      @endif
                      </div>
                    </div>
                </div>

              <div class="col-md-6">
                  <label for="exampleInputFile2">Icon</label>
                  <div class="input-group">
                    <div >
                      <input type="file" value="{{ old('image_icon') }}" name="image_icon" id="exampleInputFile2">
                      @if ($errors->has('image_icon'))
                      <span class="text-danger">{{ $errors->first('image_icon') }}</span>
                      @endif
                    </div>
                  </div>
              </div>
             </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">Create</button>
                <a class="btn btn-info" href="{{ route('categories.index')}}">Cancel</a>
              </div>
              </div>
            </form>
          </div>
        </div>
  </div>
  </div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAV4UFmQuEWaFEnrA5Q7Q0rxwVr5jOqR4Y&amp;libraries=places"></script>
<script type="text/javascript">

      $(document).ready(function() {
          $("#time_slot").select2({
            placeholder: "Select time slot",
            allowClear: true
          });
      });

      google.maps.event.addDomListener(window, 'load', initialize);
        function initialize() {
          var input = document.getElementById('page_body__search');
          var autocomplete = new google.maps.places.Autocomplete(input);
          autocomplete.setComponentRestrictions({
            country: ["in"],
          });
          autocomplete.addListener('place_changed', function () {
          var place = autocomplete.getPlace();
          var address = place.address_components;
          var city, state, zip;
          address.forEach(function(component) {
            var types = component.types;
            if (types.indexOf('locality') > -1) {
              city = component.long_name;
            }
            if (types.indexOf('administrative_area_level_1') > -1) {
              state = component.long_name;
            }
            if (types.indexOf('postal_code') > -1) {
              zip = component.long_name;
            }
          });
          $('#city').val(city);
          $('#state').val(state);
          $('#search_latitude').val(place.geometry.location.lat());
          $('#search_longitude').val(place.geometry.location.lng());
      });
    }
</script>
@endsection
