@extends('vendor.care_connect_live.layouts.dashboard', ['title' => 'Patient'])
@section('content')
 <!-- Offset Top -->
 <div class="offset-top"></div>
     <!-- Page Header Section -->
     <section class="page-header">
        <div class="container">
            <div class="row align-items-center py-lg-5 py-4">
                <div class="col">
                    <h1>Book a Doctor</h1>
                    <ul class="page_navigation d-flex align-items-center mt-2">
                        <li><a href="{{url('user/patient')}}">Home</a></li>
                        <li class="active"><a href="#">Consult a Doctor</a></li>
                    </ul>
                </div>
                <div class="col text-right">
                    <div class="top_select ml-auto position-relative">
                    <select class="form-control" name="state" id="state_filter">
                        <option value="">Select State</option>
                        @foreach($states as $id=> $name)
                            <option value="{{ $name }}" @if(Auth::user()->profile->state == $name ) {{'selected'}} @endif >{{ $name }}</option>
                        @endforeach
                    </select>  
                    </div>
                </div>
            </div>
            
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="input-group mb-3">
                        <div class="search_box d-flex align-items-center" style="border-right: none;">
                            <input type="text" value="{{ $search }}" id="search_input" class="searchInput"  placeholder="Search" style="padding-left: 10px;">
                            <input type="hidden" value="{{ Request()->category_id }}" class="categoryInp" name="category">
                            <input type="hidden" value="{{ $service_id }}" class="serviceInp" name="service">
                        </div>
                        <div class="input-group-append" style="margin-left: -5px;">
                            <button class="btn btn-outline-secondary" style="border: 1px solid #e3e3e3; border-left: none;" type="button" id="searchSubmitButton"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <ul class="call_btn d-flex align-items-center justify-content-end">
                        @if($service_id == "all")
                            <li class="active">
                        @else
                            <li>
                        @endif
                            <a href="{{ url('/user/experts') }}/{{ $id }}/all">All</a>
                        </li>
                        @if($services)
                            @foreach($services as $service)
                                @if($service_id == $service->id)
                                    <li class="active">
                                @else
                                    <li>
                                @endif
                                    <a href="{{ url('/user/experts') }}/{{ $id }}/{{ $service->id }}">{{$service->type}}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Consult Doctor Page Content  -->
    <section class="consult_doctor">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="listing_option_wrapper">
                        <div class="accordion" id="doctor_listing">
                            <div class="card bg-transparent mb-4">
                                <div class="card-header bg-transparent px-0 py-2" id="category">
                                    <h2 class="mb-0 position-relative">
                                        <button class="btn d-block position-relative btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Category
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="category"
                                    data-parent="#doctor_listing">
                                    <div class="card-body p-0">
                                        <ul class="left-list">
                                            @if($id == "all")
                                                <li class="active">
                                            @else
                                                <li>
                                            @endif
                                                <a href="{{ url('/user/experts') }}">All</a>
                                            </li>
                                            @if($categorys)
                                                @foreach($categorys as $category)
                                                    @if($id == $category->id)
                                                    <li class="active">
                                                    @else
                                                    <li>
                                                    @endif
                                                        <a href="{{ url('/user/experts') }}/{{ $category->id }}">{{$category->name}}</a>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="card bg-transparent mb-4">
                                <div class="card-header bg-transparent px-0 py-2" id="category">
                                    <h2 class="mb-0 position-relative">
                                        <button class="btn d-block position-relative btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#collapsetwo" aria-expanded="false"
                                            aria-controls="collapsetwo">
                                            Type
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapsetwo" class="collapse" aria-labelledby="category"
                                    data-parent="#doctor_listing">
                                    <div class="card-body p-0">   
    <script>
   
    </script>
                                        <ul class="left-list">
                                            <li><a href="#">All</a></li>
                                            <li class="active"><a href="#">Cardiology</a></li>
                                            <li><a href="#">Dermatology</a></li>
                                            <li><a href="#">Family Medicine</a></li>
                                            <li><a href="#">Internist</a></li>
                                            <li><a href="#">Family Medicine</a></li>
                                            <li><a href="#">+19 More</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->

                            <div class="card bg-transparent mb-4">
                                <div class="card-header bg-transparent px-0 py-2" id="more_filters">
                                    <h2 class="mb-0 position-relative">
                                        <button class="btn d-block position-relative btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#collapsethree" aria-expanded="false"
                                            aria-controls="collapsethree">
                                            More Filters
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapsethree" class="collapse" aria-labelledby="more_filters"
                                    data-parent="#doctor_listing">
                                    <div class="card-body p-0">
                                        <ul class="left-list">
                                            <li><a href="#">All</a></li>
                                            @if(sizeof($doctors)>0)
                                                @foreach($doctors as $doctor)
                                                    @foreach($doctor['filters'] as $filter)
                                                        @foreach($filter['options'] as $option)
                                                <li><a href="#">{{$option->option_name}}</a></li>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    @include('vendor.care_connect_live.consultdoctor')

                    <div class="row mt-5 pt-lg-4">
                        <div class="col text-center">
                            {{ $doctors->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        var _token = "{{ csrf_token() }}";
        var _search_url = "{{ url('/user/experts/') }}";
      
    </script>
@endsection

