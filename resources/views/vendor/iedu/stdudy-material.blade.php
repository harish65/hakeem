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
	                  	@foreach($class->topics as $topic)
	                    <div class="col-lg-3 col-md-6 col-sm-6" onclick="location.href=base_url+'/web/stdudy-material-detail/'+{{ $topic->topic_id }};">
	                      <div class="class-card education" style="--bg-color:{{ '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) }}">
	                      <div class="overlay"></div>
	                      <div class="image-wrap">
	                        <img height="130px" width="130px" src="{{ ($topic->topic->image_icon)?Storage::disk('spaces')->url('uploads/'.$topic->topic->image_icon):'' }}">
	                      </div>
	                        <h3 class="mt-3">{{ ($topic->topic)?$topic->topic->title:'' }}</h3>
	                        
							@if(!Auth::check())    <button class="enroll-btn">Enroll Now</button> @endif
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