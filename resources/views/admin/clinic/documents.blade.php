@extends('layouts.vertical', ['title' => __('Doctors') ])
@section('css')
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
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
    .loader-outer {
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        height: 100vh;
        justify-content: center;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 99999999;
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
                </div>
                <h3 class="card-title">Upload Documents</h3>
            </div>
        </div>
    </div>
</div>
<div class="loader-outer" id="loader"><div class="loader" ></div></div>


<div class="card card-primary">
    <form role="form" autocomplete="off"  enctype="multipart/form-data" id="UploadDocumentForm" method="post">
        <div class="card-body upload-docs ">
            <h3> Categories </h3>
            <p><i><u>( Let us know which category suits most for this doctor's profile to continue )</u></i></p>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phone">Select category</label>
                    <select name="category" class="form-control" id="parent-category">
                                <option value="">Choose Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                    </select>
                </div>
            </div>
            <div class="row doc-div d-none">
                <div class="form-group col-md-6">
                    <label for="phone">Select Document category</label>
                    <select name="doc_category" class="form-control"  id="doc-category"></select>
                    </div>
            
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <label for="image_uploads" class="form-label">File</label>
                        <input class="form-control form-control-lg file" name="image_uploads" id="image_uploads" type="file" />
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Title</label>
                        <input class="form-control form-control-lg" id="doc_category"  type="text" name="title" />
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">description</label>
                        <input class="form-control form-control-lg" id="" type="text" name="description" />
                        <input  type="hidden" value="{{ $id }}" name="user_id" />
                    </div>
                </div>


            </div>
        </div>
        <div class="card-footer">
            <button type="button" id="submitBtn" class="btn btn-primary">Submit</button>
            <a class="btn btn-info" href="{{ route('admin_dashboard')}}">Cancel</a>
        </div>
    </form>
</div>


@endsection
@section('script')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(function () {
        $('#loader').hide()
       
        $('#parent-category').on('change', function () {            
            //$('#loader').show()

            if ($(this).val()) {
                var cateID = $(this).val();
                var user_id = '{{ $id }}'
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    data:  {user_id:user_id},
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
                            $('#loader').hide()
                        }else{
                            swal.fire({  title: "No data found in this category!"  , 
                                    icon: "error",
                                    buttons: true,
                                    dangerMode: true,});
                        }
                        $('#loader').hide()
                        
                    }
                });
            }else{
                $('#loader').hide()

            }
        })

        $('#submitBtn').on('click', function () {            
            $('#loader').show()
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
                        $('#loader').hide()
                        swal.fire({  title: "Dcoumment uploaded!"  , 
                                    icon: "success",
                                    buttons: true,
                                    dangerMode: false,});
                            
                        window.location.href = base_url + '/clinic/edit_upload_documnets/' + '{{ $id }}' ;   
                    }
                });
            })
        
            
                
            })

    </script>
  

@endsection