@extends('layouts.vertical', ['title' => 'Edit Pincode'])
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Pincode</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{ url('admin/pincodes') . '/' . $pincode->id }}" method="post"
            enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form-group">

                    <div class="col-sm-4">
                        <label for="pincode">Pincode</label>
                        <input type="text" name="pincode" class="form-control"
                            value="{{ old('pincode') ?? $pincode->pincode }}" id="position" placeholder="Position">
                        @if ($errors->has('pincode'))
                            <span class="text-danger">{{ $errors->first('pincode') }}</span>
                        @endif
                    </div>

                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <!-- Page js-->
    <!-- <script src="{{ asset('assets/js/pages/form-pickers.init.js') }}"></script> -->
    <script type="text/javascript">
        ! function($) {
            "use strict";

            var FormPickers = function() {};

            FormPickers.prototype.init = function() {

                    $('#range-datepicker').flatpickr({
                        mode: "range"
                    });

                },
                $.FormPickers = new FormPickers, $.FormPickers.Constructor = FormPickers

        }(window.jQuery),

        //initializing 
        function($) {
            "use strict";
            $.FormPickers.init()
        }(window.jQuery);
    </script>
@endsection
