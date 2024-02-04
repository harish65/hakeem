	@extends('layouts.vertical', ['title' => 'Pincodes'])

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
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item active">Pincodes</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div> 
		<div class="row">
		    <div class="col-12">
		      <div class="card">
		        <div class="card-header">
		          <h5 class="card-title">Pincode Listing</h5>
		           
				   <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<input type="file" name="file" class="" id="customFile">
					<button class="btn btn-primary">Import data</button>
					<a class="btn btn-success" href="{{ route('file-export') }}">CSV example</a>
					<a href="{{ url('admin/pincodes/create')}}" class="btn btn-sm btn-info float-right">Add New Pincode</a>
				</form>
		        </div>
		        <!-- /.card-header -->
		        <div class="card-body">
		          	<table id="scroll-horizontal-datatable" class="table w-100 nowrap">
		            <thead>
		            <tr >
		            	<th>Sr No.</th>
		            	<th>Pincode</th>
		            	<th>Status</th>
		            	<th>Action</th>
		            </tr>
		            </thead>
		            <tbody>
		             @foreach($pincodes as $index => $pincode)
			            <tr>
			              <td>{{ $index+1 }}</td>
			              <td>{{ $pincode->pincode }}</td>
			              <td>{{ $pincode->status?'Active':'Inactive' }}</td>
			              <td>
			              	<a href="{{ url('admin/pincodes') .'/'.$pincode->id.'/edit'}}" class="btn btn-sm btn-info float-left">Edit</a>

			              	<a class="btn btn-danger btn-sm delete-pincode" data-pincode_id="{{ $pincode->id }}" href="javascript:void(0)">
                              <i class="fas fa-trash">
                              </i>
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
    <!-- <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script> -->

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script type="text/javascript">
    	$(function () {
    		 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
    		$(".delete-pincode").click(function(e){
			          e.preventDefault();
			          var pincode_id = $(this).attr('data-pincode_id');
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
			                   url:base_url+'/admin/pincodes/'+pincode_id,
			                   data:{id:pincode_id},
			                   success:function(data){
			                      Swal.fire(
			                        'Deleted!',
			                        'Pincode has been deleted.',
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