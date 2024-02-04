@extends('layouts.vertical', ['title' => 'Update Admin'])
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Update Admin</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('post_update_user') }}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="POST">
        <div class="card-body">
         <div class="form-group row">
              <div class="col-sm-6">
                <label for="">Name</label><br>
                <input type="text" class="form-control _input"  name="name"  placeholder="Enter Name" required="" value="{{ old('name')??$user->name }}">
                @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
              <div class="col-sm-6">
                <label for="">Email</label><br>
                <input type="email" class="form-control _input"  name="email"  placeholder="Enter Email" required="" value="{{ old('email')??$user->email }}">
                @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
              </div>
          </div>
          <div class="form-group row">
              <div class="col-sm-6">
                <label for="country">Country</label><br>
                <select name="country" id="country" class="form-control _input" required="">
                  @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ ($user->country_id==$country->id)?"selected":"" }}>{{ $country->name }}</option>
                  @endforeach
                </select>
                @if ($errors->has('country'))
                    <span class="text-danger">{{ $errors->first('country') }}</span>
                @endif
              </div>
              <div class="col-sm-6">
                <label for="phone">Contact</label><br>
                <input id="phone" type="text" class="form-control _input"  name="phone"  placeholder="Contact" required="" value="{{ old('phone')??$user->phone }}">
                @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
              </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
                
                </div>
            </div>
          </div>
          <div class="clear-fix"></div>
          <button type="submit" class="btn btn-primary bg_color _input">Submit</button>
        <!-- /.card-body -->
    </form>
  </div>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection