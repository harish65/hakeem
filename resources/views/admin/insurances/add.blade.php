@extends('layouts.vertical', ['title' => 'Add Insurance'])

@section('css')

@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">New Insurance</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ url('admin/insurance')}}" method="post">
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
                  <div class="col-sm-8">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name" placeholder="name">
                      @if ($errors->has('name'))
                              <span class="text-danger">{{ $errors->first('name') }}</span>
                      @endif
                </div>
            </div>    
          </div>
          @if(config('client_connected') && (Config::get("client_data")->domain_name=="mp2r" || Config::get("client_data")->domain_name=="care_connect_live"))
          <div class="form-group">
             <div class="row">
              <div class="col-sm-4">
                      <label for="name">Payer ID</label>
                      <input type="text" name="carrier_code" class="form-control" value="{{ old('carrier_code') }}" id="carrier_code" placeholder="Carrier Code">
                      @if ($errors->has('carrier_code'))
                              <span class="text-danger">{{ $errors->first('carrier_code') }}</span>
                      @endif
                </div>
              </div>
          </div>
          @endif
          @if(config('client_connected') && ( Config::get("client_data")->domain_name!=="care_connect_live"))
          <div class="form-group">
            <div class="row">
                  <div class="col-sm-4">
                      <label >Category</label>
                      <select class="form-control category_listing" name="category_id">
                          <option value="">--Select Category--</option>
                          @foreach($categories as $cat_key=>$parentCategory)
                          <option <?php echo (old('category_id')==$parentCategory->id)?"selected":'' ?>  value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                          @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                          <span class="text-danger">{{ $errors->first('category_id') }}</span>
                        @endif
                </div>
            </div>
           </div>
           @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
  </div>

   @endsection

@section('script')
@endsection