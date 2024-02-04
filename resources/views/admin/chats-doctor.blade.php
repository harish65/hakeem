@extends('layouts.vertical', ['title' => 'Appointments' ])
@section('css')
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<?php
$category_permission = json_decode(Auth::user()->permission);
$permission = (isset($category_permission->module) && $category_permission->module=='category')?true:false;
$admin = Auth::user()->hasRole('admin');
$service_provider = Auth::user()->hasRole('service_provider');
$nurselynx = false;
if(config('client_connected') && (Config::get("client_data")->domain_name=="nurselynx")){
  $nurselynx = true;
}
$name1 = 'Patient';
$name2 = 'Doctor';
if(config('client_connected') && (Config::get("client_data")->domain_name=="iedu")){
    $name1 = 'User';
    $name2 = 'Consultant';
  }

if(isset($_COOKIE['royo_timZone'])){ $timeZone = $_COOKIE['royo_timZone'];}else{ $timeZone = 'Asia/Calcutta';} ?>
<div class="container-fluid">
		<div class="row">
		    <div class="col-12">
		      <div class="card">
		        <div class="card-header">
		          <h3 class="card-title">Appointments {{ $chats->count() }}</h3>
		          @if($service_provider && $permission)
		          <a href="{{ url('admin/appointment/create')}}" class="btn btn-sm btn-info float-right">Add New Appointment</a>
		          @endif
		        </div>
		        <!-- /.card-header -->
		        <div class="card-body">
              @if($nurselynx)
                <div class="row"> 
                  <div class="col-md-2">
                    User Approval Status
                  </div>
                  <div class="col-md-3">
                    <select class="form-control" id='searchMonth'>
                       <option value='declined'>Declined</option>
                       <option value='approved'>Approved</option>
                       <option value='pending'>Pending</option>
                       <option value=''>All</option>
                     </select>
                  </div>
              </div>
              <br>
              @endif
		          	<table id="scroll-horizontal-datatable" class="table w-100 nowrap">
		            <thead>
		            <tr >
		            	<th>#</th>
		            	<th>Booking Date</th>
		            	<th>Time</th>
		            	<th>{{ $name1 }} name</th>
		            	<th>{{ __('text.Vendor') }} Name</th>
		            	<th>Status</th>
		            	<th>
                  @if(isset($chat->requesthistory) && $chat->requesthistory->status == 'pending')  
                  Action
                  @endif
                </th>		            	
		            </tr>
		            </thead>
		            <tbody>
		             @foreach($chats as $index => $chat)
			            <tr>
			              <td>{{ $index+1 }}</td>
			              <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $chat->booking_date)->tz($timeZone)->format('d M Y') }}</td>
			              <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $chat->booking_date)->tz($timeZone)->format('h:i A') }}</td>
			              <td>{{ $chat->cus_info->name }}</td>
			              @php $d_detail = $chat->getCustomDoctor($chat->id); @endphp
			              @if($permission)
			              		<td>{{ isset($d_detail->first_name)?$d_detail->first_name:'NA' }}</td>
			              @else
				              <td>{{ isset($d_detail->first_name)?$d_detail->first_name:$chat->sr_info->name  }}</td>
			              @endif
			              <td> 
                   
                    
                    <button class="btn btn-sm btn-success">{{ ($chat->requesthistory)?$chat->requesthistory->status:'NA' }}</button> </td>
			              <td>
                        @if(isset($chat->requesthistory) && $chat->requesthistory->status == 'pending')
                        <button data-request_id="{{ $chat->id }}"  class="btn btn-sm btn-info AcceptRequest">Accept Req.</button>
                        <button data-request_id="{{ $chat->id }}"  class="btn btn-sm btn-danger CancelRequest">Cancel Req.</button>
                        @endif
                    </td>
			            </tr>
			         @endforeach
		        	</tbody>
		          </table>
				</div>
	<!-- /.card-body -->
	</div>
	<!-- /.card -->
	</div>
	<!-- /.col -->
	</div>
</div>
{{--<div id="AssignPhysio" class="modal fade" tabindex="-1" role="dialog" aria-modal="true">
	<div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header">
	          <h4 class="modal-title">Assign Session</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
	        <div class="modal-body">
	            <form class="px-3" action="#">
	            	<input type="hidden" name="request_id" id="request_id">
	                <div class="form-group">
	                    <label for="doctor_id">Doctor</label>
	                    <select id="doctor_id" class="form-control">
	                    	@foreach($doctors as $doctor)
	                    	@php $d_detail = json_decode($doctor->raw_detail); @endphp
	                    	<option value="{{ $doctor->id }}">{{ $d_detail->first_name.' '.$d_detail->last_name }}</option>
	                    	@endforeach
	                    </select>
	                </div>
	                <div class="form-group text-center">
	                    <button class="btn btn-primary float-left AssignPhysioSubmit" type="submit">Assign</button>
	                </div>
	            </form>
	        </div>
	    </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>--}}
