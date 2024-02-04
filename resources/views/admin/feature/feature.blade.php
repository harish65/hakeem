@extends('layouts.vertical', ['title' => 'Edit Feature'])
@section('css')
<style type="text/css">
  .wrapper_class{
    padding-bottom: 10px;
  }
</style>
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <div class="page-title-box">
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item active">Edit Feature</li>
                  </ol>
              </div>
              <h4 class="page-title">Edit Feature</h4>
          </div>
      </div>
  </div>   
  <div class="card card-primary">
      <div class="card-header">
        @if(session()->has('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              {{ session()->get('message') }}
          </div>
        @endif
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" action="{{url('admin/feature-types'.'/'.$feature_type_id)}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="post">
          <div class="card-body">
            <div class="form-group">
                   <div class="row">
                    <div class="col-sm-12">
                        <div class="wrapper_class">
                          @foreach($features as $index=>$feature)
                            <?php $keys = []; if($feature->feature_values){ $keys = json_decode($feature->feature_values,true); }; ?>
                            <label> {{ $feature->feature->name }}</label>
                            @foreach($feature->feature->feature_keys as $index=>$feature_key)
                              <div class="input-group">
                                    <div class="col-lg-8">
                                      <label>{{ $feature_key->key_name }}</label>
                                       <input type="text" class="form-control is-warning" name="feature_keys[{{ $feature->feature->id}}][{{ $feature_key->id }}]" placeholder="Value" value="<?php echo isset($keys[$feature_key->id])?$keys[$feature_key->id]:''?>">
                                    </div>
                                    <br>
                                    <div class="col-lg-2">
                                      <!-- <div class="custom-control custom-switch">
                                          <input type="checkbox"  class="custom-control-input"   id="customSwitch{{ $index }}" <?php echo($feature->for_fron_end=='1')?'checked':'' ?> disabled>
                                          <label class="custom-control-label" for="customSwitch{{ $index }}">FOR FRONT END</label>
                                      </div> -->
                                    </div>
                              </div>
                             @endforeach
                            <hr>
                          @endforeach
                        </div>
                         @if ($errors->has('filter_option'))
                          <span class="text-danger">{{ $errors->first('filter_option') }}</span>
                        @endif
                    </div>
                  </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-info" href="{{url('admin/feature-types'.'/'.$feature_type_id)}}">Cancel</a>
          </div>
      </form>
  </div>
</div>
@endsection
@section('script')

@endsection