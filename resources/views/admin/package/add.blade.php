@extends('layouts.vertical', ['title' => 'Package'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">New Package</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ url('admin/package')}}" method="post" enctype="multipart/form-data">
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
                  <div class="col-sm-6">
                    <label for="title">Title</label>
                    <div class="input-group">
                        <input class="form-control" type="text" value="{{old('title') }}" placeholder="title" name="title" id="title">
                    </div>
                     @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                      @endif
                  </div>
                  <div class="col-sm-6">
                     <label for="description">Description</label>
                        <div class="input-group">
                            <textarea rows="5" class="form-control" placeholder="description" name="description" id="description">{{old('description') }}</textarea>
                        </div>
                       @if ($errors->has('description'))
                                      <span class="text-danger">{{ $errors->first('description') }}</span>
                              @endif
                  </div>
              </div>
          </div>
          <div class="form-group">
             <div class="row">
                  <div class="col-sm-6">
                    <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div >
                        <input type="file" value="{{old('image') }}" name="image" id="ct-img-file">
                        <img src="" id="profile-img-tag" width="200px" />
                      </div>
                    </div>
                     @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                      @endif
                  </div>
                  <div class="col-sm-6">
                     <label for="price">Price</label>
                        <div class="input-group">
                            <input class="form-control" type="number" placeholder="Price" value="{{old('price') }}" name="price" id="price">
                        </div>
                         @if ($errors->has('price'))
                              <span class="text-danger">{{ $errors->first('price') }}</span>
                      @endif
                  </div>
              </div>
          </div>
        
          <div class="form-group">
            <div class="row">
                  <div class="col-sm-4">
                      <label >Package Type</label>
                      <select class="form-control" name="package_type">
                          <option value="">--Select Status--</option>
                          <option <?php echo (old('package_type')=='category')?"selected":'' ?> value="category">Category</option>
                          <option <?php echo (old('package_type')=='open')?"selected":'' ?> value="open">Open</option>
                        </select>
                        @if ($errors->has('package_type'))
                          <span class="text-danger">{{ $errors->first('package_type') }}</span>
                        @endif
                </div>
                @if(config('client_connected') && Config::get("client_data")->domain_name == "curenik")

                <div class="col-sm-4">
                      <label >Service</label>
                      <select  class="form-control" name="service_id[]" multiple>
                          <option value="">--Select Service--</option>
                          @foreach($services as $servicesinfo)
                          <option  value="{{ $servicesinfo->type}}">{{ $servicesinfo->type}}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('service_id'))
                          <span class="text-danger">{{ $errors->first('service_id') }}</span>
                        @endif
                </div>
                @endif

                  <div class="col-sm-4">
                      <label >Category</label>
                      <select class="form-control" name="category">
                          <option value="">--Select Status--</option>
                          @foreach($categories as $cat_key=>$parentCategory)
                          <option  value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                          @if($parentCategory->is_filter)
                            @foreach($parentCategory->filters as $filter)
                            <option  value="{{ 'filter_'.$filter['data']['id'].'_category_'.$parentCategory->id }}">{{ $filter['data']['option_name'] }}</option>
                            @endforeach
                          @endif
                          @endforeach
                        </select>
                        @if ($errors->has('category'))
                          <span class="text-danger">{{ $errors->first('category') }}</span>
                        @endif
                </div>
            </div>
           </div>
           
           <div class="form-group">
            <div class="row">
            @if(config('client_connected') && Config::get("client_data")->domain_name == "curenik")
                    <div class="col-sm-4">
                          <label >Package Create For</label>
                          <select class="form-control" name="package_created_for">
                              <option value="">--Select Status--</option>
                              <option <?php echo (old('package_created_for')=='curenik')?"selected":'' ?> value="curenik">Curenik</option>
                              <option <?php echo (old('package_created_for')=='doctor')?"selected":'' ?> value="doctor">Doctor</option>
                            </select>
                            @if ($errors->has('package_created_for'))
                              <span class="text-danger">{{ $errors->first('package_created_for') }}</span>
                            @endif
                    </div>
              @endif
                  <div class="col-sm-4">
                      <label for="total_requests">Total Sessions/Requests</label>
                      <input type="number" name="total_requests" class="form-control" value="{{ old('total_requests') }}" id="total_requests" placeholder="Total Sessions/Requests">
                      @if ($errors->has('total_requests'))
                              <span class="text-danger">{{ $errors->first('total_requests') }}</span>
                      @endif
                </div>
                  <div class="col-sm-4">
                      <label >Enable</label>
                      <select class="form-control" name="enable">
                          <option <?php echo (old('enable')=='1')?"selected":'' ?>  value="1">True</option>
                          <option <?php echo (old('enable')=='0')?"selected":'' ?>  value="0">False</option>
                        </select>
                        @if ($errors->has('enable'))
                          <span class="text-danger">{{ $errors->first('enable') }}</span>
                        @endif
                </div>
               
           </div>
        </div>
        <div class="form-group">
            <div class="row">
                @if(config('client_connected') && Config::get("client_data")->domain_name == "curenik")
                  <div class="col-sm-4">
                        <label >Valid From To valid To</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                              <i class="far fa-calendar-alt"></i>
                            </span>
                          </div>
                          <input type="text" name="date_range"  class="form-control float-right" id="range-datepickers">
                        </div>       
                        @if ($errors->has('date_range'))
                          <span class="text-danger">{{ $errors->first('date_range') }}</span>
                        @endif
                  </div>
              @endif  
           </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
  </div>
  <!-- Initialize the plugin: -->

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

              $('#range-datepickers').flatpickr({
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