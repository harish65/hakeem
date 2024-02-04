@extends('layouts.vertical', ['title' => 'Update '.__('text.User')])

@section('css')

@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
        <div class="col-12">
            <div class="page-title-box mt-2">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('customers.index') }}">List {{ __('text.User') }}</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
                <h3 class="card-title">Edit {{ __('text.User') }}</h3>
            </div>
        </div>
    </div>
  <div class="card card-primary">
      <!-- form start -->
      <form role="form" action="{{ url('admin/customers').'/'.$customer->id}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">
          <div class="card-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" name="email" value="{{ $customer->email }}" id="exampleInputEmail1" placeholder="Enter email">
              @if ($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" value="{{ $customer->name }}" id="name" placeholder="name">
              @if ($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
              @endif
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}" id="phone" placeholder="phone">
              @if ($errors->has('phone'))
                      <span class="text-danger">{{ $errors->first('phone') }}</span>
              @endif
            </div>
            @if(config('client_connected') && (Config::get("client_data")->domain_name=="healtcaremydoctor"))
              <div class="form-group">
                 <label for="dob">DOB</label>
                <input type="date" class="form-control" id="dob" placeholder="y-m-d" name="dob" value="{{($customer->profile)?$customer->profile->dob:''}}">
                <span class="alert-danger dob_error"></span>
              </div>
            <div class="form-group">
               <label for="bio">Bio</label>
              <input type="text" class="form-control" id="bio" placeholder="Bio" name="bio" value="{{($customer->profile)?$customer->profile->about:''}}">
              <span class="alert-danger bio_error"></span>
            </div>
            @endif
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-info" href="{{ route('customers.index')}}">Cancel</a>
          </div>
      </form>
  </div>
</div>
   @endsection

@section('script')
@endsection