
@extends('vendor.912consult.layouts.index', ['title' => 'My Questions Listing'])
@section('css-script')
<style type="text/css">
section.help-section {
padding: 70px 0;
}

section.help-section h3 {
color: #444444;
font-size: 40px;
margin-bottom: 30px;
font-weight: 600;
}
.help-section .card-header {
    background: #fff;
    border: 0;
    font-size: 18px;
    border-radius: 14px;
    padding: 20px 24px;
    position: relative;
    border: 1px solid #31398f;
    transition: 0.5s;
}
.help-section .card-body {
    border: 1px solid #ddd;
    border-radius: 0 0 10px 10px;
}
.help-section .card-header::before {
    position: absolute;
    right: 30px;
    top: 27px;
    width: 15px;
    height: 15px;
    border: 2px solid #31398f;
    content: "";
    border-top: 0;
    border-left: 0;
    transform: rotate(-45deg);
    transition: 0.5s;
    pointer-events: none;
}
.help-section .card-header.active a {
    color: #fff;
}
.help-section .card-header.active {
    background: #31398f;
    border-radius: 10px 10px 0px 0;
}
.help-section .card-header.active::before {
transform: rotate(45deg);
transition: 0.5s;
}
.help-section .card {
border: 0;
margin-bottom: 12px;
}
.help-section .card-header a {
color: #31398f;
width: 100%;
float: left;
}
.help-section .card-body {
color: #444444;
font-size: 16px;
}
.help-section .card-header.active::before
{
    border-color: #fff;
}
body section.help-section h3 {
    margin-bottom: 30px;
    font-weight: 600;
    color: #000;
    font-family: Campton;
    font-size: 28px;
}
body section.help-section img {
    height: 50px;
    width: 50px;
    border-radius: 100%
}
.appointment-inner img {
    height: 170px!important;
    width: 170px!important;
    margin: auto!important;
}
</style>
@endsection
@section('content')
<div class="offset-top"></div>
    <!-- Home Banner Section -->
    <!-- About us Section -->
    <!-- About us Section -->
<section class="help-section bg-white mb-5" id="questions">
  <div class="container">
    <h3>My Questions</h3>
    <div id="accordion">
    @forelse($questions as $key=>$question)
    <div class="card">
      <div class="card-header {{!$key ? 'active' : ''}}">
        <a class="card-link" data-toggle="collapse" href="#collapse{{$key}}">
          {{$question->title}} <span class="float-right mr-5">@if($question->amount > 0) ₹{{$question->amount}} @endif</span>
        </a>
      </div>
      <div id="collapse{{$key}}" class="collapse {{!$key ? 'show' : ''}}" data-parent="#accordion">
        <div class="card-body">
          {{$question->description}}

          @if(isset($question->answers) && count($question->answers)>0)
          <hr>
          Answers
          <hr>
          @foreach($question->answers as $answer)
          <div class="row">
            <div class="col-md-1">
              @if(isset($answer->user) && !is_null($answer->user->profile_image))
              <img class="float-right" src="Storage::disk('spaces')->url('uploads/'.$answer->user->profile_image) }}" alt="" >
              @else
              <img class="float-right" src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
              @endif
            </div>
            <div class="col-md-11">
              <h4>{{$answer->user->name}}</h4>
              <p>{{$answer->answer}}</p>
            </div>
          </div>
          <hr>
          @endforeach
          @endif

        </div>
      </div>
    </div>
   @empty
     <div class="row">
         <div class="appointment-inner">
            <img src="{{asset('assetss/images/no-data.png')}}" alt="">
            <div class="text">
               <h4 class="mb-4">No Question</h4>
               <p>You don't have any Question till</p>
            </div>
            <br>
            <a class="btn-info btn" href="{{url('/web/ask-question')}}">Ask Now</a>
         </div>
      </div>
   <!-- <div class="card no-found">
    <img src="{{asset('assetss/images/no-data.png')}}" alt="">
    <h4>No Data Found</h4>
    </div> -->
   @endforelse
  </div>
  <div class="row">
    <div class="col text-center">
        {{ $questions->links() }}
    </div>
</div>
   </div>
  </section>
<script type="text/javascript">
$(document).ready(function(){
  $('.card-header').on('click', function(){
    var myClass = $(this).attr("class").split(' ')[1];
    if(myClass == 'active')
    {
       $(this).removeClass('active');
    }else{
      $(".card-header").removeClass('active');
      $(".collapse").removeClass('show');
      $(this).addClass('active');
    }
  });
});

</script>
@endsection
