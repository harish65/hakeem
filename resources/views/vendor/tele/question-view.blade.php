@extends('vendor.tele.layouts.index', ['title' => 'Free Question Detail'])
@section('content')
<div class="offset-top"></div>
    <!-- Home Banner Section -->
    <!-- About us Section -->
    <!-- About us Section -->
    <section class="about-us-section" id="about-us">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                <!-- <div class="top-rounded-text mb-3"><span class="">Blogs Detail</span></div> -->
                <h4 class="mt-2">{{$question->user->name}}</h5>
                <p>{{date('d/m/Y',strtotime($question->created_at))}}</p>
                <hr>
                <div class="heading-text mb-4">{{ $question->title }}</div>
                    <pre class="free-qus">{{ $question->description }}</pre>
                </div>
                <div class="col-md-5 text-right">
                    <img class="img-fluid mt-4" src="{{ Storage::disk('spaces')->url('original/'.$question->image) }}">
                </div>
            </div>
        </div>
    </section>
@endsection
