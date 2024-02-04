@extends('layouts.vertical', ['title' => __('Doctors') ])
@section('css')
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
<style>
    .upper-sar{
        position: relative;
    }
    .sar-form-input{
        padding-left:40px !important;
    }
    .curency-sar{
        position: absolute;
        left :10px;
        top: 8px;
    }
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

    .toast-error {
        background-color: red;
    }

    #schedules {
        width: 100%;
        overflow-x: scroll;
        overflow-y: hidden;
    }

    .days-list li {
        margin-bottom: 12px;

    }

    .days-list li {
        /* opacity: .5; */
        color: #282525;
        letter-spacing: 0;
        line-height: 20px;
        position: relative;
    }

    .days-list li {
        display: inline-block;
    }

    .days-list li {
        margin-right: 40px;
    }

    .schedule_date {
        border: 1px groove !important;
        padding: 7px !important;
    }

    .days-list li a {
        display: block;
        width: 100px;
    }

    a {
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        transition: all 0.5s;
    }

    a,
    a:hover {
        text-decoration: none;
        color: #31398F;
    }

    .days-list li.active,
    .days-list li:hover,
    .days-list li:hover a:after,
    .days-list li.active a:after {
        opacity: 1;
        background-color: #1cac6c;
    }

    .days-list li a span {
        font-size: 14px;
        font-family: 'Campton';
        display: block;
        color: #000;
    }

    .days-list li a label {
        font-family: 'Campton';
        font-weight: 500;
        font-size: 18px;
        color: #282525;
        cursor: pointer;
    }
</style>
<style>
    .toggle.ios,
    .toggle-on.ios,
    .toggle-off.ios {
        border-radius: 20rem;
    }

    .toggle.ios .toggle-handle {
        border-radius: 20rem;
    }
</style>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
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

<div class="card card-primary">
    <form role="form" autocomplete="off" id="createDcotorForm" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!--  -->
        <hr>

        <!-- <hr> -->
        <!-- 12 4,4,4,  -->

        <!-- <hr> -->
        <div class="card-body">
            <h3> Servcice type </h3>
            <table class="table">
                @foreach($services_data as $key => $service)
                <tr>
                    <td><label for="{{ $service->service_id }}" class="form-label">{{ $service->name }}</label></td>
                    <td><input type="checkbox" name="available[]" value="1" id="{{ $service->service_id }}" data-user_id="{{ $id }}"
                            data-toggle="toggle" data-onstyle="primary" data-style="ios" data-size="sm"
                            @if($service->service_enabled) checked @endif onchange="valueChanged(this)"
                        data-id="{{ $service->service_id }}"
                        ></td>
                    <td>
                        <div class="row {{ ($service->service_enabled) ? '' : 'd-none' }} {{ $service->service_id }}">
                            <div class="col-sm-4">
                                <!-- <input type="text" name="price_fixed[]" class="form-control" data-id="{{ $service->id }}"> -->
                                @if($service->fixed_price=='true')
                                @php $readonly = 'readonly'; @endphp
                                <input class="form-control price" data-id="{{ $service->service_id }}"
                                    name="price_fixed[]" {{$readonly}} type="number"
                                    placeholder="{{$service->price_fixed}}"
                                    value="{{($service->price_fixed == '') ? '5' : $service->price_fixed }}">
                                @else
                                @php $readonly = ''; @endphp
                                <input class="form-control price updateserviceprice" name="price_fixed[]" {{$readonly}}
                                    type="number" placeholder="100" data-id="{{ $service->service_id }}"
                                    value="{{($service->price_fixed == '') ? '5' : $service->price_fixed }}">
                                @endif
                            </div>
                            <div class="col-sm-4">
                                <!-- <label>For</label> -->
                                @if($service->fixed_price=='true')
                                @php $readonly = 'readonly'; @endphp
                                @else
                                @php $readonly = ''; @endphp
                                @endif
                                <div class="upper-sar">
                                    <span class="curency-sar">SAR</span> <input class="form-control duration sar-form-input"
                                    data-id="{{ $service->service_id }}" name="minimum_duration[]" 
                                    type="text" style="display:flex;" readonly placeholder="1 min"
                                    value="{{($service->slot_duration) ? $service->slot_duration : 1 }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- <a href="#" class="btn btn-primary add-availability" data-toggle="modal" data-target="#"
                                    id="add_availability_{{ $service->id }}" data-serviceid="{{ $service->id }}"
                                    data-user-id="{{ $id }}" data-categoryid="{{ $cat_info }}"><i
                                        class="fa fa-plus"></i> Add Availability</a> -->
                                        @php
                                            
                                            $check_sp_availbility = \App\Model\ServiceProviderSlot::where('service_provider_id', $id)->where('service_id', $service->service_id)->get();
                                            $sp_availbility = \App\Model\SpAvailability::where('user_id', $id)->where('service_id', $service->service_id)->get();
                                            $check_sp_availbility = $check_sp_availbility->count();
                                            
                                        @endphp
                                        @if($check_sp_availbility > 0)
                                            <div class="col-12  edit_avail_div">
                                                <a  class="btn btn-primary editavailability_manage edit-availability" data-id="{{ $service->service_id }}" data-category-id="{{  $cat_info  }}" href="#"><i class="fas fa-plus"></i> Edit Availability</a>
                                            </div>
                                        @else
                                            <div class="col-12 ">
                                                <a class="btn btn-primary availability_manage add-availability" href="#" data-id="{{ $service->service_id }}" data-category-id="{{  $cat_info }}"><i class="fas fa-plus"></i> Add Availability</a>
                                            </div>

                                        @endif
                            </div>
                        </div>
                    </td>
                    <input type="hidden" name="service_id[]" class="serviceId" value="{{ $service->service_id }}">
                    <input type="hidden" name="category_id" class="category" value="{{ $cat_info }}">
                </tr>
                @endforeach
            </table>
        </div>
        <div class="card-footer">
            <button type="button" id="submitBtn" class="btn btn-primary">Submit</button>

            @if(config('client_connected') && (Config::get("client_data")->domain_name=="hakeemcare" || Config::get("client_data")->domain_name=="hakeemcare"))
                <a class="btn btn-info" href="{{ url('clinic/dashboard')}}">Cancel</a>
            @else
                <a class="btn btn-info" href="{{ route('consultants.index')}}">Cancel</a>
            @endif
        </div>
    </form>


