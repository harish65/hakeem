

<div class="modal fade bd-example-modal-lg" id="DoctorAvailabilityForm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add availability</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form class="availbilityform" id="add_availbility_form" method="post" action="{{url('/service_provider/add_availbility')}}">
            @csrf
            <input type="hidden" name="user_id" value="{{ @$id }}">
            <input type="hidden" name="category_id" class="category" value="{{ $cat_info }}">
            <input type="hidden" name="service_id" class="serviceId" id="service_id"value="">
          <div  class="bg-gray position-relative p-3 mt-4">
            <ul class="days-list d-flex align-items-center" id="schedules">
              @if(isset($data))
                    @foreach($data as $datas)
                    @php $showDate = date('d M, y', strtotime($datas['date'])); @endphp
                    <input type="hidden" name="slot_date" value="{{$datas['date']}}" />
                    <li class="schedule_date" data-val = "{{$datas['date']}}" data-day="{{ $datas['day']}}">
                        <a href="javaScript:Void(0)" ><span>{{ $datas['day']}}</span>
                        <label class="m-0">{{ $showDate }}</label>
                    </a>
                    </li>
                    @endforeach
                  @endif
              </ul>
            </div>
            
            <div class="time_options_div">
              <h6>Select Time</h6>
              <div id="customFields">
                <div class="new_row row align-items-center">
                    <div class="col-11 pr-0 interv_div" >
                        <div class="row common-form">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>From</label>
                                    <input class="form-control" id="start_time_0" type="time" placeholder="11:00 am" name="start_time[]" required onchange="check_slots_validity(this, 'start', 0, 'addAvailbityModal_manage')">
                                    <span class="start_time_0"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>To</label>
                                    <input class="form-control" id="end_time_0" type="time" placeholder="11:00 am" name="end_time[]" required onchange="check_slots_validity(this, 'end', 0, 'addAvailbityModal_manage')">
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
                      <a class="newrow_manage" href="#"><i class="fas fa-plus"></i> New Interval</a>
                  </div>
              </div>            
            <div class="row no-gutters spacing-eight mt-5 mb-3" >
                   <div class="col-sm-4">
                      <input type="radio" name="action" value="weekdays" checked>&nbsp;<span>All Weekdays</span>
                     </div>
                  <div class="col-sm-4">
                      <input type="radio" name="action" value="specific_date" >&nbsp;<span class="specific_date" >For {{ date('d M ,y') }}</span>
                   </div>
                  <div class="col-sm-4">
                      <input type="radio" name="action" value="specific_day">&nbsp;<span class="specific_day">All {{ date('l') }}</span>
                  </div>

              </div>
              <div class="row" >
                  <div class="col-sm-12 text-left">
                      <button type="submit" class="btn btn-primary btn-lg" ><span>Save</span></button>
                  </div>
                  
              </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>