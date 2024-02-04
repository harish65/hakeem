@extends('layouts.vertical', ['title' => 'Waiting Screen'])

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
                        <li class="breadcrumb-item active">Waiting Screen</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Waiting Screen Listing</h5>
               <a href="{{ url('admin/waiting/create')}}" class="btn btn-sm btn-info float-right">Add Waiting Screen</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                  <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                <thead>
                <tr >
                    <th>Sr No.</th>
                    <th>Category/Subcategory Name</th>
                    <th>Image</th>
                    <th>Video</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($waitingscreen as $key =>  $waiting)
                    <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $waiting->getCategory($waiting->category_id)->name }}</td>
                      <td><image src="{{ Storage::disk('spaces')->url('thumbs/'.$waiting->image) }}"></td>
                      <td>
                        <video width="400" controls>
                          <source src="{{ Storage::disk('spaces')->url('video/'.$waiting->video) }}" type="video/mp4">
                        </video>
                      </td>
                      <td>
                      <li  title="Edit" style="display:inline;"><a href="#" class="btn btn-sm btn-info"><i class="fas fa-edit" style="cursor: pointer;"></i></a></li>
			              	<li  title="Delete" style="display:inline-block;"><button data-user_id="#" class="btn btn-sm btn-danger deleteConsultant"><i class="fe-trash"></i></button>
			              	</li>
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
</script>
@endsection
