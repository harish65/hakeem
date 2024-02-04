@extends('vendor.iedu.layouts.index', ['title' => 'Courses','show_footer'=>true])
@section('content')
<section class="study-material">
    <div class="container">
        <h4>Courses</h4>
        <div class="row">
            @foreach($courses as $course)
            <div class="col-lg-3 col-md-6 col-sm-6">
                @if(Auth::check())
                <a href="{{url('experts/listing')}}/{{$course->id}}">
                    @endif
                    <div class="class-card education" style="--bg-color:{{ '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) }}">
                        <div class="overlay"></div>
                        <div class="image-wrap">
                            <img height="130px" width="130px" src="{{ ($course->image_icon)?Storage::disk('spaces')->url('uploads/'.$course->image_icon):'' }}">
                        </div>
                        <h3 class="mt-3">{{ ($course)?$course->title:'' }}</h3>
                        <p>{{ $course->total }} Graduates</p>
                        @if(!Auth::check())
                        <button class="enroll-btn" data-toggle="modal" data-target="#users">Enroll Now</button>
                        @endif
                    </div>
                    @if(Auth::check())
                </a>
                @endif
            </div>
            @endforeach
        </div>

    </div>
</section>
@endsection