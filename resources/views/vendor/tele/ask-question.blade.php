@extends('vendor.tele.layouts.dashboard', ['title' => 'Ask a free Question'])
@section('css-script')
<style type="text/css">
    /*Ask qustions screen css start */
.login-outer {
    border-radius: 6px;
    background-color: #FFFFFF;
    box-shadow: 0 3px 22px 0 rgb(0 0 0 / 13%);
    padding: 30px 20px;
    z-index: 999 !important;
    position: relative;
}
.choose-time.current {
    opacity: 1;
    transform: scale(1.03);
    box-shadow: 0 0 10px 1px #6b6b6b;
    transition: 0.3s;
}
.help-section .card-header.active{border-radius: 14px 14px 0px 0px !important;}
.help-section .card-header{
    color: #444444;
    font-size: 16px;
    background: #ccc;
    border-radius: 0px 0px 13px 13px;
}
.help-section .card {
    border: 0;
    margin-bottom: 12px;
    background: #ccc;
    border-radius: 13px;
}
.login {
    height: 90vh;
    display: flex;
    align-items: center;
    justify-content: center;
}
.help-section .card-header{background: #31398f17 !important;
    border-radius: 0px 0px 13px 13px !important;
}


.login-heading {
    color: #2D2A2A;
    font-size: 22px;
    letter-spacing: 0;
    line-height: 30px;
    font-weight: 600;
    margin-bottom: 20px;
}

.form-design .form-control {
    height: 48px;
    border-radius: 4px;
    border: 0px;
    background-color: #F7F7F7;
    resize: none;
}

.form-design textarea::placeholder {
    font-size: 16px;
    font-weight: 300;
}

.form-design input::placeholder {
    font-size: 16px;
    font-weight: 300;
}

.form-design .form-control:focus {
    box-shadow: none;
}

.form-design select {
    font-size: 16px;
    font-weight: 300;
    color: #495057;
}

.submit-btn {
    background: #31398F;
    color: #fff !important;
    margin: 15px 0px;
    border-radius: 2px;
    font-weight: 600;
    font-size: 16px;
    text-transform: capitalize;
    width: fit-content;
    width: -moz-fit-content;
    justify-content: center;
    align-items: center;
    text-align: center;
    border: 0;
    padding: 14px 30px;
    border-radius: 6px;
}

.title-bold {
    font-size: 16px;
    font-weight: 600;
    color: #000;
    opacity: 1;
}

.title-bold span {
    font-size: 12px;
}

.recive-msg img {
    width: 30px;
}

.recive-msg {
    font-size: 14px;
}
.choose-select {
    pointer-events: none;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9;
    background: #fd8101;
    padding: 13px;
}
.choose-select span {
    color: #fff;
}
.choose-select h4 {
    color: #ffff;
    margin-bottom: 4px;
}
.choose-select h5 {
    margin-top: 7px;
    font-weight: 700;
}
.choose-time input {
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    background: transparent;
    border: 0;
    cursor: pointer;
}

.choose-time {
    position: relative;
    margin-top: 10px;
}
.choose-time.current input {
    cursor: not-allowed;
     cursor: inherit;
}
</style>
@endsection
@section('content')
<div class="offset-top"></div>
    <!-- Home Banner Section -->
    <!-- About us Section -->
    <!-- About us Section -->
    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto d-block">
                    <div class="login-outer form-design">
                        <h1 class="login-heading mb-2">Ask a Question</h1>
                        <p class="enter-id2 mb-4">Make sure what you’re asking is unique, concise, and phrased like a question.</p>
                        <form action="{{url('ask-questions')}}" method="POST" id="ask_question_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="title-bold">Title <span>(Required)</span></label>
                                        <input type="text" class="form-control" placeholder="What’s your question? Be specific and unique..." name="title" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="title-bold">Description <span> (Required)</span></label>
                                        <textarea class="form-control h-auto" rows="5" id="comment" placeholder="Add More details to get the best answer..." name="description" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <lable class="title-bold mb-2">Choose response time</lable>
                                        <div class="row">
                                            @foreach($packages as $package)
                                            <div class="col-md-5">
                                                <div class="choose-time">
                                                    <input type="radio" name="package_id" value="{{$package->id}}" required>
                                                    <div class="choose-select" style="background:{{$package->color_code}} !important;">
                                                    <span>
                                                        <h4>{{$package->title}}</h4>
                                                        <p>{{$package->description}}</p>
                                                        <h5>₹{{$package->price}}</h5>
                                                    </span>
                                                   <!--  <img src="{{ Storage::disk('spaces')->url('thumbs/'.$package->image_icon) }}" alt=""> -->
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <button type="submit" class="btn w-100 mx-auto d-block glow-on-hover submit-btn">Submit Questions</button>
                            <p class="recive-msg"><img src="{{asset('assets/healtcaremydoctor/images/incoming-mail.png')}}" class="img-fluid pr-1">
                                You'll receive an email when someone answers or comments on your question.
                             </p>
                        </form>
                    </div>
                </div>


            </div>
        </div>
        </div>
    </section>
<script type="text/javascript">
    $('#ask_question_form').on('submit',function(){
        $.ajax({
            type: "post",
            dataType: "json",
            url: "{{url('ask-questions')}}",
            data: $('#ask_question_form').serialize(),
            success: function (response) {
               console.log(response);
               if(response.status == "success")
               {
                 Swal.fire('Success!',response.message,'success')
                 .then((result)=>{
                    window.location.reload();
                });;
               }else{
                Swal.fire('Warning!',response.message,'warning');
               }
            }
        });
        return false;
    });
    function submitQuestion()
    {
        var data = $('#ask_question_form').serializeArray();

    }
</script>
<script type="text/javascript">
    $('.choose-time').on('click', function(){
    $('.choose-time.current').removeClass('current');
    $(this).addClass('current');
});
</script>
@endsection
