@extends('layouts.vertical', ['title' => 'Update Passwrod'])
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Update Passwrod</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('post_admin_password') }}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="POST">
        <div class="card-body">
         <div class="form-group row">
              <div class="col-sm-6">
                <label for="">Old Password</label><br>
                <input type="password" class="form-control _input"  name="old_password"  placeholder="Enter Old Password" required="">
                @if ($errors->has('old_password'))
                        <span class="text-danger">{{ $errors->first('old_password') }}</span>
                @endif
              </div>
          </div>
          <div class="form-group row">
              <div class="col-sm-6">
                <label for="new_password">New Password</label><br>
                <input type="password" class="form-control _input"  name="new_password"  placeholder="Enter New Password" required="">
                @if ($errors->has('new_password'))
                        <span class="text-danger">{{ $errors->first('new_password') }}</span>
                @endif
              </div>
          </div>
          <div class="form-group row">
              <div class="col-sm-6">
                <label for="re_password">ReEnter New Password</label><br>
                <input type="password" class="form-control _input"  name="re_password"  placeholder="ReEnter Password" required="">
                @if ($errors->has('re_password'))
                        <span class="text-danger">{{ $errors->first('re_password') }}</span>
                @endif
              </div>
            </div>
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        <!-- /.card-body -->
    </form>
  </div>
@endsection
@section('script')
<script type="text/javascript">
</script>
@endsection