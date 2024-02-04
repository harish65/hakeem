@extends('layouts.vertical', ['title' => __('Doctors') ])
@section('css')
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
<style>
    .loader {
        /* position:fixed; */
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    .toast-error{
       background-color: red;
    }
</style>
<style>
    .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem; }
  .toggle.ios .toggle-handle { border-radius: 20rem; }
  
  </style>
  

@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box mt-2">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin_dashboard') }}">List {{
                                __('text.Clinic') }}</a></li>
                        <li class="breadcrumb-item active">Upload</li>
                    </ol>
                    <a href="{{ url('/clinic/upload_documnets' ,$id)}}" class="btn btn-sm btn-info float-right mb-1">Upload Document</a>
                </div>
                <h3 class="card-title">Documents List</h3>
            </div>
        </div>
    </div>
</div>
<!-- <div class="loader" id="loader"></div> -->


<div class="card ">
    <div class="card-body">
        
            <table id="scroll-horizontal-datatable" class="table w-100 nowrap" >
                <thead>
                    <tr>
                        <td>Sr no</td>
                        <td>Title</td>
                        <td>Description</td>
                        <td>Document Type</td>
                        <td>Document status</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @php $index = 0 ;@endphp
                    @foreach($sp_add_details as $sp_add_detail)
                    <tr>
                        
                        
                            <td>{{ $index}}</td>bb
                            <td>{{ $sp_add_detail->title }}</td>
                            <td>{{ $sp_add_detail->description }}</td>
                            <td>{{ $sp_add_detail->type }}</td>
                            <td>{{ $sp_add_detail->status }}</td>
                            <td>
                                <a title="Edit" href="{{ url('/clinic/update_upload_documnets' , [$sp_add_detail->sp_id , $sp_add_detail->id])}}" class="btn btn-primary"><i class="fa fa-file"></i></a>
                                <a title="Remove" href="javaScript:void(0)" class="btn btn-danger delete-doc" data-id="{{ $sp_add_detail->id }}" data-sp_id="{{ $id }}"><i class="fa fa-trash"></i></a>
                            </td>
                       
                    </tr>
                    @php $index++ ;@endphp
                    @endforeach
                </tbody>
            </table>
        </div>

 
</div>


@endsection
@section('script')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script>
        $(function () {
                   
        })
        $('#parent-category').on('change', function () {            
            

            if ($(this).val()) {
                var cateID = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    // url: base_url + 'profile/profile-step-two/492',
                    url: base_url + '/profile/doc_categories/?cat_id=' + cateID,
                    success: function (response) {
                        var data = JSON.parse(response)                          
                        if(data.length > 0){
                            var html = '';
                            html += '<option value="">Choose Option</option> '
                            $.each(data, function (i, item) {
                                html += '<option value=' + item.id + '>' + item.name + ' </option> '
                            });
                            $('#doc-category').html(html).focus()
                                if($('.doc-div').hasClass('d-none')){
                                    $($('.doc-div').removeClass('d-none'))
                                }
                           
                        }else{
                            swal({  title: "No Data found in this category!"  , 
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,});
                             //toastr.error("No Data found in this category!");
                           
                        }
                        
                    }
                });
            }
        })

        $('#submitBtn').on('click', function () {            
            
            // if($('#doc-category').val() !== ''){
            //    
            //     return toastr.error("Document category can not be empty");
            // }
            // if(document.getElementById("image_uploads").files.length == 0 ){
            //    
            //     return toastr.error("File can not empty");
            // }
            // if($('#title').val() !== '' ){
            //    
            //     return toastr.error("Title can not empty");
            // }
                var cateID = $(this).val('');
                var fd = new FormData(document.getElementById("UploadDocumentForm"));    
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: base_url + '/profile/add_doc',
                    data : fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (response) {
                        Swal.fire(
                                'Success!',
                                'Document uploaded successfully!',
                                'success'
                                )
                           
                            location.reload();
                    }
                });
            })
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
    </script>
  <script>
    $(document).on('click' , '.delete-doc' , function(){
        var id = $(this).attr('data-id')
        var sp_id = $(this).attr('data-sp_id')
        const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $.post("{{ url('/clinic/doc_delete') }}", { _token: "{{ csrf_token() }}", id:id , sp_id:sp_id }).done(function(data){
        
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            })
                } else if (
                /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                    'Cancelled',
                    '',
                    'error'
                    )
                    }
                });
    })
  </script>

@endsection