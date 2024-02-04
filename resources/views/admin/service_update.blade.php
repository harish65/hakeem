@extends('layouts.vertical', ['title' => 'Edit Variable'])
@section('content')

 <!-- Start Content-->
<div class="container-fluid">
    
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
          <div class="page-title-box mt-2">
              <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('service_enable.index') }}">Variables</a></li>
                      <li class="breadcrumb-item active">Update Variable</li>
                  </ol>
              </div>
              <h3 class="card-title">Update Variable</h3>
          </div>
      </div>
  </div>  

    <div class="card card-primary">
        <!-- form start -->
        <form role="form" action="{{ url('admin/service_enable').'/'.$enableservice->id}}" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="service_id" value="{{ $enableservice->id }}">
          <div class="card-body">
            <div class="form-group">
              <label>Service Type</label>
              <input type="text" disabled class="form-control" value="{{ $enableservice->type }}">
            </div>
            <div class="form-group">
              @if($enableservice->type=='pending_request_hours')
                 <div class="form-group">
                    <label for="exampleInputEmail1">Key Name</label>
                    <input type="text" disabled class="form-control" name="key_name" id="exampleInputEmail1" value="{{ $enableservice->key_name }}">
                  </div>
                  <div class="form-group">
                    <label>Value in Hours</label>
                    <input type="number" class="form-control" name="value" placeholder="Hours" value="{{ $enableservice->value }}">
                  </div>
              @endif
              @if($enableservice->type=='admin_percentage')
                @if (Config::get('client_connected') && (Config::get('client_data')->domain_name=='curenik'))
                <div class="form-group">
                      <label for="exampleInputEmail1">Type</label>
                      <select class="form-control" name="key_name" id="exampleInputEmail1">
                        <option value="percentage" <?php echo ($enableservice->key_name=='percentage')?'selected':'' ?>>Percentage</option>
                        <option value="flat" <?php echo ($enableservice->key_name=='flat')?'selected':'' ?>>Flat</option>
                    </select>
                      
                    </div>
                @else
                   <div class="form-group">
                      <label for="exampleInputEmail1">Key Name</label>
                      <input type="text" disabled class="form-control" name="key_name" id="exampleInputEmail1" value="{{ $enableservice->key_name }}">
                    </div>
                @endif
                    <div class="form-group">
                      <label>%</label>
                      <input type="number" class="form-control" name="value" placeholder="%" value="{{ $enableservice->value }}">
                    </div>
              @endif
              @if($enableservice->type=='service_charge')
                 <div class="form-group">
                    <label for="exampleInputEmail1">Key Name</label>
                    <input type="text" disabled class="form-control" name="key_name" id="exampleInputEmail1" value="{{ $enableservice->key_name }}">
                  </div>
                  <div class="form-group">
                    <label>Value in %</label>
                    <input type="text" class="form-control" name="value" placeholder="%" value="{{ $enableservice->value }}">
                  </div>
              @endif
              @if($enableservice->type=='audio/video')
                <select class="form-control" name="value">
                  <!-- <option value="twillio" <?php echo ($enableservice->value=='twillio')?"selected":'' ?>>Twillio</option>
                  <option value="exotel" <?php echo ($enableservice->value=='exotel')?'selected':'' ?>>Exotel</option>
                  <option value="twilio_video" <?php echo ($enableservice->value=='twilio_video')?'selected':'' ?>>Twilio Video</option> -->
                  <option value="jistimeet_video" <?php echo ($enableservice->value=='jistimeet_video')?'selected':'' ?>>Jistimeet Video</option>
                </select>
              @endif
              @if($enableservice->type=='unit_price')
              <div class="form-group">
                    <label for="exampleInputEmail1">Key Name</label>
                    <input type="text" disabled class="form-control" name="key_name" id="exampleInputEmail1" value="{{ $enableservice->key_name }}">
                </div>
                <div class="form-group">
                    @if(Config('client_connected') && Config::get("client_data")->domain_name=="intely")
                      <label>Value in Hour</label>
                      <input type="number" class="form-control" name="value" placeholder="Hour" value="{{ $enableservice->value/60 }}">
                    @else
                      <label>Value in minute</label>
                      <input type="number" class="form-control" name="value" placeholder="minute" value="{{ $enableservice->value }}">
                    @endif
                  </div>
              @endif
              @if($enableservice->type=='booking_delay')
              <div class="form-group">
                    <label for="exampleInputEmail1">Key Name</label>
                    <input type="text" disabled class="form-control" name="key_name" id="exampleInputEmail1" value="{{ $enableservice->key_name }}">
                </div>
              <div class="form-group">
                    <label>Value in Hour</label>
                    <input type="number" class="form-control" name="value" placeholder="Hour" value="{{ $enableservice->value }}">
                </div>
              @endif

              @if($enableservice->type=='slot_duration')
              <div class="form-group">
                    <label for="exampleInputEmail1">Key Name</label>
                    <input type="text" disabled class="form-control" name="key_name" id="exampleInputEmail1" value="{{ $enableservice->key_name }}">
                </div>
                <select class="form-control" name="value">
                  <option value="15" <?php echo ($enableservice->value=='10')?"selected":'' ?>>15 Minutes</option>
                  <option value="30" <?php echo ($enableservice->value=='30')?'selected':'' ?>>30 Minutes</option>
                  <option value="45" <?php echo ($enableservice->value=='45')?'selected':'' ?>>45 Minutes</option>
                  <option value="60" <?php echo ($enableservice->value=='60')?'selected':'' ?>>60 Minutes</option>
                </select>
              @endif
              @if($enableservice->type=='vendor_approved')
              <div class="form-group">
                    <label for="exampleInputEmail1">Key Name</label>
                    <input type="text" disabled class="form-control" name="key_name" id="exampleInputEmail1" value="{{ $enableservice->key_name }}">
                </div>
                <select class="form-control" name="value">
                  <option value="yes" <?php echo ($enableservice->value=='yes')?"selected":'' ?>>Yes</option>
                  <option value="no" <?php echo ($enableservice->value=='no')?'selected':'' ?>>No</option>
                </select>
              @endif
              @if($enableservice->type=='insurance')
               <label for="exampleInputEmail1">Action</label>
                <select class="form-control" name="value">
                  <option value="yes" <?php echo ($enableservice->value=='yes')?"selected":'' ?>>Yes</option>
                  <option value="no" <?php echo ($enableservice->value=='no')?'selected':'' ?>>No</option>
                </select>
              @endif
              @if($enableservice->type=='currency')
              <div class="form-group">
                    <label for="exampleInputEmail1">Key Name</label>
                    <input type="text" disabled class="form-control" name="key_name" id="exampleInputEmail1" value="{{ $enableservice->key_name }}">
                </div>
                <select class="form-control" name="value">
                    @foreach($currecnies as $currency)
                      <option value="{{ $currency->code }}" <?php echo ($enableservice->value==$currency->code)?"selected":'' ?>>{{ $currency->symbol .' '.$currency->code }}</option>
                    @endforeach
                </select>
              @endif
              @if($enableservice->type=='set_radius')
              <div class="form-group">
                    <label for="exampleInputEmail1">Key Name</label>
                    <input type="text" disabled class="form-control" name="key_name" id="exampleInputEmail1" value="km">
                </div>
                <div class="form-group">
                    <label>Value in KM</label>
                    <input type="number" class="form-control" name="value" placeholder="KM" value="{{ $enableservice->value }}">
                </div>
              @endif
              @if($enableservice->type=='minimum_balance')
              <div class="form-group">
                    <label for="exampleInputEmail1">Key Name</label>
                    <input type="text" disabled class="form-control" name="key_name" id="exampleInputEmail1" value="{{ $enableservice->key_name }}">
                </div>
                <div class="form-group">
                    <label>Value</label>
                    <input type="number" class="form-control" name="value" placeholder="value" value="{{ $enableservice->value }}" required="">
                </div>
              @endif
              @if($enableservice->type=='hide_inputs')
              @php $enableservice->value = explode(',', $enableservice->value); @endphp
              <div class="form-group">
                    <label for="exampleInputEmail1">Key Name</label>
                    <input type="text" disabled class="form-control" name="key_name" id="exampleInputEmail1" value="{{ $enableservice->key_name }}">
                </div>
                <div class="form-group">
                  <label>Value</label>
                   <select class="form-control col-md-6" name="value[]" multiple>
                      <option value="name" <?php echo (in_array("name", $enableservice->value))?"selected":'' ?>>Name</option>
                      <option value="email" <?php echo (in_array("email", $enableservice->value))?"selected":'' ?>>Email</option>
                      <option value="phone" <?php echo (in_array("phone", $enableservice->value))?"selected":'' ?>>Phone</option>
                      <option value="profile.address" <?php echo (in_array("profile.address", $enableservice->value))?"selected":'' ?>>Address</option>
                      <option value="profile.dob" <?php echo (in_array("profile.dob", $enableservice->value))?"selected":'' ?>>DOB</option>
                      <option value="profile.qualification" <?php echo (in_array("profile.qualification", $enableservice->value))?"selected":'' ?>>Qualification</option>
                      <option value="profile.city" <?php echo (in_array("profile.city", $enableservice->value))?"selected":'' ?>>City</option>
                      <option value="profile.state" <?php echo (in_array("profile.state", $enableservice->value))?"selected":'' ?>>State</option>
                      <option value="profile.gender" <?php echo (in_array("profile.gender", $enableservice->value))?"selected":'' ?>>Gender</option>
                      <option value="profile.experience" <?php echo (in_array("profile.experience", $enableservice->value))?"selected":'' ?>>Experience</option>
                      <option value="profile.speciality" <?php echo (in_array("profile.speciality", $enableservice->value))?"selected":'' ?>>Speciality</option>
                      <option value="profile.working_since" <?php echo (in_array("profile.working_since", $enableservice->value))?"selected":'' ?>>working_since</option>
                      <option value="profile.rating" <?php echo (in_array("profile.rating", $enableservice->value))?"selected":'' ?>>Total Rating</option>
                      <option value="review_count" <?php echo (in_array("review_count", $enableservice->value))?"selected":'' ?>>Review Count</option>
                      <option value="patient_count" <?php echo (in_array("patient_count", $enableservice->value))?"selected":'' ?>>Patient Count</option>
                </select>
                </div>
              @endif
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
             <a class="btn btn-info" href="{{ route('service_enable.index')}}">Cancel</a>
          </div>
        </form>
      </div>
  </div>
@endsection

@section('script')
@endsection