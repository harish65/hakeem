@extends('vendor.iedu.layouts.index', ['title' => 'Courses','show_footer'=>true])
@section('content')
<!-- Bannar Section -->
<section class="choose-tutor header-height">
  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="col-md-8">
        <h4>Choose a Tutor</h4>
        <div class="breadcrum mb-4">
          <a href="{{url('web/courses')}}">Home</a><span class="mr-2 ml-2">/</span>
          <a @if($booking_type== 'subject') href="{{url('web/grade')}}" @elseif($booking_type ?? '' == 'course') href="{{url('web/courses')}}" @else href="{{url('web/emsats')}}" @endif>{{ucwords($booking_type ?? '')}}</a><span class="mr-2 ml-2">/</span>
          <a class="active" href="#">Choose a Tutor</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="search-field">
            @if($course_id != null)
            <form action="{{route('expert.listing',$course_id)}}" method="get">
            @elseif($emsat_id !=null)
            <form action="{{route('expert.listing',$emsat_id)}}" method="get">
            @else
            <form>
            @endif

            <input class="form-control mb-4 searchInput" id="searching" name="search" type="text" value="{{@$_REQUEST['search']}}" onkeyup="searchFunction()"   placeholder="Search for tutor">
            <span><img class="" src="{{asset('assets/iedu/images/ic_search-black.png')}}"></span>
            </form>

        </div>
      </div>
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-3">
          <div class="left-nav-bar pt-3">
            <h5 class="pl-3 pr-3">{{ucwords($booking_type ?? '')}}</h5>
            <hr class="mb-0">
            <!-- @if($course_id != null)
              @if($course_id == "all")
              <a class="active" href="{{ url('/experts/listing') }}">All</a>
              @else
              <a href="{{ url('/experts/listing') }}">All</a>
              @endif
            @endif -->
            @if($courses != null)
                  @foreach($courses as $course)
                      @if($course_id == $course->id)
                      <a class="active" href="{{ url('/experts/listing') }}/{{ $course->id }}">{{$course->title}}</a>
                      @else
                      <a href="{{ url('/experts/listing') }}/{{ $course->id }}">{{$course->title}}</a>
                      @endif
                  @endforeach
          @endif

          <!-- @if($id != null)
              @if($id == "all")
              <a class="active" href="{{ url('/user/experts') }}">All</a>
              @else
              <a href="{{ url('/user/experts') }}">All</a>
              @endif
            @endif -->
            @if($id != null)
                  <div id="menu">
                    <div class="panel list-group">

                      @foreach($categorys as $category)
                          @if(in_array($id,$category->subcategory->pluck('id')->toArray()))
                          <a href="#" class="active" data-toggle="collapse" data-target="#sm{{ $category->id }}" data-parent="#menu">{{$category->name}}<span class="glyphicon glyphicon-chevron-right"></span></a>
                          <!-- <a class="active" href="{{ url('/user/experts') }}/{{ $category->id }}" data-toggle="collapse" data-target="#sm{{ $category->id }}" data-parent="#menu">{{$category->name}}</a> -->
                          @else
                          <a href="#" data-toggle="collapse" data-target="#sm{{ $category->id }}" data-parent="#menu">{{$category->name}}<span class="glyphicon glyphicon-chevron-right"></span></a>
                          @endif
                          @if($category->subcategory)
                             <div id="sm{{ $category->id }}" class="sublinks collapse">
                            @foreach($category->subcategory as $subcategory)
                              <a href="{{ url('/user/experts') }}/{{ $subcategory->id }}" class="small @if($id == $subcategory->id) active @endif">>> {{$subcategory->name}}</a>
                           @endforeach
                             </div>
                          @endif
                      @endforeach
                    </div>
                  </div>
          @endif

          <!-- @if($emsat_id != null)
              @if($emsat_id == "all")
              <a class="active" href="{{ url('/expert/listing') }}">All</a>
              @else
              <a href="{{ url('/expert/listing') }}">All</a>
              @endif
            @endif -->
            @if($emsats != null)
                  @foreach($emsats as $emsat)
                      @if($emsat_id == $emsat->id)
                      <a class="active" href="{{ url('/expert/listing') }}/{{ $emsat->id }}">{{$emsat->title}}</a>
                      @else
                      <a href="{{ url('/expert/listing') }}/{{ $emsat->id }}">{{$emsat->title}}</a>
                      @endif
                  @endforeach
          @endif

          </div>
        </div>
        <div class="col-md-9">
          <div class="row">
          @if(sizeof($doctors)>0)
            @foreach($doctors as $doctor)
            <div class="col-md-6">
              <div class="tutor-wrap">
                <div class="row">
                  <div class="col-md-4">
                    <div class="img-wrap">
                        @if($doctor['doctordetail']->profile_image == '' &&  $doctor['doctordetail']->profile_image == null)
                            <img src="{{asset('assets/iedu/images/dummy_profile.webp')}}" alt="">
                            @else
                            <img src="{{Storage::disk('spaces')->url('uploads/'.$doctor['doctordetail']->profile_image)}}" alt="">
                        @endif
                    </div>
                  </div>
                  <div class="col-md-8">
                    @php
                        $date=\Carbon\Carbon::now()->format('Y-m-d');

                        $experience = \Carbon\Carbon::parse($doctor['profile']->working_since ?? $date)->age;

                    @endphp
                  <h5>@if(!empty($doctor['doctordetail'])){{$doctor['doctordetail']->name}} @endif <a class="float-right" href="{{ url('user/getSchedule') }}?booking_type={{$booking_type ?? ''}}&booking_id={{$booking_id}}&category_id={{ $doctor['categoryData']->id ?? ''}}&service_id={{ $doctor['getServices'][0]->service_id ?? ''}}&expert_id={{$doctor['doctordetail']->id ?? ''}}&schedule_type=schedule&date={{ $current_date }}">Schedule</a></h5>
                    <p>@if(!empty($doctor['categoryData'])){{$doctor['categoryData']->name}} @endif   ·  {{$experience}} years of exp</p>
                    <span class="d-block"><img class="mr-2" src="{{ asset('assets/iedu/images/ic_star.png')}}">{{$doctor['rating']}} · {{$doctor['reviewcount']}} Reviews <h5><a href="{{ url('user/chat/iedu?request_id').'='.$doctor['doctordetail']->id}}" class="">Chat</a></h5></span>
                    <!-- <strong>AED 43</strong> -->
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @else
            <div class="col-md-12 text-center">
                {{ 'No Records.' }}
            </div>
           @endif
            <div class="col-md-12 text-center">
              {{ $doctors->links() }}
              <!-- <nav aria-label="Page navigation example" class="d-flex justify-content-center pt-1 pb-1 mt-4">
                <ul class="pagination">
                  <li class="page-item" id="pagPrevious">
                    <a class="page-link" href="#" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item"><a class="page-link active" href="#" id="pag01">01</a></li>
                  <li class="page-item"><a class="page-link" href="#" id="pag02">02</a></li>
                  <li class="page-item"><a class="page-link" href="#" id="pag03">03</a></li>
                  <li class="page-item"><a class="page-link" href="#" id="pag04">04</a></li>
                  <li class="page-item"><a class="page-link" href="#" id="pag05">05</a></li>
                  <li class="page-item" id="pagNext">
                    <a class="page-link" href="#" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav> -->
              <!-- <div class="text-center show-numbers">
                <p>1 - 4 of 20 Results</p>
              </div> -->
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</section>
<script>

var searchRequest = 'hello how r you';

function searchFunction() {
    var minlength = 3;

    $("#searching").keyup(function () {
        var that = this,
        value = $(this).val();


        if (value.length >= minlength ) {
            // if (searchRequest != null)
            searchRequest = $.ajax({
                type: "POST",
                url: "{{ url('/user/search') }}",
                data: {
                    'search' : value
                },
                // dataType: "json",
                success: function(data){
                    // location.reload();
                   $('#searching').val(value);
                }
            });
            searchRequest.abort();
        }
    });
}
</script>
@endsection
