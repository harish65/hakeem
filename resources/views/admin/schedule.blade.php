@extends('layouts.vertical', ['title' => 'Schedule'])
@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block mt-2">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif
 <!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item active">Schedule</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> 

    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Update Schedule</h3>
          <a href="{{ route('ad-hoc')}}" class="btn btn-sm btn-info float-right">Ad-Hoc Sync</a>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{ url('admin/update_schedule')}}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="card-body">
            <div class="form-group">
              <label>Command Name</label>
              <input type="text" disabled class="form-control" value="sync:careproviders" name="command_name">
              <input type="hidden" name="cron_id" value="{{ $cron->id }}">
            </div>
            <div class="form-group">
              <label>Sync Timing*(UTC Time)
                @if ($errors->has('time'))
                  <span class="text-danger">{{ $errors->first('time') }}</span>
                @endif</label><br>
              @php $iTimestamp = mktime(1,0,0,1,1,2011); @endphp
                @for($i=0;$i<24;$i++)
                  {{ date('H:i A', $iTimestamp) }} <input type="checkbox" class="" name="time[]" value="{{ date('H:i', $iTimestamp) }}" {{ (($cron->schedule_at)&&in_array(date('H:i', $iTimestamp),$cron->schedule_at))?'checked':'' }}><br>
                  @php $iTimestamp += 3600; @endphp
                @endfor
                
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
          <!-- /.card-body -->
      </div>
  </div>
@endsection

@section('script')
@endsection