@extends('layouts.vertical', ['title' => __('Doctors') ])
@section('css')
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
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
                </div>
                <h3 class="card-title">Upload Documentsqqq</h3>
            </div>
        </div>
    </div>
</div>
<!-- <div class="loader" id="loader"></div> -->


<div class="card card-primary">
    <form role="form" autocomplete="off" action="{{ url('clinic/update-document') }}"  enctype="multipart/form-data"  method="post">
    @csrf    
    <div class="card-body upload-docs ">
            <h3> Categories </h3>
            <p><i><u>( Let us know which category suits most for this doctor's profile to continue )</u></i></p>
            <div class="row">
            <input name="id" type="hidden" value="{{ $sp_add_details->id }}">
            <input name="sp_id" type="hidden" value="{{ $id }}">
                <div class="form-group col-md-6">
                    <label for="phone">Select category</label>
                    <select name="category"  disabled class="form-control" id="parent-category">
                            <option value="">Choose Category</option>
                            @if($selectedCategory !== null)
                                @foreach($categories as $category)
                                        <option  {{ ($selectedCategory ==  $category->id) ? 'selected' : ''}}  value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @else
                            @foreach($categories as $category)
                                        <option   value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            @endif
                    </select>
                </div>
            </div>
            
            <div class="row doc-div">
                @php
                $sub_categories = \App\Model\AdditionalDetail::where('category_id', $selectedCategory)
                                    ->where('is_enable','=','1')
                                    ->orderBy('name',"ASC")
                                    ->get();
                                    
                @endphp
                <div class="form-group col-md-12"><h3>Uploaded Document</h3></div>
                
                <div class="form-group col-md-6">
                    <label for="phone">Select Document category</label>
                    <select name="doc_category" disabled class="form-control" id="doc-category">
                        <option value="">Choose Option</option>
                        @foreach($sub_categories as $sub_category)
                            <option {{ (@$sp_add_details->additional_detail_id == $sub_category->id) ? 'selected' :'' }} value="{{ $sub_category->id }}"> {{ $sub_category->name }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <label for="image_uploads" class="form-label">File</label>
                        <input class="form-control form-control-lg file" name="image_uploads" id="image_uploads" type="file" />
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Title</label>
                        <input class="form-control form-control-lg" id="doc_category" value="{{ @$sp_add_details->title }}"  type="text" name="title" />
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">description</label>
                        <input class="form-control form-control-lg" id="" type="text" value="{{ @$sp_add_details->description }}" name="description" />
                        
                    </div>
                </div>
            </div>
            
            <hr>
          
        </div>
        <div class="card-footer">
            <button type="submit"  class="btn btn-primary">Submit</button>
            <a class="btn btn-info" href="{{ route('admin_dashboard')}}">Cancel</a>
        </div>
    </form> 
</div>


@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
        $(function () {
                    $('#loader').hide()
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
                            console.log()
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
                            return toastr.error("No Data found in this category!");
                        }
                        
                    }
                });
            }
        })

        $('#submitBtn').on('click', function () {            
            
            // if($('#doc-category').val() !== ''){
            //     $('#loader').hide()
            //     return toastr.error("Document category can not be empty");
            // }
            // if(document.getElementById("image_uploads").files.length == 0 ){
            //     $('#loader').hide()
            //     return toastr.error("File can not empty");
            // }
            // if($('#title').val() !== '' ){
            //     $('#loader').hide()
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
                            toastr.success("Document Uploaded successfully");
                            $('#loader').hide()
                            location.reload();
                    }
                });
            })
        
    </script>
  

@endsection