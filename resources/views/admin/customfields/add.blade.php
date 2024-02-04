@extends('layouts.vertical', ['title' => $text])

@section('css')

@endsection

@section('content')
<div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mt-2">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url($action_url)}}">{{ $text }}</a></li>
                        </ol>
                    </div>
                    <h3 class="card-title">{{ $text }}</h3>
                </div>
            </div>
        </div>

<div class="card card-primary">
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ url($action_url)}}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="POST">
      <input type="hidden" name="user_type" value="{{ $role->id }}">
        <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
          <div class="form-group">
            <div class="row">
                  <div class="col-sm-4">
                      <label for="field_name">Field Name</label>
                      <input type="text" name="field_name" class="form-control" value="{{ old('field_name') }}" id="field_name" placeholder="Field Name" required="">
                      @if ($errors->has('field_name'))
                              <span class="text-danger">{{ $errors->first('field_name') }}</span>
                      @endif
                </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
                  <div class="col-sm-4">
                      <label for="field_type">Field Type</label>
                      <input  type="hidden" name="field_type" class="form-control"  value="textbox">
                      <select  class="form-control" name="field_type">
                        <option value="textbox" <?php echo (old('field_type')=='textbox')?"selected":'' ?>>Textbox</option>
                        <option value="multiple" <?php echo (old('field_type')=='multiple')?"selected":'' ?>>Multiple</option>
                      </select>
                      @if ($errors->has('field_type'))
                              <span class="text-danger">{{ $errors->first('field_type') }}</span>
                      @endif
                </div>
            </div>
          </div>
          <div class="form-group">
              <div class="custom-control custom-switch">
                <input type="checkbox" name="required_sign_up" class="custom-control-input" id="customSwitch1">
                <label class="custom-control-label" for="customSwitch1">Show On Sign-Up</label>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a class="btn btn-info" href="{{ url($action_url)}}">Cancel</a>
        </div>
    </form>
  </div>
</div>

   @endsection

@section('script')
@endsection