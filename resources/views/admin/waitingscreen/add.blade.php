@extends('layouts.vertical', ['title' => 'Waiting Screen'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">New Waiting Screen</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ url('admin/waiting')}}" method="post" enctype="multipart/form-data">
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
                  
                  
              </div>
          </div>
          <div class="form-group">
             <div class="row">
                  <div class="col-sm-4">
                    <label for="exampleInputFile">Video</label>
                    <div class="input-group">
                      <div >
                        <input type="file" value="{{old('video') }}" name="video" id="ct-img-file">
                        <img src="" id="profile-img-tag" width="200px" />
                      </div>
                    </div>
                     @if ($errors->has('video'))
                        <span class="text-danger">{{ $errors->first('video') }}</span>
                      @endif
                  </div>
                  
                  
              </div>
          </div>
          <div class="form-group">
            <div class="row">
                  <div class="col-sm-4">
                      <label >Category</label>
                      <select class="form-control" name="category_id">
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
           
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
  </div>
@endsection
