@extends('layouts.vertical', ['title' => __('Doctors') ])
@section('css')
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style type="text/css">
	.offline_online{
		margin: 0 !important;
    	padding: 0!important;
    }
    .form-control.medium{
        height: 20px;
    }
</style>
<div class="container-fluid">
		<div class="row">
          <div class="col-12">
              <div class="page-title-box mt-2">
                  <div class="page-title-right">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                          <li class="breadcrumb-item active">Doctors</li>
                      </ol>
                      <!-- <a href="javaScript:void(0)" class="btn btn-sm btn-info float-right mb-1">Add New</a> -->
                  </div>
                  <h3 class="card-title">Doctors</h3>
              </div>
          </div>
      </div>
		<div class="row">
		    <div class="col-12">
		      <div class="card">
		        <!-- /.card-header -->
		        <div class="card-body">
                    <br>
		        	<table> 
				   </table>
		          	<table id="scroll-horizontal-datatable" class="table w-100 nowrap" >
		            <thead>
		            <tr >
    	                <!-- <th><input type="checkbox" id="selectAllchkBox"></th> -->
		            	<th>Sr No.</th>
		            	<!-- <th>Actions</th> -->
		            	<th>Name</th>
		            	<th>Email</th>
		            	<th>Contact</th>
		            	<th>Add In Clinic</th>
	            		
		            </tr>
		            </thead>
		            <tbody>
                        @foreach($consultants as $index => $consultant)
                            <tr class="delete_row">
                            <!-- <td><input type="checkbox" data-user="{{ $consultant->id }}"></td> -->
                            <td>{{ $index+1 }}</td>
                            <td>{{ $consultant->name }}</td>
                            <td>{{ $consultant->email }}</td>
                            <td>{{ $consultant->country_code.''.$consultant->phone }}</td>			              
                            <td><input class="form-control medium checkbox" value="{{ $consultant->id }}" type="checkbox" data-user="{{ $consultant->id }}"></td>
                            </tr>
                        @endforeach
		        	</tbody>
		          </table>
                  <hr>
                  <button class="btn btn-sm btn-info float-right mb-1" id="add_in_clinic">+ Add In Clinic</button>
				</div>
		          <div class="clear-fix"><br></div>
			</div>
		</div>
	</div>
	<!--modal-->	
</div>
@endsection
@section('script')
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<!-- <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script> -->
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		 
         var dataTable = $('#scroll-horizontal-datatable').DataTable({
         	"autoFill": false,
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
            initComplete: function() {
                $(this.api().table().container()).find('input[type=search]').parent().wrap('<form>').parent().attr('autocomplete', 'off');
            }
        });
	    
    });
	$(function () {
		var clicnicId = "{{  $clicnicId }}";
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Adding Doctors         
        $('#add_in_clinic').click(function(){
            var doctors = []
            $('.checkbox').each(function () {
                var docId = (this.checked ? $(this).val() : "");
                if(docId){
                    doctors.push(docId)
                }
            });
                $.ajax({
                        type:'POST',
                        url:base_url+'/admin/clinic/add_doctors/'+ clicnicId,
                        data:{"doctor_ids":doctors},
                        success:function(data){
                        data = JSON.parse(data)                           
                           if(data.success){
                                Swal.fire(
                                'Addded!',
                                'Doctors has been Added!.',
                                'success'
                                ).then((result)=>{
                                    window.location.reload();
                                });
                           }else{
                            console.log()
                            Swal.fire(
                                'Not Addded!',
                                'Error! Doctor Already Added',
                                'error'
                                ).then((result)=>{
                                        window.location.reload();
                                });
                           }
                        },
                        error: function(data){
                            comnsle.log(data)
                        }
                });



        })  

        




        

	});




</script>
@endsection
