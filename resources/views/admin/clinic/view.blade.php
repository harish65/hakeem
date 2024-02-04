@extends('layouts.vertical', ['title' => __('Doctors') ])
@section('css')
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<style type="text/css">
    .offline_online {
        margin: 0 !important;
        padding: 0 !important;
    }

    .form-control.medium {
        height: 20px;
    }

    .action {
        display: flex;
    }

    .custom-switch {
        margin-left: 30px;
        padding: auto;
    }
</style>
<div class="container-fluid">
    @if($errors->any())
    <h4>{{$errors->first()}}</h4>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="page-title-box mt-2">
                <div class="page-title-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Doctors</li>
                    </ol>
                    <!-- <a href="javaScript:void(0)" class="btn btn-sm btn-info float-right mb-1">Add New</a> -->
                </div>
                <h3 class="card-title">Doctors</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">

                    <br>
                    <table>

                    </table>
                    <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                        <thead>
                            <tr>
                                <!-- <th><input type="checkbox" id="selectAllchkBox"></th> -->
                                <th>Sr No.</th>
                                <!-- <th>Actions</th> -->
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($consultants as $index => $consultant)
                            <tr class="delete_row">
                                <!-- <td><input type="checkbox" data-user="{{ $consultant->id }}"></td> -->
                                <td>{{ $index+1 }}</td>
                                <td>{{ $consultant->name }}</td>
                                <td>{{ $consultant->email }}</td>
                                <td>{{ $consultant->country_code.''.$consultant->phone }}</td>
                                <td class="action">
                                    <!-- <input class="form-control medium checkbox" checked disabled type="checkbox" data-user="{{ $consultant->id }}"> -->
                                    <a href="javaScript:Void(0)" data-user_id="{{ $consultant->id }}"
                                        class="btn btn-danger remove_doctor"><i class="fa fa-trash"></i></a>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input toggleSwitch1" value="1"
                                            id="toggleSwitch_{{ $consultant->id  }}" {{ ($consultant-> manual_available
                                        == 1 ) ? 'checked' : '' }} data-user_id = "{{ $consultant->id }}">
                                        <label class="custom-control-label"
                                            for="toggleSwitch_{{ $consultant->id  }}">Select Availability</label>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <button class="btn btn-sm btn-info float-right mb-1" id="add_in_clinic">+ Add In Clinic</button>
                </div>
                <div class="clear-fix"><br></div>
            </div>
        </div>
    </div>
    <!--modal-->
</div>
@endsection
@section('script')
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<!-- <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script> -->
<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {

        var dataTable = $('#scroll-horizontal-datatable').DataTable({
            "autoFill": false,
            "scrollX": true,
            "language": {
                "paginate": {
                    "previous": "<i class='mdi mdi-chevron-left'>",
                    "next": "<i class='mdi mdi-chevron-right'>"
                }
            },
            "drawCallback": function () {
                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
            },
            initComplete: function () {
                $(this.api().table().container()).find('input[type=search]').parent().wrap('<form>').parent().attr('autocomplete', 'off');
            }
        });
    });

    $('.toggleSwitch1').on('change', function () {
        var manual_available = false;
        var user_id = $(this).attr('data-user_id')

        if ($(this).is(":checked")) {
            var manual_available = true;
        }
        $.post("{{ url('/online-toggle') }}", { _token: "{{ csrf_token() }}", manual_available: manual_available, user_id: user_id }).done(function (data) {
            // if(data.success == 'success'){
            swal.fire(
                'Updated!',
                'Availability updated successfully.',
                'success'
            ).then((result) => {
                location.reload();
            });
            // }
        });
    });
    $('.remove_doctor').on('click', function () {
        var user_id = $(this).attr('data-user_id')
        Swal.fire({
            title: 'Are you sure to remove doctor from clinic',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            showLoaderOnConfirm: true,
        }).then((result) => {
            $.post("{{ route('remove_doctor') }}", { _token: "{{ csrf_token() }}", user_id: user_id, clinic_id: '{{ $id }}' }).done(function (data) {
                Swal.fire(
                    'Deleted!',
                    'Dcotor has been Deleted.',
                    'success'
                ).then((result) => {
                    location.reload();
                });
            })
        });
    });



</script>
@endsection