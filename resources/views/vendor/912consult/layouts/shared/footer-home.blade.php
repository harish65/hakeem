 <!-- Add Availability Modal -->
 <div class="modal fade" id="ServiceModal">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
        <button type="button" class="close" data-dismiss="modal">
          <img src="{{asset('assetss/images/ic_cancel.png')}}" alt="">
        </button>
        <h4 class="modal-title login-head">
          <div class="row">
          <div class="col-8">
            Upload Documents
          </div>
          <div class="col-4">
            <button type="button" data-cat-id="" class="default-btn radius-btn w-100" id="add_doc">+ Add</button>
          </div>
        </h4>
      </div>
      <div class="modal-body px-4 pt-2 pb-3">
        <div class="table-responsive upload-documents-modal">
          <table class="table">
            <tbody id="doc_list">

              <tr>
                <td>Masters</td>
                <td>
                  <div class="document-image-wrap">
                    <img src="{{asset('assetss/images/ic_98.png')}}">
                  </div>
                </td>
                <td>
                  <a href=""  data-toggle="modal" data-target="#myModal"><i class="fas fa-edit mr-2"></i> <i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>

              <tr>
                <td>Masters</td>
                <td>
                  <div class="document-image-wrap">
                    <img src="{{asset('assetss/images/ic_98.png')}}">
                  </div>
                </td>
                <td>
                  <a href=""><i class="fas fa-edit mr-2"></i> <i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>

              <tr>
                <td>Masters</td>
                <td>
                  <div class="document-image-wrap">
                    <img src="{{asset('assetss/images/ic_98.png')}}">
                  </div>
                </td>
                <td>
                  <a href=""><i class="fas fa-edit mr-2"></i> <i class="fas fa-trash-alt"></i></a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- The Modal -->
<div class="modal fade" id="myModal">
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
                        <form action="{{ url('/profile/add_doc') }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <div class="position-relative document-upload-block">
                              <img class="user-profile showImg rounded-circle" src="{{asset('assetss/images/document1.png')}}" alt="" >
                              <div class="img-wrapper position-absolute">
                                  <input type="hidden" name="user_id" id="user_id" value="{{Request::segment(3)}}">
                                  <label for="image_uploads" class="img-upload-btn"><i class="fas fa-camera"></i> </label>
                                  <input type="file" id="image_uploads" name="image_uploads" accept=".jpg, .jpeg, .png" style="opacity: 0;" required>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Category</label>
                                      <select id="doc_cats" class="form-control" name="doc_category" required id=""></select>
                                  </div>
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
                                  <button type="submit" class="default-btn radius-btn w-100"><span>Save</span></button>
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
                        <form action="{{ url('/profile/edit_doc') }}" method="post" enctype="multipart/form-data">
                          {{ csrf_field() }}
                          <input type="hidden" name="doc_id">
                          <div class="position-relative document-upload-block">
                              <img  class="user-profile showImg rounded-circle" src="{{asset('assetss/images/document1.png')}}" alt="" >
                              <div class="img-wrapper position-absolute">
                                  <label for="image_uploads_edit" class="img-upload-btn"><i class="fas fa-camera"></i> </label>
                                  <input type="file" id="image_uploads_edit" required name="image_uploads" accept=".jpg, .jpeg, .png" style="opacity: 0;">
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label>Category</label>
                                      <select disabled id="doc_cats_edit" class="form-control" name="doc_category" required id=""></select>
                                  </div>
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
                                  <button type="submit" class="default-btn radius-btn w-100"><span>Save</span></button>
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


<!-- availbility -->

 <!-- Add Availability Modal -->
