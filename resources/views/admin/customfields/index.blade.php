@extends('layouts.vertical', ['title' =>$text])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box mt-2">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ url('vendor/custom-fields')}}">{{ $text }}</a></li>
                        </ol>
                    </div>
                    <h3 class="card-title">{{ $text }}</h3>
                </div>
            </div>
        </div>
		<div class="row">
		    <div class="col-12">
		      <div class="card">
		        <div class="card-header">
		           <a href="{{ url($action_url.'/create') }}" class="btn btn-sm btn-info float-right">Add New Custom Field</a>
		        </div>
		        <!-- /.card-header -->
		        <div class="card-body">
		          	<table id="scroll-horizontal-datatable" class="table w-100 nowrap">
		            <thead>
		            <tr >
		            	<th>Sr No.</th>
		            	<th>Field Name</th>
		            	<th>Field Type</th>
		            	<th>Show On SignUp</th>
		            	<th>Action</th>
		            </tr>
		            </thead>
		            <tbody>
		             @foreach($customfields as $index => $customfield)
			            <tr>
			              <td>{{ $index+1 }}</td>
			              <td>{{ $customfield->field_name }}</td>
			              <td>{{ $customfield->field_type }}</td>
			              <td>{{ ($customfield->required_sign_up=='1'?'Yes':'No') }}</td>
			              <td>
			              	<a href="{{ url($action_url) .'/'.$customfield->id.'/edit'}}" class="btn btn-sm btn-info float-left">Edit</a>
			              	<a class="btn btn-danger btn-sm delete-customfield" data-customfield_id="{{ $customfield->id }}" href="javascript:void(0)">
                              <i class="fas fa-trash"></i>
                              Delete
                          	</a>
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
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script type="text/javascript">
    	let action = "{{ $action_url }}";
    	$(function () {
    		 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    		$("#scroll-horizontal-datatable").on('click', '.delete-customfield',function(e){
			          e.preventDefault();
			          var customfield = $(this).attr('data-customfield_id');
			          Swal.fire({
			            title: 'Are you sure?',
			            text: "You won't be able to revert this!",
			            showCancelButton: true,
			            confirmButtonColor: '#3085d6',
			            cancelButtonColor: '#d33',
			            confirmButtonText: 'Yes, delete it!'
			          }).then((result) => {
			            if (result.value) {
			                $.ajax({
			                   type:'DELETE',
			                   url:base_url+'/'+action+'/'+customfield,
			                   data:{id:customfield},
			                   success:function(data){
			                      Swal.fire(
			                        'Deleted!',
			                        'customfield has been deleted.',
			                        'success'
			                      ).then((result)=>{
			                        window.location.reload();
			                      });
			                   }
			                });
			              }
			          });

			    });
    	});
    </script>

@endsection
