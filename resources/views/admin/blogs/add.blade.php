@extends('layouts.vertical', ['title' => 'Blogs'])
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">New Blog</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ url('admin/blogs')}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="POST">
        <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
         <div class="form-group row">
              <div class="col-sm-6">
                <label for="">Title</label><br>
                <input type="text" class="form-control"  name="title"  placeholder="Title" required="" value="{{ old('title') }}">
                @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
              </div>
          </div> 
          <div class="form-group row">
              <div class="col-sm-6">
                <label for="page_body__">Description</label><br>
                <textarea class="form-control" rows="6" column="6"  name="description"  id="page_body__" placeholder="Place some text here" >{{{old('description') }}}</textarea>
                @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
              </div>
          </div>
          <div class="form-group row">
              <div class="col-sm-6">
                  <label for="exampleInputFile">Image</label>
                  <div class="input-group">
                    <div >
                      <input type="file" value="{{old('image') }}" name="image" id="ct-img-file">
                      <img src="" id="profile-img-tag" width="200px" />
                      @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
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