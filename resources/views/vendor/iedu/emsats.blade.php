@extends('vendor.iedu.layouts.index', ['title' => 'Emsats','show_footer'=>true])
@section('content')
<section class="study-material">
      <div class="container">
              <h4>Emsats</h4>
                <div class="row">
                  @foreach($emsats as $emsat)
                  <div class="col-lg-3 col-md-6 col-sm-6">
                    @auth
                      <a href="{{url('expert/listing')}}/{{$emsat->id}}">
                    @endauth
                    @guest
                    <a href="#" data-toggle="modal" data-target="#users">
                    @endguest
                    <div class="class-card education" style="--bg-color:{{ '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6) }}">
                    <div class="overlay"></div>
                    <div class="image-wrap">
                      <img height="130px" width="130px" src="{{ ($emsat->icon)?Storage::disk('spaces')->url('uploads/'.$emsat->icon):'' }}">
                    </div>
                      <h3 class="mt-3">{{ ($emsat)?$emsat->title:'' }}</h3>
                      <!-- <p>{{ $emsat->total }} Graduates</p> -->
                   @if(!Auth::check())
                   <button class="enroll-btn headerSignup" >Enroll Now</button> @endif
                    </div>
                  </a>
                  </div>
                @endforeach
                </div>

         </div>
</section>
@endsection
