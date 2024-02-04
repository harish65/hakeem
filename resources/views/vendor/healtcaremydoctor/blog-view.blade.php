@extends('vendor.healtcaremydoctor.layouts.index', ['title' => 'Blog Detail'])
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
                <div class="heading-text mb-4">{{ $blog->title }}</div>
                    <p>{{ $blog->description }}</p>
                </div>
                <div class="col-md-5 text-right">
                    <img class="img-fluid mt-4" src="{{ Storage::disk('spaces')->url('original/'.$blog->image) }}">
                </div>
            </div>
        </div>
    </section>
@endsection