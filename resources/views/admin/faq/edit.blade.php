@extends('layouts.vertical', ['title' => 'Edit Faq'])

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <div class="page-title-box mt-2">
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('faq.index') }}">Faqs</a></li>
                      <li class="breadcrumb-item active">Edit Faq</li>
                  </ol>
              </div>
              <h3 class="card-title">Edit Faq</h3>
          </div>
      </div>
  </div> 
  <div class="card card-primary">
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" action="{{ url('admin/faq').'/'.$feed->id}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">
          <div class="card-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif
            <div class="form-group row">
                <div class="col-sm-6">
                  <label for="">Title</label><br>
                  <input type="text" class="form-control"  name="title"  placeholder="Title" required="" value="{{ old('title')??$feed->title }}">
                  @if ($errors->has('title'))
                          <span class="text-danger">{{ $errors->first('title') }}</span>
                  @endif
                </div>
            </div> 
            <div class="form-group row">
                <div class="col-sm-6">
                  <label for="page_body__">Description</label><br>
                  <textarea class="form-control" rows="6" column="6"  name="description"  id="page_body__" placeholder="Place some text here" >{{{old('description')??$feed->description }}}</textarea>
                  @if ($errors->has('description'))
                          <span class="text-danger">{{ $errors->first('description') }}</span>
                  @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                  <label for="exampleInputFile">Image Web</label>
                  <div class="input-group">
                    <div >
                      <input type="file" value="{{old('image') }}" name="image" id="ct-img-file">
                      <img src="{{ Storage::disk('spaces')->url('thumbs/'.$feed->image) }}" id="profile-img-tag" width="200px" />
                    </div>
                  </div>
                   @if ($errors->has('image'))
                                  <span class="text-danger">{{ $errors->first('image') }}</span>
                    @endif
                </div>
            </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-info" href="{{ route('faq.index')}}">Cancel</a>
          </div>
      </form>
  </div>
</div>
@endsection