<section class="availability-popup">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="modal fade" id="addAvailbityModal">
          <div class="modal-dialog modal-md ">
              <div class="modal-content ">
                  <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                      <button type="button" class="close" data-dismiss="modal">
                          <img src="{{asset('assetss/images/ic_cancel.png')}}" alt="">
                      </button>
                      <h4 class="modal-title login-head">Add availability</h4>
                      <hr>
                  </div>
                  <form class="availbilityform" id="add_availbility_form"  method="post" action="{{url('/profile/add_availbility')}}">
                  @csrf
                  <input type="hidden" name="user_id" value="{{Request::segment(3)}}">
                  <div class="modal-body px-4 pt-2 pb-3">
                  <h6>Week Days</h6>
                  <div class="button-group-pills text-center required" data-toggle="buttons">
                        <label class="btn btn-default active">
                          <input type="checkbox" name="options[]"  value="0">
                          <div>S</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="1">
                          <div>M</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="2">
                          <div>T</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="3">
                          <div>W</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="4">
                          <div>T</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="5">
                          <div>F</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]" value="6">
                          <div>S</div>
                        </label>
                      </div>
                      <input type="hidden" name="service_id" class="serviceid">
                      <input type="hidden" name="category_id" class="categoryid">
                      <h6 style="display:none;">Select Date</h6>
                      <div class="date-carousel px-5 mt-4 mb-5" style="display:none;"  >
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Today</label>
                                  <h6>Jun 22, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Tomorrow</label>
                                  <h6>Jun 23, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Wednesday</label>
                                  <h6>Jun 24, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Thursday</label>
                                  <h6>Jun 25, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Friday</label>
                                  <h6>Jun 26, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Tomorrow</label>
                                  <h6>Jun 23, 20</h6>
                              </div>
                          </div>
                          <div>
                              <div class="date-box">
                                  <label class="d-block">Wednesday</label>
                                  <h6>Jun 24, 20</h6>
                              </div>
                          </div>
                      </div>
                      <h6>Select Time</h6>
                      <div id="customFields">
                        <div class="new_row row align-items-center">
                            <div class="col-11 pr-0 interv_div" >
                                <div class="row common-form">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>From</label>
                                            <input class="form-control" id="start_time_0" type="time" placeholder="11:00 am" name="start_time[]" required onchange="check_slots_validity(this, 'start', 0, 'addAvailbityModal')">
                                            <span class="start_time_0"></span>

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>To</label>
                                            <input class="form-control" id="end_time_0" type="time" placeholder="11:00 am" name="end_time[]" required onchange="check_slots_validity(this, 'end', 0, 'addAvailbityModal')">
                                            <span class="end_time_0"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <label></label>
                                <a class="remCF" href="#"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                      </div>
                      <div class="row">
                          <div class="col-12">
                              <a class="newrow" href="#"><i class="fas fa-plus"></i> New Interval</a>
                          </div>
                      </div>
                      <div class="form-group spacing-eight mt-6 mb-3">
                        <input type="button" class="default-btn w-100 radius-btn" id="add_availbility" name="Save" value="Save" onclick="submit_availbility_form()">
                      </div>
                      <div class="row no-gutters spacing-eight mt-6 mb-3" style="display:none;">
                          <div class="col-sm-4">
                              <a class="default-btn radius-btn border-btn w-100 px-2" href="#"><span>All Weekdays</span></a>
                          </div>
                          <div class="col-sm-3">
                              <a class="default-btn radius-btn border-btn w-100 px-2" href="#"><span>For Jun 24, 20</span></a>
                          </div>
                          <div class="col-sm-3">
                              <a class="default-btn radius-btn border-btn w-100 px-2" href="#"><span>All Wednesday</span></a>
                          </div>
                      </div>
                  </div>
                </form>
              </div>
          </div>
        </div>

        <div class="modal fade" id="editAvailbityModal">
          <div class="modal-dialog modal-md ">
              <div class="modal-content ">
                  <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                      <button type="button" class="close" data-dismiss="modal">
                          <img src="{{asset('assetss/images/ic_cancel.png')}}" alt="">
                      </button>
                      <h4 class="modal-title login-head">Edit availability</h4>
                      <hr>
                  </div>
                  <form class="availbilityform" method="post" action="{{url('/profile/edit_availbility')}}">
                    @csrf
                    <!-- <input type="hidden" name="service_id"> -->
                    <input type="hidden" name="category_id" class="categoryid">

                  <div class="modal-body px-4 pt-2 pb-3">
                  <h6>Week Days</h6>
                  <div class="button-group-pills text-center" data-toggle="buttons">
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]" value="0">
                          <div>S</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="1">
                          <div>M</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="2">
                          <div>T</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="3">
                          <div>W</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="4">
                          <div>T</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]"  value="5">
                          <div>F</div>
                        </label>
                        <label class="btn btn-default">
                          <input type="checkbox" name="options[]" value="6">
                          <div>S</div>
                        </label>
                      </div>
                      <input type="hidden" name="service_id" class="serviceid">
                      <h6>Select Time</h6>
                      <div id="customFields">
                      </div>
                      <div class="row">
                          <div class="col-12">
                              <a class="newrow" href="#"><i class="fas fa-plus"></i> New Interval</a>
                          </div>
                      </div>
                      <div class="form-group spacing-eight mt-6 mb-3">
                        <input type="hidden" name="user_id" value="{{Request::segment(3)}}">
                        <input type="submit" class="default-btn w-100 radius-btn" id="add_availbility" name="Save" value="Update">
                      </div>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="logoutConfirm" class="modal fade">
  <div class="modal-dialog modal-confirm ">
    <div class="modal-content">

      <div class="modal-body">
         <h1 class="modal-title w-100 text-center display-3">Logout Confirmation!</h1>
        <h4 class="text-center">Are you sure you want to logout?</h4>
      </div>
      <div class="modal-footer d-flex flex-direction-row flex-nowrap bt-0">
        <button class="btn btn-success btn-block lout-cnfrm" data-dismiss="modal">Yes</button>
         <button class="btn btn-danger btn-block " data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
</section>
