@extends('vendor.iedu.layouts.index', ['title' => 'Set Availability','show_footer'=>true])
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
          <h4 class="mb-3">Signup for IEDU</h4>
          <p>Set up your personal, category and work details</p>
          <div class="upoad-profile">
              <h3>Set your Availability</h3>

          </div>
          @if(Config('client_connected') && Config::get('client_data')->domain_name == 'iedu')
        @php $currency = 'AED';  @endphp
    @else
        @php $currency = '₹'; @endphp
    @endif
             <form class="availbilityform"  method="post" action="{{url('/profile/add_availbility')}}">
                  @csrf
                  <div class="consult">
                    <h5>Price</h5>
                    {{$currency}} <input type="text" name="price" value="" class="price" required/>
                  </div>
                  <div class="modal-body p-0 pt-3 pb-3">
                    <h6>Week Days</h6>
                    <div class="button-group-pills btn-simple text-center" data-toggle="buttons">
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
                        <input type="hidden" name="service_id" class="serviceid" value="@if(isset($service_id)){{$service_id}}@endif">
                        <input type="hidden" name="category_id" class="categoryid" value="@if(isset($category_id)){{$category_id}}@endif">

                        <h6 class="pt-3">Select Time</h6>
                        <div id="customFields">
                          <div class="new_row row align-items-center">
                              <div class="col-md-11 col-10 interv_div" >
                                  <div class="row common-form">
                                      <div class="col-sm-6">
                                          <div class="form-group">
                                              <label>From</label>
                                                <div class="time_icon position-relative ">
                                                <input class="form-control timepicker" type="text" placeholder="11:00" name="start_time[]" required>
                                                <i class="fa fa-clock-o icon-pos icon-time" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                      </div>
                                      <div class="col-sm-6">
                                          <div class="form-group">
                                              <label>To</label>
                                              <div class="time_icon position-relative ">
                                              <input class="form-control timepicker" type="text" placeholder="11:00 " name="end_time[]" required>
                                              <i class="fa fa-clock-o icon-pos icon-time" aria-hidden="true"></i>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-1 col-2">
                                  <label> </label>
                                  <a class="remCF del-ic" href="#"><i class="fa  fa-trash-o"></i></a>
                              </div>
                          </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-12">
                                <a class="newrow" href="#"><i class="fa fa-plus"></i> New Interval</a>
                            </div>
                        </div> --}}
                        <div class="form-group spacing-eight mt-6 my-3 flex-bt">
                          <a  class="back-black"href="{{url('/profile/profile-step-two/')}}/{{Auth::user()->id}}"> < Back</a>
                          <input type="submit" class="btn rounded  radius-btn" id="add_availbility" name="Save" value="Next">
                        </div>

                    </div>
                  </div>
              </form>

        </div>



        </div>
      </div>


    </div>
  </div>
</section>

@endsection
