<div class="modal fade" id="editAvailbityModal_manage">
          <div class="modal-dialog modal-md ">
              <div class="modal-content ">
                  <div class="modal-header d-block pt-3 px-4 pb-0 border-0">
                      <button type="button" class="close" data-dismiss="modal">
                          <img src="{{asset('assetss/images/ic_cancel.png')}}" alt="">
                      </button>
                      <h4 class="modal-title login-head">Edit availability</h4>
                      <hr>
                  </div>
                  <form class="availbilityform" id="edit_availbilty_form" method="post" action="{{url('/service_provider/add_availbility')}}">
                    @csrf

                  <div class="modal-body px-4 pt-2 pb-3">
                      <h6>Select Date</h6>
                      <div  class="bg-gray position-relative p-3 mt-4">
                        <ul class="days-list d-flex align-items-center" id="schedules" style="width:auto !important;">
                                @if(isset($data))
                                    @foreach($data as $kk=>$datas)
                                    @php $showDate = date('d M, y', strtotime($datas['date'])); @endphp
                                <li class="schedule_date" id="schedule_date_{{$kk}}" data-val = "{{$datas['date']}}" data-day="{{ $datas['day']}}">
                                    <a href="" >
                                    <span>{{ $datas['day']}}</span>
                                    <label class="m-0">{{ $showDate }}</label>
                                </a>
                                </li>
                                    @endforeach
                                <input type="hidden" name="slot_date" value="{{@$data[0]['date']}}" />
                                @endif

                        </ul>
                    </div>
                      <input type="hidden" name="service_id" class="serviceid">
                      <input type="hidden" name="category_id" class="categoryid">
                      <h6>Select Time</h6>
                      <div id="customFields">
                      </div>
                      <div class="row">
                          <div class="col-12">
                              <a class="newrow_manage" href="#"><i class="fas fa-plus"></i> New Interval</a>
                          </div>
                      </div>
                      <!-- <div class="form-group spacing-eight mt-6 mb-3">
                        <input type="submit" class="default-btn w-100 radius-btn" id="add_availbility" name="Save" value="Update">
                      </div> -->
                      <!-- <div class="row no-gutters spacing-eight mt-6 mb-3" >
                          <div class="col-sm-4">
                              <button type="submit" name="action" value="weekdays" class="default-btn radius-btn border-btn w-100 px-2" ><span>All Weekdays</span></button>
                          </div>
                          <div class="col-sm-4">
                              <button type="submit" name="action" value="specific_date" class="default-btn radius-btn border-btn w-100 px-2 specific_date" ><span>For Jun 24, 20</span></button>
                          </div>
                          <div class="col-sm-4">
                              <button type="submit" name="action" value="specific_day" class="default-btn radius-btn border-btn w-100 px-2 specific_day" href="#"><span>All Wednesday</span></button>
                          </div>
                      </div> -->
                      <div class="row no-gutters spacing-eight mt-5 mb-3" >
                           <div class="col-sm-4">
                              <input type="radio" name="action" value="weekdays" checked>&nbsp;<span>All Weekdays</span>
                             </div>
                          <div class="col-sm-4">
                              <input type="radio" name="action" value="specific_date" >&nbsp;<span class="specific_date" >For Jun 24, 20</span>
                           </div>
                          <div class="col-sm-4">
                              <input type="radio" name="action" value="specific_day">&nbsp;<span class="specific_day">All Wednesday</span>
                          </div>

                      </div>
                      <div class="row no-gutters spacing-eight mt-5 mb-3" >
                        <div class="col-sm-2"></div>
                          <div class="col-sm-6">
                              <button type="submit" class="default-btn radius-btn border-btn w-100 px-2" ><span>Save</span></button>
                          </div>
                          <div class="col-sm-2"></div>
                      </div>
                  </div>
                </form>
              </div>
          </div>
        </div>