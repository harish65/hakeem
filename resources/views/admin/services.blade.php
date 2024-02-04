@extends('layouts.vertical', ['title' => 'Variables'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <div class="page-title-box mt-2">
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item active">Variables</li>
                  </ol>
              </div>
              <h3 class="card-title">Variables</h3>
          </div>
      </div>
  </div> 
  <div class="card">
    <!-- /.card-header -->
    <div class="card-body">
        <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
          <thead>
          <tr>
            <th>Sr No.</th>
            <th>Variable Type</th>
            <th>Key</th>
            <th>Value</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          <?php $inc = 1; ?>
          </thead>
          <tbody>
          @foreach($services as $index => $service)
           @if(config('client_connected') && (Config::get("client_data")->domain_name=="physiotherapist" || Config::get("client_data")->domain_name=="food") && ($service->type=='charges'||$service->type=='audio/video'||$service->type=='class_calling' ||$service->type=='insurance'))
           
           @elseif(config('client_connected') && (Config::get("client_data")->domain_name=="careworks") && ($service->type=='charges'||$service->type=='audio/video'||$service->type=='class_calling' ||$service->type=='insurance'||$service->type=='unit_price'||$service->type=='slot_duration'
           ))
           
          @else
          <tr>
            <td><?php echo $inc++; ?></td>
            <td>{{$service->type}}</td>
            @if($service->type=='unit_price' && \Config('client_connected') && \Config::get("client_data")->domain_name=="intely")
                <td>Hour</td>
                <td>{{ ($service->value/60) }}</td>
            @else
                <td>{{$service->key_name}}</td>
                <td>{{$service->value}}</td>
            @endif
            
            <td><span class="badge badge-success">Enabled</span></td>
            <td><a href="{{ url('admin/service_enable') .'/'.$service->id.'/edit'}}" class="btn btn-sm btn-info float-left">Edit</a></td>
          </tr>
          @endif
          @endforeach
          </tbody>
        </table>
      <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer -->
  </div>
</div>
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

@endsection