	@extends('layouts.vertical', ['title' => 'Emsat'])

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
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Emsat</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		<div class="row">
		    <div class="col-12">
		      <div class="card">
		        <div class="card-header">
		          <h5 class="card-title">Emsat Listing</h5>
		           <a href="{{ url('admin/emsat/create')}}" class="btn btn-sm btn-info float-right">Add New Emsat</a>
		        </div>
		        <!-- /.card-header -->
		        <div class="card-body">
		          	<table id="scroll-horizontal-datatable" class="table w-100 nowrap">
		            <thead>
		            <tr >
		            	<th>Sr No.</th>
		            	<th>Title</th>
		            	{{--  <th>Questions</th>
		            	<th>Marks</th>
		            	<th>Image</th>  --}}
		            	<th>Action</th>
		            </tr>
		            </thead>
		            <tbody>
		             @foreach($emsats as $index => $banner)
			            <tr>
			              <td>{{ $index+1 }}</td>
			              <td>{{ $banner->title }}</td>
			              {{--  <td>{{ $banner->question }}</td>
			              <td>{{ $banner->marks }}</td>
			              <td>@if($banner->icon) <img height="50px" width="50px" src="{{ Storage::disk('spaces')->url('thumbs/'.$banner->icon) }}"> @endif</td>  --}}
			              <td>
			              	<a href="{{ url('admin/emsat') .'/'.$banner->id.'/edit'}}" class="btn btn-sm btn-info float-left">Edit</a>
			              	<a class="btn btn-danger btn-sm delete-faq" data-faq_id="{{ $banner->id }}" href="javascript:void(0)">
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
    		$(".delete-faq").click(function(e){
			          e.preventDefault();
			          var banner_id = $(this).attr('data-faq_id');
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
			                   url:base_url+'/admin/emsat/'+banner_id,
			                   data:{id:banner_id},
			                   success:function(data){
			                      Swal.fire(
			                        'Deleted!',
			                        'Emsat has been deleted.',
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
