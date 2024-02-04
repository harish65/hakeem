@extends('vendor.taradoc.layouts.index', ['title' => 'Home'])
@section('content')
<div class="offset-top"></div>
    <!-- Home Banner Section -->
    <!-- About us Section -->
    <section class="about-us-section" id="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 support">
                <!--div class="top-rounded-text mb-3"><span class="">Support</span></div-->
                <div class="heading-text mb-4">We would love to hear from you, reach out to us at</div>
                    <p>Conect with Phone:<a href="tel:+"> <i class="fa fa-phone"></i> +</a></p>
                    <p>Conect with Email:<a href="mailto:support@taradoc.com"> <i class="fa fa-envelope"></i> support@taradoc.com</a></p>
                </div>
                <div class="col-md-5 text-right">
                    <img class="img-fluid mt-4" src="{{ asset('assets/taradoc/images/illu.png') }}">
                </div>
            </div>
        </div>
    </section>
@endsection