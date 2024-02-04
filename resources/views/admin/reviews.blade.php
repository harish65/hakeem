@extends('layouts.vertical', ['title' => 'Reviews'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@php
if(isset($_COOKIE['royo_timZone'])){ $timeZone = $_COOKIE['royo_timZone'];}else{ $timeZone = 'Asia/Calcutta';}
$name1 = 'Patient';
$name2 = 'Doctor';
if(config('client_connected') && (Config::get("client_data")->domain_name=="iedu")){
    $name1 = 'User';
    $name2 = 'Consultant';
  }
@endphp
@section('content')
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-left">
	              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
	              <li class="breadcrumb-item active">Reviews</li>
	            </ol>
	          </div>
	        </div>
	      </div><!-- /.container-fluid -->
		<div class="row">
		    <div class="col-12">
		      <div class="card">
		        <div class="card-body">
		          	<table id="scroll-horizontal-datatable" class="table w-100">
		            <thead>
		            <tr>
		            	<th>Sr No.</th>
		            	<th>{{ $name1 }} Name</th>
		            	<th>Comment</th>
		            	<th>Rating</th>
		            	<th>{{ $name2 }} Name</th>
		            	<th>Comment At</th>
		            </tr>
		            </thead>
		            <tbody>
		             @foreach($review_list as $index => $review)
			            <tr>
			              <td>{{ $index+1 }}</td>
			              <td>{{ $review->user->name ?? ''}}</td>
			              <td>{{ $review->comment ?? '' }}</td>
			              <td>{{ $review->rating  ?? ''}}</td>
			              <td>{{ $review->consultant->name ?? ''}}</td>
			              <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $review->updated_at)->tz($timeZone)->format('d M Y h:i A') }}
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
	@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
@endsection
