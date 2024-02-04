@extends('layouts.vertical', ['title' => 'Banner'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mt-2">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('banner.index') }}">Banners</a></li>
                            <li class="breadcrumb-item active">Add Banner</li>
                        </ol>
                    </div>
                    <h3 class="card-title">New Banner</h3>
                </div>
            </div>
        </div> 
    <div class="card card-primary">
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{ url('admin/banner')}}" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="POST">
            <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
              <div class="form-group">
                <div class="row">
                      <div class="col-sm-4">
                        <label>Date Range:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="text" name="date_range" value="{{ old('date_range') }}" class="form-control float-right" id="range-datepicker">
                        </div>                     
                        @if ($errors->has('date_range'))
                                  <span class="text-danger">{{ $errors->first('date_range') }}</span>
                          @endif
                    </div>
                </div>    
              </div>
              <div class="form-group">
                 <div class="row">
                      <div class="col-sm-4">
                        <label for="exampleInputFile">Image Web</label>
                        <div class="input-group">
                          <div >
                            <input type="file" value="{{old('image_web') }}" name="image_web" id="ct-img-file">
                            <img src="" id="profile-img-tag" width="200px" />
                          </div>
                        </div>
                         @if ($errors->has('image_web'))
                                        <span class="text-danger">{{ $errors->first('image_web') }}</span>
                          @endif
                      </div>
                      <div class="col-sm-4">
                         <label for="image_mobile">Image  Mobile</label>
                            <div class="input-group">
                              <div >
                                <input type="file" value="{{old('image_mobile') }}" name="image_mobile" id="image_icon">
                                <img src="" id="profile-img-tag-icon" width="200px" />
                              </div>
                            </div>
                             @if ($errors->has('image_mobile'))
                                            <span class="text-danger">{{ $errors->first('image_mobile') }}</span>
                                    @endif
                      </div>
                      @if(config('client_connected') && Config::get("client_data")->domain_name != "curenik")
                      <div class="col-sm-4">
                          <label >User</label>
                          <select class="form-control" name="user">
                              <option value="">--Select User--</option>
                              @foreach($users as $cat_key=>$user)
                              <option <?php echo (old('user')==$user->id)?"selected":'' ?>  value="{{ $user->id }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('user'))
                              <span class="text-danger">{{ $errors->first('user') }}</span>
                            @endif
                    </div>
                    @endif
                  </div>
              </div>
              <div class="form-group">
                <div class="row">
                      <div class="col-sm-4">
                          <label >Category</label>
                          <select class="form-control" name="category">
                              <option value="">--Select Category--</option>
                              @foreach($categories as $cat_key=>$parentCategory)
                              <option <?php echo (old('category')==$parentCategory->id)?"selected":'' ?>  value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('category'))
                              <span class="text-danger">{{ $errors->first('category') }}</span>
                            @endif
                    </div>
                     <div class="col-sm-4">
                          <label >Service Provider</label>
                          <select class="form-control" name="service_provider">
                              <option value="">--Select SP--</option>
                              @foreach($service_providers as $cat_key=>$service_pro)
                              <option <?php echo (old('service_provider')==$service_pro->id)?"selected":'' ?>  value="{{ $service_pro->id }}">{{ $service_pro->name }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('service_provider'))
                              <span class="text-danger">{{ $errors->first('service_provider') }}</span>
                            @endif
                    </div>
                     @if(config('client_connected') && (Config::get("client_data")->domain_name=="mp2r" || Config::get("client_data")->domain_name=="food" || Config::get("client_data")->domain_name=="curenik"))
                     <input type="hidden" name="class">
                    @else
                    <div class="col-sm-4">
                          <label >Class</label>
                          <select class="form-control" name="class">
                              <option value="">--Select Status--</option>
                              @foreach($consultclasses as $cat_key=>$consultclass)
                              <option <?php echo (old('class')==$consultclass->id)?"selected":'' ?>  value="{{ $consultclass->id }}">{{ $consultclass->name }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('class'))
                              <span class="text-danger">{{ $errors->first('class') }}</span>
                            @endif
                    </div>
                    @endif
                </div>
               </div>
               <div class="form-group">
                <div class="row">
                      <div class="col-sm-4">
                          <label >Banner Type</label>
                          <select class="form-control" name="banner_type">
                              
                              <option <?php echo (old('banner_type')=='service_provider')?"selected":'' ?>  value="service_provider">Service Provider</option>
                         
                              @if(config('client_connected') && (Config::get("client_data")->domain_name=="mp2r" || Config::get("client_data")->domain_name=="food" || Config::get("client_data")->domain_name=="curenik"))
                              @else
                              <option <?php echo (old('banner_type')=='class')?"selected":'' ?>  value="class">Class</option>
                              @if(config('client_connected') && Config::get("client_data")->domain_name != "curenik")
                              <option <?php echo (old('banner_type')=='user')?"selected":'' ?>  value="user">User</option>
                              <option <?php echo (old('banner_type')=='category')?"selected":'' ?>  value="category">Category</option>
                              @endif
                              @endif
                            </select>
                            @if ($errors->has('banner_type'))
                              <span class="text-danger">{{ $errors->first('banner_type') }}</span>
                            @endif
                    </div>
                    <div class="col-sm-4">
                      <label >Banner For</label>
                      <select class="form-control" name="show_on">
                          <option <?php echo (old('show_on')=='user')?"selected":'' ?>  value="user">User</option>
                          <option <?php echo (old('show_on')=='sp')?"selected":'' ?>  value="sp">Service Provider</option>
                          <option <?php echo (old('show_on')=='both')?"selected":'' ?>  value="both">Both</option>
                        </select>
                        @if ($errors->has('show_on'))
                          <span class="text-danger">{{ $errors->first('show_on') }}</span>
                        @endif
                     </div>
                      <div class="col-sm-4">
                          <label for="position">Position</label>
                          <input type="number" name="position" class="form-control" value="{{ old('position') }}" id="position" placeholder="Position">
                          @if ($errors->has('position'))
                                  <span class="text-danger">{{ $errors->first('position') }}</span>
                          @endif
                    </div>
                  
               </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a class="btn btn-info" href="{{ route('banner.index')}}">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    
    <!-- Page js-->
    <!-- <script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script> -->
    <script type="text/javascript">
      !function ($) {
          "use strict";

          var FormPickers = function () { };

          FormPickers.prototype.init = function () {

              $('#range-datepicker').flatpickr({
                  mode: "range"
              });
              
          },
              $.FormPickers = new FormPickers, $.FormPickers.Constructor = FormPickers

      }(window.jQuery),

          //initializing 
          function ($) {
              "use strict";
              $.FormPickers.init()
          }(window.jQuery);

    </script>
@endsection