@extends('vendor.iedu.layouts.index', ['title' => 'Courses','show_footer'=>true])
@section('content')
<section class="study-material">
      <div class="container">
              <ul class="nav nav-tabs">
              	@foreach($classes as $k=>$class)
                	<li><a class="{{ ($k==0)?'active':'' }}" data-toggle="tab" href="#menu{{ $k }}">{{ $class->name }}</a></li>
              	@endforeach
                    <!-- <li><a data-toggle="tab" href="#home">Class 6th</a></li> -->
              </ul>
              <div class="tab-content">
              	@foreach($classes as $k=>$class)
                	<div id="menu{{ $k }}" class="tab-pane fade {{ ($k==0)?'active show':'' }}">
	                  <div class="row">
	                  	@foreach($class->subjects as $subject)
	                    <div class="col-lg-3 col-md-6 col-sm-6" @if(Auth::check()) onclick="location.href=base_url+'/user/experts/'+{{ $subject->id }};" @endif>
	                      <div class="class-card education" style="--bg-color:{{ '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) }}">
	                      <div class="overlay"></div>
	                      <div class="image-wrap">
	                        <img height="130px" width="130px" src="{{ ($subject->image)? Storage::disk('spaces')->url('uploads/'.$subject->image) : '' }}">
	                      </div>
	                        <h3 class="mt-3">{{ ($subject)?$subject->name:'' }}</h3>
	                        <!-- <p>1,119,045 Graduates</p> -->
	                   @if(!Auth::check())     <button class="enroll-btn" data-toggle="modal" data-target="#users">Enroll Now</button> @endif
	                      </div>
	                    </div>
              			@endforeach
	                  </div>
                	</div>
             	@endforeach
             	
             </div>


      </div>
</section>
@endsection