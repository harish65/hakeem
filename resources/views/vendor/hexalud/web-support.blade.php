@extends('vendor.hexalud.layouts.index', ['title' => 'Home'])
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
                    <p>Connect with Phone:<a href="tel:+917907479660"> <i class="fa fa-phone"></i> +91156545561</a></p>
                    <p>Connect with Email:<a href="mailto:drn@gmail.com"> <i class="fa fa-envelope"></i> hexalud@gmail.com</a></p>
                </div>
                <div class="col-md-5 text-right">
                    <img class="img-fluid mt-4" src="{{ asset('assets/healtcaremydoctor/images/ic_111.png') }}">
                </div>
            </div>
        </div>
    </section>
@endsection