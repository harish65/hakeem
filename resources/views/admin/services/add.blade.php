
@php
$client = (config('client_connected') && Config::get("client_data")->domain_name == "careworks");
@endphp@extends('layouts.vertical', ['title' => 'Create Service Type'])
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('services.index')}}"> Service Types</a></li>
                            <li class="breadcrumb-item active">Add Service Type</li>
                        </ol>
                    </div>
                    @if($client)
                    <h4 class="page-title">Add Service Type</h4>
                    <p>*These services are used for Chat,Audio Call,Home Visit etc</p>
                    <p class="text-warning"><label></label> You must add service type 'Chat' in all services to start chat user and expert</p>
                    @else
                    <h4 class="page-title">Add Service Type</h4>
                    <p>*These services are used for Chat,Audio Call,Home Visit etc</p>
                    <p class="text-warning"><label>In Need Availability </label> No means that Doctor is available all time no needs to add Availability from Doctor Side</p>
                    @endif
                   </div>
            </div>
        </div>
        <div class="row">
          <div class="col-12 card">

            <div class="card-body">
              <form action="{{ route('services') }}" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="form-group">
                  <div class="row">
                  <div class="col-sm-4">
                    <label>Service Name <span class="text-warning">(anything)</span></label>
                    <input id="service__name" type="text" name="service_name" class="form-control" value="{{ old('service_name') }}" placeholder="Service Name">
                    @if ($errors->has('service_name'))
                      <span class="text-danger">{{ $errors->first('service_name') }}</span>
                    @endif
                    <span class="text-danger service__name_error"></span>
                  </div>
                  <div class="col-sm-4">
                    <label>Description</label>
                    <input name="description" type="text" value="{{ old('description') }}" class="form-control" placeholder="description">
                     @if ($errors->has('description'))
                      <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="form-group">
                  <div class="row">
                    <div class="col-sm-4">
                      <label>Need Availability </label>
                        <select  class="form-control" name="need_availability">
                          <option value="">--Availability--</option>
                          <option value="1" <?php echo (old('need_availability')=='true')?"selected":'' ?>>Yes</option>
                          <option value="0" <?php echo (old('need_availability')=='false')?"selected":'' ?>>False</option>
                        </select>
                        @if ($errors->has('need_availability'))
                          <span class="text-danger">{{ $errors->first('need_availability') }}</span>
                        @endif
                    </div>
                    <div class="col-sm-4">
                      <label>Color picker:</label>
                      <input name="color_code" type="color" value="{{ old('color_code') }}" class="form-control my-colorpicker1">
                       @if ($errors->has('color_code'))
                        <span class="text-danger">{{ $errors->first('color_code') }}</span>
                      @endif
                  </div>
                </div>
            </div>
            <div class="form-group">
                  <div class="row">
                      <div class="col-sm-4">
                        <label>Service Type </label>
                          <select class="form-control" name="service_type">
                              <option value="">--Select Service--</option>
                              @foreach($service_types as $cat_key=>$service_type)
                              <option <?php echo (old('service_type')==$service_type->name)?"selected":'' ?>  value="{{ $service_type->name }}">{{ $service_type->name }}</option>
                              @endforeach
                            </select>
                          @if ($errors->has('service_type'))
                            <span class="text-danger">{{ $errors->first('service_type') }}</span>
                          @endif
                      </div>
                </div>
            </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Create</button>
                  <a class="btn btn-info" href="{{ route('services.index')}}">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
