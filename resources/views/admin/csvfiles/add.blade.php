@extends('layouts.vertical', ['title' => 'Waiting Screen'])
@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Add Csv File</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('csvfiles.store')}}" method="post" enctype="multipart/form-data">
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
                    <label for="exampleInputFile">File</label>
                    <div class="input-group">
                      <div >
                        <input type="file" value="{{old('csv_files') }}" name="csv_files" id="ct-img-file">
                        <img src="" id="profile-img-tag" width="200px" />
                      </div>
                    </div>
                     @if ($errors->has('csv_files'))
                        <span class="text-danger">{{ $errors->first('csv_files') }}</span>
                      @endif
                  </div>
              </div>
          </div>
          {{-- <div class="form-group">
             <div class="row">
                  <div class="col-sm-4">
                    <label for="exampleInputFile">File Name</label>
                    <div class="input-group">
                      <div >
                        <input type="text" class="form-control" value="{{old('name') }}" name="name" id="ct-img-file">
                      </div>
                    </div>
                     @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                      @endif
                  </div>
              </div>
          </div> --}}
          <div class="form-group">
            <div class="row">
                 <div class="col-sm-4">
                   <label for="exampleInputFile">File Description</label>
                   <div class="input-group">
                     <div >
                       <input type="text" class="form-control" value="{{old('description') }}" name="description" id="ct-img-file">
                     </div>
                   </div>
                    @if ($errors->has('description'))
                       <span class="text-danger">{{ $errors->first('description') }}</span>
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