@endsection
@section('script')
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<!-- <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script> -->
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script type="text/javascript">
  var nurselynx = "{{ $nurselynx }}";
	var dataTable = $('#scroll-horizontal-datatable').DataTable({
            "scrollX": true,
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                }
            },
            "drawCallback": function () {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            },
        });
  if(nurselynx=='1'){
    dataTable.search('declined').draw();
    $('#searchMonth').change(function(){
            dataTable.search(this.value).draw();
      });
  }
	$(".AssignPhysio").click(function(e){
          e.preventDefault();
          var request_id = $(this).attr('data-request_id');
          $("#request_id").val(request_id);
          $('#AssignPhysio').modal('show');
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".AssignPhysioSubmit").click(function(e){
        e.preventDefault();
        $('.AssignPhysioSubmit').html('Assigning...');
        $(this).attr('disabled',true);
        var request_id = $('#request_id').val();
        var doctor_id = $('#doctor_id').val();
        $.ajax({
           type:'POST',
           url:base_url+'/admin/assign/doctor',
           data:{doctor_id:doctor_id,request_id:request_id},
           success:function(data){
              Swal.fire(
                'Assined!',
                'Physiotherapist Assigned',
                'success'
              ).then((result)=>{
                window.location.reload();
              });
           }
        });
    });
    $('#scroll-horizontal-datatable').on('click', '.AcceptRequest', function(e){
    	_this = $(this);
        e.preventDefault();
        _this.html('Accepting...');
        $(this).attr('disabled',true);
        var request_id = $(this).attr('data-request_id');
        $.ajax({
           type:'POST',
           url:base_url+'/admin/appointment/status',
           data:{'request_id':request_id,'status':'accept'},
           success:function(data){
              Swal.fire(
                'Accepted!',
                'Appointment Accepted',
                'success'
              ).then((result)=>{
              		_this.html('Accepted');
              		window.location.reload();
              });
           }
        });
    });
    $('#scroll-horizontal-datatable').on('click', '.StartRequest', function(e){
        e.preventDefault();
        _this = $(this);
        _this.html('Please Wait...');
        $(this).attr('disabled',true);
        var request_id = $(this).attr('data-request_id');
        $.ajax({
           type:'POST',
           url:base_url+'/admin/appointment/status',
           data:{'request_id':request_id,'status':'in-progress'},
           success:function(data){
              Swal.fire(
                'StartRequest!',
                'Appointment Started',
                'success'
              ).then((result)=>{
              		_this.html('Started');
              		window.location.reload();
              });
           }
        });
    });
    $('#scroll-horizontal-datatable').on('click', '.CancelRequest', function(e){
        e.preventDefault();
        _this = $(this);
        _this.html('Canceled...');
        $(this).attr('disabled',true);
        var request_id = $(this).attr('data-request_id');
        $.ajax({
           type:'POST',
           url:base_url+'/admin/appointment/status',
           data:{'request_id':request_id,'status':'canceled'},
           success:function(data){
              Swal.fire(
                'Canceled!',
                'Appointment Canceled',
                'success'
              ).then((result)=>{
              		_this.html('Canceled');
              		window.location.reload();
              });
           }
        });
    });
    $('#scroll-horizontal-datatable').on('click', '.CompleteRequest', function(e){
        e.preventDefault();
        _this = $(this);
        _this.html('completing...');
        $(this).attr('disabled',true);
        var request_id = $(this).attr('data-request_id');
        $.ajax({
           type:'POST',
           url:base_url+'/admin/appointment/status',
           data:{'request_id':request_id,'status':'completed'},
           success:function(data){
              Swal.fire(
                'Completed!',
                'Appointment Completed',
                'success'
              ).then((result)=>{
              		_this.html('Completed');
              		window.location.reload();

              });
           }
        });
    });
    $("#rejectExpert").on('click',function(e){
    var __this = $(this);
    console.log(__this.attr('data-approved'))
    var consultant_id = __this.attr('data-consultant_id');
    var approved = __this.attr('data-approved');
    if(approved=='false'){
      Swal.fire({
        title: 'Write reason for Reject:',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Reject',
        showLoaderOnConfirm: true,
        preConfirm: (data) => {
            if(!data)
              Swal.showValidationMessage(
                'Write reason for Reject:'
              )
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        // __this.text('Rejecting');
        if (result.value) {
          $.ajax({
             type:'PUT',
             url:base_url+'/admin/consultants/'+consultant_id,
             data:{id:consultant_id,account_reject_ajax:'true','comment':result.value},
             success:function(data){
                Swal.fire(
                  'Rejected!',
                  'Account has been Rejected.',
                  'success'
                ).then((result)=>{
                    location.reload();
                });
             }
          });
        }
      });
    }
  });

    $('#scroll-horizontal-datatable').on('click', '.adminStatus', function(e){
        e.preventDefault();
        _this = $(this);
        // _this.html('completing...');
        var request_id = $(this).attr('data-request_id');
        let hours = $(this).attr('data-hours');
        Swal.fire({
          title: 'please approve verified hours',
          input: 'number',
          inputValue:hours,
          inputAttributes: {
            autocapitalize: 'off'
          },
          showCancelButton: true,
          confirmButtonText: 'Approved',
          showLoaderOnConfirm: true,
          preConfirm: (data) => {
              if(!data)
                Swal.showValidationMessage(
                  'please approve verified hours'
                )
          },
          allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
          // __this.text('Rejecting');
          if (result.value) {
              $(this).attr('disabled',true);
              $.ajax({
                 type:'POST',
                 url:base_url+'/admin/appointment/status',
                 data:{'request_id':request_id,'hours':result.value,'admin_status':true,'status':'approved'},
                 success:function(data){
                    Swal.fire(
                      'Approved!',
                      'Hours verified',
                      'success'
                    ).then((result)=>{
                        window.location.reload();

                    });
                 }
              });
          }
        });
    });
</script>
@endsection
