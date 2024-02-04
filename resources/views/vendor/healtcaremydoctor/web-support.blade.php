@extends('vendor.healtcaremydoctor.layouts.index', ['title' => 'Home'])
@section('content')
<div class="offset-top"></div>
    <!-- Home Banner Section -->
    <!-- About us Section -->
    <section class="about-us-section" id="about-us">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                <div class="top-rounded-text mb-3"><span class="">Support</span></div>
                <div class="heading-text mb-4">You Can Ask question<span> Here </span></div>
                    <p>Conect with Phone:<a href="tel:+917296833790">+917296833790</a></p>
                    <p>Conect with Email:<a href="mailto:pbudania18@gmail.com">Support Email</a></p>
                </div>
                <div class="col-md-5 text-right">
                    <img class="img-fluid mt-4" src="{{ asset('assets/healtcaremydoctor/images/ic_111.png') }}">
                </div>
            </div>
        </div>
    </section>
@endsection