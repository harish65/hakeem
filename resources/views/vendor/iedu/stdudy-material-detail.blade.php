@extends('vendor.iedu.layouts.index', ['title' => 'Courses','show_footer'=>true])
@section('content')
<style>
.btn.btn-danger {
	color: white;
	font-weight: bold;
}
.btn.btn-primary {
	color: white;
	font-weight: bold;
}

</style>
<section class="study-matterial-detail">
  <div class="container">
    <div class="row">
      <div class="col-md-5">
          <div class="study-matterial-detail-lft">
              <div class="detail-desc">
                <img src="{{ ($topic_detail)?Storage::disk('spaces')->url('uploads/'.$topic_detail->image_icon):'' }}" alt="">
                <span>
                <h4>Author: {{ ($topic_detail->author)?$topic_detail->author:'' }}</h4>
                  <p>{{ $topic_detail->title }}</p>
                </span>
              </div>
              <h5>Explore all Chapters</h5>
              <ul>
                @foreach($topic_detail->study_materials as $k=>$st)
                  <li><span>{{ $k+1 }}</span>{{ $st->title }}</li>
                @endforeach
              </ul>
          </div>
      </div>
        <div class="col-md-7">
          <div class="study-matterial-detail-rgt">
              <div class="detail-head">
                  <h3>{{ $topic_detail->title }}</h3>
                  <span>AED{{ $topic_detail->price }}</span>
              </div>
              <hr>
              <div class="detail-desc-in">
                <h5>Overview</h5>
                <p>{{ $topic_detail->description }}</p>
              </div>

             <!-- <div class="detail-desc-in">
              <h5>All topics</h5>
               <ul class="detail-desc-list">
                  <li class="active"><span>01</span>Substances and mateial <i class="fa fa-chevron-right" aria-hidden="true"></i></li>
                  <li><span>02</span>Sorting Materials into Groups <i class="fa fa-chevron-right" aria-hidden="true"></i></li>
                  <li><span>03</span>Sorting Materials into Groups <i class="fa fa-chevron-right" aria-hidden="true"></i></li>
              </ul>
             </div> -->
              <div class="detail-desc-in border-bottom-0">
                <h5>Find Everything You need</h5>
               <div class="row">


                   @if($topic_detail->subscribe==false)
                      @foreach($topic_detail->study_materials as $k=>$st)
                      <div class="col-md-2" style="padding-bottom:10px;">

                              @if($st->type=='pdf')
                                <img src="{{asset('assets/iedu/images/PDF_file_icon.svg')}}" width="50px" height="50px" >
                              @elseif($st->type=='video')
                                <img width="50px" height="50px" src="{{ ($topic_detail)?Storage::disk('spaces')->url('uploads/'.$topic_detail->image_icon):'' }}">
                              @else
                                <img width="50px" height="50px" src="{{ ($topic_detail)?Storage::disk('spaces')->url('uploads/'.$topic_detail->image_icon):'' }}" alt="">
                              @endif
                      </div>

                      <div class="col-md-10">
                          <h6>{{ $st->title }}</h6>
                          <p>{{ $st->description }}</p>
                      </div>
                      @endforeach
                    @else
                    @foreach($topic_detail->study_materials as $k=>$st)
                    <div class="col-md-2" style="padding-bottom:10px;">

                          @if($st->type=='PDF' || $st->type=='pdf')
                            <img src="{{asset('assets/iedu/images/PDF_file_icon.svg')}}" width="50px" height="50px" >
                          @elseif($st->type=='video' || $st->type=='VIDEO')
                            <img width="50px" height="50px" src="{{ ($topic_detail)?Storage::disk('spaces')->url('uploads/'.$topic_detail->image_icon):'' }}">
                          @else
                            <img width="50px" height="50px" src="{{ ($topic_detail)?Storage::disk('spaces')->url('uploads/'.$topic_detail->image_icon):'' }}" alt="">
                          @endif
                    </div>

                    <div class="col-md-10">
                    @if($st->type=='PDF' || $st->type=='pdf')
                    <a target=_blank href="{{ ($st->file_name)?Storage::disk('spaces')->url('pdf/'.$st->file_name):'' }}">   <h6>{{ $st->title }}</h6> </a>
                    <a target=_blank href="{{ ($st->file_name)?Storage::disk('spaces')->url('pdf/'.$st->file_name):'' }}">    <p>{{ $st->description }}</p> </a>
                    @elseif($st->type=='video' || $st->type=='VIDEO')
                    <a target=_blank href="{{ ($st->file_name)?Storage::disk('spaces')->url('video/'.$st->file_name):'' }}">   <h6>{{ $st->title }}</h6> </a>
                    <a target=_blank href="{{ ($st->file_name)?Storage::disk('spaces')->url('video/'.$st->file_name):'' }}">    <p>{{ $st->description }}</p> </a>
                    @else
                    <a target=_blank href="{{ ($st->file_name)?Storage::disk('spaces')->url('uploads/'.$st->file_name):'' }}">   <h6>{{ $st->title }}</h6> </a>
                    <a target=_blank href="{{ ($st->file_name)?Storage::disk('spaces')->url('uploads/'.$st->file_name):'' }}">    <p>{{ $st->description }}</p> </a>
                    @endif

                    </div>
                    @endforeach
                   @endif


               </div>
              </div>
              <!-- <div class="detail-desc-in">
                <h5>Practice Important Questions</h5>
                <div class="row">
                  <div class="col-md-6">
                      <div class="ncert-solution">
                          <h4>NCERT Solution for 6th class Chapter 6 </h4>
                          <p>45 Qs</p>
                      </div>
                  </div>
                   <div class="col-md-6">
                      <div class="ncert-solution">
                          <h4>NCERT Solution for 6th class Chapter 6 </h4>
                          <p>45 Qs</p>
                      </div>
                  </div>
                   <div class="col-md-6">
                      <div class="ncert-solution">
                          <h4>NCERT Solution for 6th class Chapter 6 </h4>
                          <p>45 Qs</p>
                      </div>
                  </div>
                   <div class="col-md-6">
                      <div class="ncert-solution">
                          <h4>NCERT Solution for 6th class Chapter 6 </h4>
                          <p>45 Qs</p>
                      </div>
                  </div>
                </div>
              </div> -->
            @if($topic_detail->subscribe==false)  <button class="btn rounded subscribe_topic" data-id="{{ $topic_detail->id }}" ><span>Buy</span></button> @endif
              </div>
      </div>
    </div>
  </div>
  </section>
  <script>

  var _post_subscribe_url = "{{ url('subscription-topic') }}";

  $('.subscribe_topic').on('click',function(e){
        e.preventDefault();
        Swal.fire({
          title: 'Do you want to Buy Topic?',
          showCancelButton: true,
          confirmButtonText: `Buy`
          }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            @if(!Auth::check())
            $("#users").modal('show');
            @else
            var topicId = $(this).attr('data-id');
            var token = "{{csrf_token()}}";
            $.post(_post_subscribe_url, {
                    "token": token,
                    "topic_id": topicId
                }).done(function(data){

                  console.log(data);

                  if(data.statuscode == 500)
                  {
                    $("#wallet_message").text(data.message);

                    $("#wallet_message_container").modal('show');

                  }
                  if(data.statuscode == 200)
                  {

                    location.reload();

                  }


                });
                @endif
          }
        })


  });
  </script>
@endsection
