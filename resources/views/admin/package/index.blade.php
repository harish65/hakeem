	@extends('layouts.vertical', ['title' => 'Packages'])

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
                            <li class="breadcrumb-item active">Packages</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div> 
		<div class="row">
		    <div class="col-12">
		      <div class="card">
		        <div class="card-header">
		          <h5 class="card-title">Package Listing</h5>
		           <a href="{{ url('admin/package/create')}}" class="btn btn-sm btn-info float-right">Add New Package</a>
		        </div>
		        <!-- /.card-header -->
		        <div class="card-body">
		          	<table id="scroll-horizontal-datatable" class="table w-100 nowrap">
		            <thead>
		            <tr >
		            	<th>Sr No.</th>
		            	<th>Title</th>
		            	<th>Total Requests</th>
		            	<th>Category</th>
		            	<th>Package Type</th>
						<th>Created By</th>
		            	<th>Price</th>
		            	<th>Enable</th>
		            	<th>Image</th>
		            	<th>Action</th>
		            </tr>
		            </thead>
		            <tbody>
		             @foreach($packages as $index => $package)
			            <tr>
							<td>{{ $index+1 }}</td>
							<td>{{ $package->title }}</td>
							<td>{{ $package->total_requests }}</td>
							<td>{{ ($package->category)?(($package->filter_option)?$package->filter_option->option_name:$package->category->name):'NA' }}</td>
							<td>{{ $package->package_type }}</td>
							<td>{{ ($package->created_by == null) ? 'Admin' : 'Doctor' }}</td>
							<td>{{ $package->price }}</td>
							<td>{{ ($package->enable)?"True":"False" }}</td>
							<td>@if($package->image) <img height="50px" width="50px" src="{{ Storage::disk('spaces')->url('thumbs/'.$package->image) }}"> @endif</td>
							@if(config('client_connected') && (Config::get("client_data")->domain_name == "curenik"))
							@if($package->created_by != null)
			            	<td>
								<a data-approved="{{ ($package->enable == 1)?'true':'false' }}" data-consultant_id="{{ $package->id }}"  style="color:white;" class="btn btn-sm btn-{{ ($package->enable == 1)?'info':'danger' }} float-left approvePackage">{{ ($package->enable == 1)?'Approved':'False' }}</a>
								<a href="{{ url('admin/consultants') .'/'.$package->created_by }}" class="btn btn-sm btn-info float-left">profile</a>
			              	</td>
							@else
							<td>
			              		<a href="{{ url('admin/package') .'/'.$package->id.'/edit'}}" class="btn btn-sm btn-info float-left">Edit</a>
			              	</td>
							@endif
							@else
							<td>
			              		<a href="{{ url('admin/package') .'/'.$package->id.'/edit'}}" class="btn btn-sm btn-info float-left">Edit</a>
			              	</td>
							@endif
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
    		$(".delete-banner").click(function(e){
			          e.preventDefault();
			          var banner_id = $(this).attr('data-banner_id');
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
			                   url:base_url+'/admin/banner/'+banner_id,
			                   data:{id:banner_id},
			                   success:function(data){
			                      Swal.fire(
			                        'Deleted!',
			                        'Banner has been deleted.',
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

		$(".approvePackage").on('click',function(e){
          var __this = $(this);
          var consultant_id = __this.attr('data-consultant_id');
          var approved = __this.attr('data-approved');
			var Textapproved= "Approved";
			var Textdisbale= "Approve";
		  	if(approved == 'true'){

			   Textapproved="Disabled";
			   Textdisbale = "Disable";
		  	}
         // if(approved=='false'){
            Swal.fire({
              title: 'Are you sure?',
              text: "You want to "+Textdisbale+" this package",
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, '+Textapproved+' !'
            }).then((result) => {
              if (result.value) {
				  
                  $.ajax({
                     type:'POST',
                     url:base_url+'/admin/verifypackage/',
                     data:{id:consultant_id,account_verify_ajax:'true',enable:approved},
                     success:function(data){
                        Swal.fire(
							Textapproved+'!',
                          'Package has been '+Textapproved+' .',
                          'success'
                        ).then((result)=>{
                          __this.attr('data-approved','true');
                          __this.text(Textapproved);
                          location.reload();
                        });
                     }
                  });
                }
            });
         //}
  		});
    </script>
@endsection