@extends('vendor.iedu.layouts.index', ['title' => 'Subjects','show_footer'=>true])
@section('content')
<!-- Header section -->
<section class="login-section">
  <div class="container-fluid px-0">
    <div class="row no-gutters">
      <div class="col-md-5">
        <div class="logo-side position-relative">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{asset('assets/iedu/images/ic_1.png')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('assets/iedu/images/ic_1.png')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('assets/iedu/images/ic_1.png')}}" class="d-block w-100" alt="...">
              </div>
            </div>
          </div>
          <div class="vertical-center text-center full-width"><a href=""><img class="img-fluid logo" src="{{asset('assets/iedu/images/ic_2.png')}}"></a></div>
        </div>
      </div>
      <div class="offset-md-1 col-md-5">
        <div class="form-side">
          <div class="top-bar pt-4">
            <!-- <p>Already a member ? <a href=""> Sign In</a></p> -->
          </div>
        <div class="vertical-center22 full-width tutor-sign-up-form">
          <h4 class="mb-3">Signup for iEDU</h4>
          <p>Set up your personal, category and work details</p>
          <div class="upload-profile">
              <h3 class="doc-upto">Upload Documents</h3>

              @if(session('status.success'))
                  <div class="alert alert-outline alert-success custom_alert">
                      {{ session('status.success') }}
                  </div>
              @endif

              @if(session('status.error'))
                  <div class="alert alert-outline alert-danger custom_alert">
                      {{ session('status.error') }}
                  </div>
              @endif


              @if($fetch_category)
              @foreach($fetch_category as $category)
              <div class="content-body">
                <div class="row align-items-center mb-2"  id="">

                      <div class="col-md-6 col-6">
                          {{$category->name}}
                        </div>
                      <div class="col-md-6 col-6">
                        <button type="button" data-cat-id="{{$category->id}}" class="btn rounded add_doc pull-right" >+ Add</button>
                      </div>

                  </div>
                  <div class="table-responsive upload-documents-modal">
                  <table class="table">
                  <tbody id="doc_list">

                    @foreach($category->documents as $document)
                  <tr>
                  <td>{{$document->title}}<br><span class="badge badge-secondary"></span></td>
                  <td>
                      <div class="document-image-wrap">
                          <img src="{{ Storage::disk('spaces')->url('thumbs/'.$document->file_name) }}"/>
                      </div>
                  </td>
                  <td class="text-right">
                      <a href="{{ url('/profile/doc_edit') }}/{{$document->id}}" class="edit_doc" data-id="{{$document->id}}"><i class="fa fa-edit mr-2"></i></a>
                      <a href="{{ url('/profile/doc_delete') }}/{{$document->id}}" class="delete_doc" data-id="{{$document->id}}"><i class="fa fa-times"></i></a>
                  </td>
                  </tr>
                    @endforeach

                  </tbody>
                </table>
                </div>
                </div>
              @endforeach
            @endif



          <div class="form-group back-steap">
              <a href="{{url('/profile/profile-step-two/')}}/{{Auth::user()->id}}"> < Back</a>
             <a href="{{url('/profile/profile-step-four-availbility/')}}/{{Auth::user()->id}}"> <button class="btn rounded"><span>Next</span></button></a>
            </div>
          </form>

          </div>








        </div>
        <!-- <div class="bottom-block">
          <div class="row"> -->
            <!-- <div class="col-md-7 pr-0">
              <small>©Copyright 2020 by Consumables and Stores. All Rights Reserved.</small>
            </div> -->
            <!-- <div class="col-md-5 text-right">
              <a href="">Privacy Policy<span class="ml-2 mr-2">•</span></a><a href="">   Terms & Conditions</a>
            </div> -->
          <!-- </div>
        </div> -->
        </div>
      </div>
    </div>
  </div>



  <!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Document Details </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body p-0">
        <section class="profile-wrapper edit-profile">
            <div class="row">
                <!-- <div class="col-12 mb-5">
                    <h1>Account</h1>
                </div> -->
                <div class="col-lg-12 profile-detail">
                    <div class="doctor_box border-0">
                        <form action="{{ url('/profile/add_doc') }}" method="post" enctype="multipart/form-data" id="new_doc">
                          {{ csrf_field() }}
                          <input type="hidden" name="doc_category" class="doc_category" value="" />
                          <label>Upload File</label>
                          <div class="position-relative document-upload-block2">
                              <!-- <img class="user-profile showImg rounded-circle" src="{{asset('assets/care_connect_live/images/338864.png')}}" alt="" > -->
                              <div class="img-wrapper2" >
                                  <!-- <label for="image_uploads" class="img-upload-btn"><i class="fa fa-camera"></i> </label> -->
                                  <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" style=";" required>
                               </div>
                          </div>
                          <div class="row">

                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Title</label>
                                      <input name="title" required class="form-control" type="text" placeholder="">
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Description</label>
                                      <input name="description" required class="form-control" type="text" placeholder="">
                                  </div>
                              </div>
                              <div class="offset-md-9 col-md-3">
                                  <button type="submit" id="new_doc_s" class="btn rounded radius-btn w-100"><span>Save</span></button>
                              </div>
                          </div>
                        </form>
                    </div>
                </div>
        </div>
    </section>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal_edit">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Document Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <section class="profile-wrapper edit-profile">
            <div class="row">
                <!-- <div class="col-12 mb-5">
                    <h1>Account</h1>
                </div> -->
                <div class="col-lg-12 profile-detail">
                    <div class="doctor_box">
                        <form action="{{ url('/profile/edit_doc') }}" method="post" enctype="multipart/form-data" id="edit_doc">
                          {{ csrf_field() }}
                          <input type="hidden" name="doc_id">
                          <div class="position-relative document-upload-block">
                              <img  class="user-profile showImg rounded-circle" src="{{asset('assets/care_connect_live/images/document1.png')}}" alt="" >
                              <div class="img-wrappe">
                                  <label for="image_uploads_edit" class="img-upload-btn"><i class="fa fa-camera"></i> </label>
                                  <input type="file" id="image_uploads_edit" required name="image_uploads" style="opacity: 0;" accept=".jpg, .jpeg, .png" style="opacity: 0;">
                              </div>
                          </div>
                          <div class="row">

                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Title</label>
                                      <input name="title" required class="form-control" type="text" placeholder="">
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Description</label>
                                      <input name="description" required class="form-control" type="text" placeholder="">
                                  </div>
                              </div>
                              <div class="offset-md-9 col-md-3">
                                  <button type="submit" id="edit_doc_s" class="btn rounded radius-btn w-100"><span>Save</span></button>
                              </div>
                          </div>
                        </form>
                    </div>
                </div>
        </div>
    </section>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal_blank">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Document Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <section class="profile-wrapper edit-profile">
            <div class="row">
                <!-- <div class="col-12 mb-5">
                    <h1>Account</h1>
                </div> -->
                <div class="col-lg-12 profile-detail">
                  <h3>No Record</h3>
                </div>
        </div>
    </section>
      </div>
    </div>
  </div>
</div>
</section>
<script>
        var _category_docs_url = "{{ url('/profile/docs') }}";
        var _category_id_url = "{{ url('/profile/doc_categories') }}";

        var _doc_img_path = "{{ asset('/') }}";

        var _doc_edit_path = "{{ url('/profile/doc_edit') }}/";
        var _doc_del_path = "{{ url('/profile/doc_delete') }}/";


        @if(session('next_needed_doc_id') && session('needed_cat_id'))
            var _next_needed_doc_id = "{{ session('next_needed_doc_id') }}";
            var _next_needed_cat_id = "{{ session('needed_cat_id') }}";
        @else
            var _next_needed_doc_id = null;
        @endif

        $(document).ready(function () {

        $("#edit_doc").submit(function (e) {
                $("#edit_doc_s").attr("disabled", true);
                return true;

            });
        $("#new_doc").submit(function (e) {
                $("#new_doc_s").attr("disabled", true);
                return true;

            });
        });
    </script>


@endsection