</div>
<div class="loader" id="loader"></div>
@include('vendor.hakeemcare.doctor-availability' , [$id])

@endsection

@section('script')
<!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    $(function () {
        $('#loader').hide()
        $("#date_of_birth , #working_since").datepicker();
        $(document).on('click', '.add-availability', function () {
            var serviceid = $(this).attr('data-id');            
            $('#DoctorAvailabilityForm #service_id').val(serviceid)
            $('#DoctorAvailabilityForm').modal('toggle')
        })
        $(document).on('click', '.edit-availability', function () {
            var serviceid = $(this).attr('data-id');            
            $('#DoctorAvailabilityForm #service_id').val(serviceid)
            $('#DoctorAvailabilityForm').modal('toggle')
        })





        // $('#parent-category').on('change', function () {
        //     

        //     if ($(this).val()) {
        //         var cateID = $(this).val();

        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //         $.ajax({
        //             type: 'GET',
        //             url: base_url + '/clinic/sub-categories/' + cateID,
        //             success: function (response) {
        //                 // console.log('response' , response)
        //                 var html = '';
        //                 html += '<option value="">Choose Sub Category</option>'
        //                 var data = JSON.parse(response)
        //                 $.each(data, function (i, item) {
        //                     html += '<option value=' + item.id + '>' + item.name + ' </option> '
        //                 });
        //                 $('#sub-category').html(html).focus()
        //                 $('#loader').hide()
        //             }
        //         });
        //     }
        // })

        $(document).on('change', "input[type='checkbox']", function (e) {
            let test = e.target.checked;
            let id = $(this).attr('id');

            if (test) {
                $('.' + id).removeClass('d-none')
            } else {
                $('.' + id).addClass('d-none')
            }
        });


    });

    $('#submitBtn').click(function (e) {
        ;
        e.preventDefault();
        $.ajax({
            type: "post",
            dataType: "json",
            url: base_url + '/users/register',
            data: $('#createDcotorForm').serialize(),
            success: function (response) {
                //    console.log(response);
                if (response.status == 'success') {
                    toastr.success("Success!");
                    var user_id = response.userid;
                    window.location.href = base_url + '/clinic/upload_documnets/' + user_id;
                }
                if (response.status == 'error') {
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


    $('#DoctorAvailabilityForm .newrow_manage').click(function () {
        var count = $('#DoctorAvailabilityForm .new_row').length;
        $("#DoctorAvailabilityForm #customFields").append('<div class="new_row row align-items-center"><div class="col-11 pr-0"><div class="row common-form"><div class="col-sm-6"><div class="form-group"><label>From</label><input class="form-control" id="start_time_' + count + '" type="time" placeholder="11:00 am" name="start_time[]" required onchange="check_slots_validity(this, `start`, ' + count + ', `addAvailbityModal_manage`)"><span class="error start_time_' + count + '"></span></div></div><div class="col-sm-6"><div class="form-group"><label>To</label><input class="form-control" id="end_time_' + count + '"  type="time" placeholder="11:00 am" name="end_time[]" required onchange="check_slots_validity(this, `end`, ' + count + ', `addAvailbityModal_manage`)"><span class="error end_time_' + count + '"></span></div></div></div></div><div class="col-1"><label></label> <a class="remCF" href="#"><i class="fas fa-trash-alt"></i></a></div></div>');
    });
    $("#DoctorAvailabilityForm #customFields").on('click', '.remCF', function () {
        $(this).closest('.new_row').remove();
    });
    $(function () {
        $("#DoctorAvailabilityForm .time_options_div").hide();
    })
    $('#DoctorAvailabilityForm .schedule_date').on('click', function (e) {
        e.preventDefault();
        $('.schedule_date').removeClass("active");
        $(this).addClass("active");
        $("#DoctorAvailabilityForm .specific_date span").text('');
        $("#DoctorAvailabilityForm .time_options_div").show();

        var dateVal = $(this).find('label').text();
        var dayVal = $(this).find('span').text();

        $("#DoctorAvailabilityForm .specific_date ").text('For ' + dateVal);
        $("#DoctorAvailabilityForm .specific_day ").text('All ' + dayVal);
    });
    

    function valueChanged(sel) {
        var toggle = sel.id;

        var cat = $('.category').val();

        var service_id = $(sel).attr('data-id');

        var price = $('.price[data-id=' + service_id + ']').val();

        var duration = $('.duration[data-id=' + service_id + ']').val();
        var user_id = $(sel).attr('data-user_id');


        //alert(service_id);

        if ($("#" + toggle).is(":checked")) {
            var l_price = $('.price[data-id=' + service_id + ']').val();
            if (l_price == '') {
                $('.price[data-id=' + service_id + ']').prop('required', true);
                $('.price[data-id=' + service_id + ']').css('border-color', 'red');
            }
            // alert("checked");
            $("#" + toggle + "_box").find(".togglediv").show();
            
            // add to db
            $.post("{{ url('/profile/add_service_type_avail') }}", { _token: "{{ csrf_token() }}", service_id: service_id, category_id: cat, price: price, duration: duration, user_id: user_id }).done(function (data) {
                Swal.fire({  title: "Service Added"  , 
                                    icon: "success",
                                    buttons: true,
                                    dangerMode: true});
            });
        }
        else {
            $('.price[data-id=' + service_id + ']').prop('required', false);
            $('.price[data-id=' + service_id + ']').css('border-color', '');
            // alert("hidden");
            $("#" + toggle + "_box").find(".togglediv").hide();

            // remove to db
            $.post("{{ url('/profile/remove_service_type_avail') }}", { _token: "{{ csrf_token() }}", service_id: service_id, category_id: cat , user_id: user_id }).done(function (data) {
                
                
                        Swal.fire({  title: "Service remove"  , 
                                    icon: "success",
                                    buttons: true,
                                    dangerMode: true});
    
                //toastr.info(data);
            });
        }
    }

    $('.updateserviceprice').on('change', function (e) {
        e.preventDefault();
        var cat = $('.category').val();

        var service_id = $(this).attr('data-id');
        var price = $('.price[data-id=' + service_id + ']').val();

        var duration = $('.duration[data-id=' + service_id + ']').val();
        var sp_id = '{{ $id }}'
        
        // add to db
        $.post("{{ url('/profile/update_service_type_avail')}}", { _token: "{{ csrf_token() }}", service_id: service_id, category_id: cat, price: price, duration: duration , sp_id: sp_id }).done(function (data) {
            Swal.fire({  title: "Price updated"  , 
                                    icon: "success",
                                    buttons: true,
                                    dangerMode: true});
            $('.price[data-id=' + service_id + ']').prop('required', false);
            $('.price[data-id=' + service_id + ']').css('border-color', '');
        });

    });
</script>
@endsection