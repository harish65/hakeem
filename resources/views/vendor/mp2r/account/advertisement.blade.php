@extends('vendor.mp2r.layouts.index', ['title' => 'Adevertisement','header_after_login'=>true])
@section('css')
    
@endsection
@section('content')

<style>
.hide{
    display:none;
}
.imgt{
height: 79px;
    width: 79px;
    border-radius: 50%;
    object-fit: cover;
    /* border: solid; */
}
</style>
    <section class="main-height-clr bg-clr">
        <div class="container">
            <div class="row">
                    <!-- left side  -->
                <div class="col-md-4 col-lg-4 col-sm-4">
                    <div class="left-dashboard mt-5">
                        <div class="side-head pb-0">
                        <h3 class="">Service Provider Dashboard</h3>
                        </div>
                        <hr/>
                        @include('vendor.mp2r.layouts.spmenu',['tab' =>'spappointment'])
                    </div>
                </div>
	
	<section class="main-height-clr ">
		<div class="container">
			<!-- breadcrum -->
			<section class="right-side mt-5">
                    @if (session('message'))

                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
					<div class="row align-items-center">
						<div class="col-md-12  bread-sec">
						<h3 class="appointment text-center pb-2">Adevertisement</h3>
						<p class="add-banners-here"> Add banners here</p>
						</div>	
					</div>
			</section>
			
			<section class="help-with2">
    			<form method="post" action="{{ route('sp.addBanner')}}" enctype="multipart/form-data">
                    @csrf
        			<div class="row m-0">
        				<div class="drag-outer">			
        					<div class="file-pos">
            					<h3 class="add-banner"> <i class="fa fa-plus pr-2" aria-hidden="true"></i>Add Banner</h3>
                                <img src="" id="OpenImgUpload">
            					<input type="file" class="brows-file" name="image" id="imgupload">
        					</div>				
        				</div>
        			</div>
        			<button type="submit" class="change-banner mt-4 mb-3 ">Select Banner</button>
    			</form>
			</section>
		</div>
	</section>
@endsection