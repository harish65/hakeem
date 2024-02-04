@extends('layouts.vertical', ['title' => 'App Details'])
@section('content')
 <!-- Start Content-->
<div class="container-fluid">
  <div class="row">
        <div class="col-12">
            <div class="page-title-box mt-2">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('app_detail.index')}}" >App Details</a></li>
                        <li class="breadcrumb-item active">Add Detail</li>
                    </ol>
                </div>
                <h3 class="card-title">Add Detail</h3>
            </div>
        </div>
  </div> 
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        
          <div class="card-body">
            <form action="{{ route('app_detail.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <div class="col-md-6">
                  <label>Background Color</label>
                  <input id="example-color" type="color" name="background_color" value="{{ old('background_color') }}" class="form-control">
                   @if ($errors->has('background_color'))
                    <span class="text-danger">{{ $errors->first('background_color') }}</span>
                  @endif
                </div>
                <div class="col-md-6">
                   <label for="exampleInputFile">App Logo</label>
                  <div class="input-group">
                   <input type="file" value="{{old('app_logo')}}" name="app_logo" id="app_logo">
                    <img src="" id="profile-img-tag-icon" width="200px" />
                  </div>
                   @if ($errors->has('app_logo'))
                      <span class="text-danger">{{ $errors->first('app_logo') }}</span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-info" href="{{ route('app_detail.index')}}">Cancel</a>
              </div>
            </form>
          </div>
        </div>
  </div>
  </div>      
</div>
@endsection
@section('script')
 <script type="text/javascript">
        $(function () {
            function readURL2(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    
                    reader.onload = function (e) {
                        $('#profile-img-tag-icon').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#app_logo").change(function(){
                readURL2(this);
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection