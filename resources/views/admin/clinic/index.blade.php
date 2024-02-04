@extends('layouts.vertical', ['title' => 'View '.__('text.Clinic')])
@section('css')
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
  
  <!-- Plugins css -->
  <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="container-fluid">
<!-- start page title -->
<div class="row">
  <div class="col-12">
      <div class="page-title-box mt-2">
          <div class="page-title-right">
              <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                  <li class="breadcrumb-item active">{{ __('text.Clinic') }}</li>
              </ol>
              <a href="{{ route('create_request') }}" class="btn btn-sm btn-info float-right mb-1 ml-2">Add New</a>
              <!-- <a href="#" class="btn btn-sm btn-success float-right mb-1 ml-2 radius" data-toggle="modal" data-target="#radius_modal"><i class="fa fa-plus"></i> Add Radius</a> -->

          </div>
          <h3 class="card-title">{{ __('text.Clinic') }}</h3>
      </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
             <div class="col-md-2">
               <button class="btn form-control btn-sm btn-danger float-left" type="button" id="delete_user">Delete!</button>
             </div>    
       </div>
       <br>
          <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
          <thead>
          <tr >
              <th><input type="checkbox" id="selectAllchkBox"></th>
              <th>Sr No.</th>
              <th>Name</th>   
              <th>Email</th>        
              <th>Phone</th>        
              <th>Add Doctors</th>
              <th>Logo</th>
              <th>Action</th>
             
             
          </tr>
          </thead>
          <tbody>
          @foreach($clinics as $index => $clinic)
              <tr>
                <td><input type="checkbox" data-user="{{ $clinic->id }}"></td>
                <td>{{ $index+1 }}</td>
                <td>{{ $clinic->name }}</td>
                <td>{{ $clinic->email }}</td>
                <td>{{ $clinic->phone }}</td>
                <td>
                  <a href="{{ route('doctors' , $clinic->id) }}" class="btn btn-sm btn-info"><i class="fas fa-plus" style="cursor: pointer;"></i></a>
                  <a href="{{ route('get_doctors' , $clinic->id) }}" data-id="{{ $clinic->id }}" class="btn btn-sm btn-info view-doctors"><i class="fas fa-eye" style="cursor: pointer;"></i></a>
                </td>
                <td>
                  @if($clinic->profile_image)
                    <img src="{{ Storage::disk('spaces')->url('uploads/'.$clinic->profile_image) }}" height="50" width="50" id="frame" style="border-radius:100px;" >
                  @else
                  <img src="{{ asset('assets/images/logo_clinic.png')}}" height="50" width="50" id="frame" >

                  @endif
                </td>
                <td><a href="{{ route('edit_request' , $clinic->id) }}" class="btn btn-sm btn-info"><i class="fas fa-edit" style="cursor: pointer;"></i></a>
                    <a href="javaScript:void(0)" data-user="{{ $clinic->id }}" class="btn btn-sm btn-danger deleteConsultant"><i class="fas fa-trash" style="cursor: pointer;"></i></a>
                    <button data-user_id="{{ $clinic->id }}" data-user_name="{{ $clinic->name }}" class="btn btn-sm btn-success openPasswordModal"><i class="fas fa-key"></i>
                    
								  </button>

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

<div id="pwdModal" data-user_id="" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog">
	  <div class="modal-content">
	      <div class="modal-header" style="display:inline;">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	          <h3>Reset Password?</h3>
	      </div>
	      <div class="modal-body">
	          <div class="col-md-12">
	                <div class="panel panel-default">
	                    <div class="panel-body">
	                        <div>
	                          <p>If User have forgotten password you can reset it here.</p>
	                          <p>Name:<b id="m_userName"></b></p>
	                            <div class="panel-body">
	                                <fieldset>
	                                    <div class="form-group">
                                      <input type="password" name="pwd" id="input-pwd" class="form-control validate" required>
                                      <label data-error="wrong" data-success="right" for="input-pwd">Password</label>
                                      <span toggle="#input-pwd" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                      <br>
                                      <span class="alert-danger" id="password_error"></span>
	                                    </div>
	                                    <input class="btn btn-lg btn-primary btn-block" id="resetPassword" value="Reset" type="submit">
	                                </fieldset>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	      </div>
	      <div class="modal-footer">
	          <div class="col-md-12">
	          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
			  </div>
	      </div>
	  </div>
	  </div>
	</div>

  <div id="radius_modal"  class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header" style="display:inline;">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3>Add Radius</h3>
		</div>
		<div class="modal-body">
			<div class="col-md-12">
				  <div class="panel panel-default">
					  <div class="panel-body">
						  <div>
							  <div class="panel-body">
								  <fieldset>
									  <div class="form-group">

											<label for="balance">Radius <i><small>(In Kilometers)</small></i></label>
                      <form method="post" id="radiusForm">
                          <input type="number" name="radius" id="balance" class="form-control validate" required>
                          
                      </form>  
									  </div>
									  
								  </fieldset>
							  </div>
						  </div>
					  </div>
					  <div class="panel-footer">
						<button type="button" class="btn btn-sm btn-success float-right" id="add-radius">Submit</button>
						&nbsp;
						<button type="button" class="btn btn-sm btn-danger float-right mr-2" data-dismiss="modal">Cancel</button>
					  </div>
				  </div>
			  </div>
		</div>
	</div>
	</div>
  </div>
</div>

@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <!-- <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script> -->
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
<script>
  $(function(){
    $("input[type='search']").wrap("<form>");
    $("input[type='search']").closest("form").attr("autocomplete","off");
  })
  $('#scroll-horizontal-datatable').on('click', '.deleteConsultant', function(e){
	          e.preventDefault();
	          var _this = $(this);
            var id = $(this).attr('data-user')	          
	          Swal.fire({
	            title: 'Do You Want To Delete This clinic ?',
	            text: "You won't be able to revert this!",
	            showCancelButton: true,
	            confirmButtonColor: '#3085d6',
	            cancelButtonColor: '#d33',
	            confirmButtonText: 'Yes, delete it!'
	          }).then((result) => {
	            if (result.value) {
                $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                });
	                $.ajax({
	                   type:'POST',
	                   url:base_url+'/admin/clinic/delete_request/' + id,
	                   data:{"user_id":id},
	                   success:function(data){
	          			 _this.parents('tr').remove();
	                      Swal.fire(
	                        'Deleted!',
	                        'Clinic has been deleted.',
	                        'success'
	                      ).then((result)=>{
	                        window.location.reload();
	                      });
	                   }
	                });
	              }
	          });
	    });

      //Add radius
      $('.radius').click(function(){
        var _user = $(this).data('clinic_id')
        $('#clinic_id').val(_user);
      })
      $('#add-radius').click(function(){
        var formData = new FormData(document.getElementById("radiusForm"));
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
            });
            $.ajax({
                    type:'POST',
                    url:base_url+'/admin/clinic/add-radius',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
	                   success:function(data){
                        data = JSON.parse(data)
                        console.log(data.success)
                        
                                Swal.fire(
                                'Success !',
                                  data.message,
                                'success'
                                ).then((result)=>{
                                  window.location.reload();
                                });
                       
	          			
                      }
	                });
      })
      $('#scroll-horizontal-datatable').on('click', '.openPasswordModal', function(e){
			e.preventDefault();
			$("#pwdModal").attr('data-user_id','');
	        var _this = $(this);
	        var user_id = $(this).attr('data-user_id');
	        var name = $(this).attr('data-user_name');
			e.preventDefault();
			$("#pwdModal").modal('toggle');
			$("#pwdModal").attr('data-user_id',user_id);
			$("#m_userName").text(name);
		});

      $('#resetPassword').on('click', function(e){
			e.preventDefault();
	        let user_id = $("#pwdModal").attr('data-user_id');
	        let password = $("#input-pwd").val();
	        if(!password){
	        	$("#password_error").text("Please fill the password");
	        	return false;
	        }
	        if(password.length<5){
	        	$("#password_error").text("password should be minimum 5 character");
	        	return false;
	        }
	        _this = $(this);
	        _this.val('Please wait...');
          $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                });
	        $.ajax({
               type:'PUT',
               url:base_url+'/admin/consultants/'+user_id,
               data:{id:user_id,account_password_ajax:'true',password:password},
               success:function(data){
               	  $("#input-pwd").val('');
                  Swal.fire(
                    'Reset Successful',
                    'Password has been Reset.',
                    'success'
                  ).then((result)=>{
                  	_this.val('Reset');
                  	$("#pwdModal").modal('toggle');
					$("#pwdModal").attr('data-user_id',user_id);
                  });
               },error:function(data){
               		_this.val('Reset');
               		Swal.fire(
                    'Reset!',
                    'Something went wrong',
                    'error'
                  );
               }
            });

		});
    $('.toggle-password').on('click', function() {
		  $(this).toggleClass('fa-eye fa-eye-slash');
		  let input = $($(this).attr('toggle'));
		  if (input.attr('type') == 'password') {
		    input.attr('type', 'text');
		  }
		  else {
		    input.attr('type', 'password');
		  }
		});


    $("#delete_user").click(function(e){
	          e.preventDefault();
	          var _this = $(this);
	          var user_ids = [];
	          $(' input[type="checkbox"]').each(function() {
			        if ($(this).is(":checked")) {
			        	if($(this).data('user')){
				          user_ids.push($(this).data('user'));
			        	}
			        }
			  });
			  if(user_ids.length > 0){
		          Swal.fire({
		            title: 'Do You Want To Delete This '+doctor_text+' ?',
		            text: "You won't be able to revert this!",
		            showCancelButton: true,
		            confirmButtonColor: '#3085d6',
		            cancelButtonColor: '#d33',
		            confirmButtonText: 'Yes, delete it!'
		          }).then((result) => {
		            if (result.value) {
		                $.ajax({
		                   type:'POST',
		                   url:base_url+'/admin/consultants/delete-doctor',
		                   data:{"user_id":user_ids},
		                   success:function(data){
		                      Swal.fire(
		                        'Deleted!',
		                        doctor_text+' has been deleted.',
		                        'success'
		                      ).then((result)=>{
		                        window.location.reload();
		                      });
		                   }
		                });
		              }
		          });
			  }else{
			  	alert("Please select atleast one Professional.");
			  	return false;
			  }
	    });
</script>
@endsection
