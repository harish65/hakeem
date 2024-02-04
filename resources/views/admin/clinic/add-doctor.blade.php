@extends('layouts.vertical', ['title' => __('Doctors') ])
@section('css')
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
<style>
    .loader {
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
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

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
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
                <h3 class="card-title">Add Doctor</h3>
            </div>
        </div>
    </div>
</div>

<div class="loader-outer" id="loader"><div class="loader" ></div></div>
<div class="card card-primary">
    <form role="form" autocomplete="off" id="createDcotorForm" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="card-body add-doctor">

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Title</label>
                    <select name="title" class="form-control" value="{{ old('title') }}" id="title" placeholder="">
                        <option value="">Title</option>
                        <option value="{{ ('dr') }}">DR.</option>
                        <option value="{{ ('mr') }}">MR.</option>
                        <option value="{{ ('mrs') }}">MRS.</option>
                        <option value="{{ ('miss') }}">Miss.</option>
                    </select>
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="name">Profile Pic</label>
                    <input type="file" class="form-control" name="profile-pic">

                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Full Name</label>
                <input type="text" class="form-control" autocomplete="off" name="name" value="{{ old('name') }}"
                    id="name" placeholder="Enter name" autocomplete="off">
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Email Address</label>
                    <input type="email" class="form-control" autocomplete="off" name="email" value="{{ old('email') }}"
                        id="exampleInputEmail1" placeholder="Enter email" autocomplete="off">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-6 ">
                    <label for="name">Password</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}"
                        id="password" placeholder="password" autocomplete="off">
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phone">Date of Birth</label>
                    <input type="text" name="dob" class="form-control" value="{{ old('dob') }}"
                        id="date_of_birth" placeholder="DD/MM/YY">
                    @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Practising Since</label>
                    <input type="text" name="working_since" class="form-control" value="{{ old('working_since') }}"
                        id="working_since" placeholder="DD/MM/YY">
                    @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phone">Longitude</label>
                    <input type="text" name="long" class="form-control" value="{{ old('long') }}"
                        id="longitude" placeholder="0000.00" readonly>
                    @if ($errors->has('long'))
                    <span class="text-danger">{{ $errors->first('long') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Latitude</label>
                    <input type="text" name="lat" class="form-control" value="{{ old('latitude') }}"
                        id="latitude" placeholder="0000.00" readonly>
                    @if ($errors->has('lat'))
                    <span class="text-danger">{{ $errors->first('lat') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="phone">Description</label>
                <textarea name="bio" class="form-control"></textarea>
            </div>
            <input type="hidden" name="type" value="clinic">
            <input type="hidden" name="signuptype" value="email">
            <input type="hidden" name="role_type" value="service_provider">
            <input type="hidden" name="from_clinic" value="clinic">
            <input type="hidden" name="client" value="hakeemcare">
        </div>
        
        <div class="map" id="map" style="width:100%;height:290px;"></div>
        <div class="card-footer">
            <button type="button" id="submitBtn" class="btn btn-primary">Submit</button>
            <a class="btn btn-info" href="{{ route('admin_dashboard')}}">Cancel</a>
        </div>
    </form>
    
            
        
</div>



@endsection

@section('script')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(function () {
        $('#loader').hide()
        $("#date_of_birth , #working_since").datepicker();
        $(document).on('change', "input[type='checkbox']", function (e) {
            let test = e.target.checked;
                let name = $(this).attr('name');
                
                if(test){
                    $('.' + name).removeClass('d-none')
                }else{
                    $('.' + name).addClass('d-none')
                }
        });


    });

    $('#submitBtn').click(function (e) {
        $('#loader').show();
        e.preventDefault();
        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/users/register',
            data: $('#createDcotorForm').serialize(),
            success: function (response) {
            //    console.log(response);
                if(response.status ==  'success'){
                    toastr.success("Success!");
                    var user_id = response.userid;
                    window.location.href = base_url + '/admin/dashboard';
                }
                if(response.status == 'error'){
                    toastr.error("Error!");
                }
                $('#loader').hide();
            },
            error: function (jqXHR) {
                $("#login_btn span").html('Next');
                $('#loader').hide();
                if (jqXHR.responseJSON.status === "error") {
                    $("#signupdoctorEmailModal .msgdiv").text(jqXHR.responseJSON.message);
                    $("#signupdoctorEmailModal .msgdiv").show();
                    $('#signupdoctorEmailModal .msgdiv').fadeIn('slow').delay(2000).fadeOut('slow');
                }
                $('#loader').hide();
            }
        });
    });

    

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApA3S2uvw7wXWzQ8T0ueJZCDrSAiyhqtg&callback=initMap" async defer></script>

<script type="text/javascript">
    var longitud;
    var latitud;

var options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
};
  
function success(pos) {
    var crd = pos.coords;
    latitud = crd.latitude
    longitud = crd.longitude   
    // document.getElementById("latitud").innerHTML = latitud 
    // document.getElementById("longitud").innerHTML = longitud 
    map = new google.maps.Map(document.getElementById("map"), {
        center: {lat: latitud, lng: longitud},
        zoom: 14
    });
    google.maps.event.addListener(map, 'click', function(event) {
        $('#latitude').val(event.latLng.lat());
        $('#longitude').val(event.latLng.lng());
                // console.log("Latitude: " + event.latLng.lat() + " " + ", longitude: " + event.latLng.lng());
  });
};
  
function error(err) {
    document.getElementById("map").innerHTML = ('ERROR(' + err.code + '): ' + err.message);
};
  
function initMap(){
    navigator.geolocation.getCurrentPosition(success, error);

   
}



</script>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"> 
</script> 
<script type="text/javascript"> 
_uacct = "UA-162157-1";
urchinTracker();
</script> 
@endsection