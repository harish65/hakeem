@extends('vendor.care_connect_live.layouts.index', ['title' => 'Home'])
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
                    <p>Conect with Phone:<a href="tel:+917296833790"> <i class="fa fa-phone"></i> +917296833790</a></p>
                    <p>Conect with Email:<a href="mailto:support@thefinesthealthcare.com"> <i class="fa fa-envelope"></i> support@thefinesthealthcare.com</a></p>
                </div>
                <div class="col-md-5 text-right">
                    <img class="img-fluid mt-4" src="{{ asset('assets/care_connect_live/images/ic_111.png') }}">
                </div>
            </div>
        </div>
    </section>
@endsection