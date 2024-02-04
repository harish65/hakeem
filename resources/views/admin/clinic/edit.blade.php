@extends('layouts.vertical', ['title' => 'Edit '.__('text.Vendor')])

@section('css')
<style>
#frame{
  border-radius : 100px;
}

.card-img-size{
height: 150px;
width: 150px;
border-radius: 50%;
overflow: hidden;
margin:20px auto;
position: relative;
border:1px solid #ccc;
}
.card-img-size img{
height: 100%;
width: 100%;
border-radius: 50%;
object-fit: contain;
}
.card-conain {
    padding: 20px;
    text-align: center;
  
}
.card-conain p{
    font-size: 18px;
    font-weight: bold;
    text-align: center;
   margin:0px;
}

.file-pos {
    position: absolute;
    height: 100%;
    width: 100%;
    left: 0px;
    border-radius: 50%;
    opacity: 0;
}
.card-custom .card-img-size{height: 220px;
    width: 220px;
   
}
.mt-80{
    margin-top:80px;
}
</style>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
        <div class="col-12">
            <div class="page-title-box mt-2">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin_dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('clinic') }}">List {{ __('text.Clinic') }}</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
                <h3 class="card-title">Edit {{ __('text.Clinic') }}</h3>
            </div>
        </div>
    </div> 
  <div class="card card-primary">
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form"  autocomplete="off" action="{{ route('update_request' , $clinic->id)}}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
      <div class="col-lg-12">
        <div class="card-custom">
          <div class="card-img-size">
            <input type="file" class="d-none" id="logoFile" name="logo" onchange="preview()">
            
            @if($clinic->profile_image)
                  <img src="{{ Storage::disk('spaces')->url('uploads/'.$clinic->profile_image) }}" class="img-fluid" height="170" width="170" id="frame" >
                  @else
                  <img src="{{ asset('assets/images/logo_clinic.png')}}" class="img-fluid" height="170" width="170" id="frame" >
                  
                  @endif
           
          </div>
        </div>
        <div class="upload_logo text-center" id="upload_logo" >
          <button type="button" class="btn btn-primary btn-sm">Uploade Logo</button>
       </div>
      
    </div>
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6 ">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ @$clinic->name }}" id="name" placeholder="name">
                @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
              <div class="form-group col-md-6 ">
                <label for="name">Comission</label>
                <input type="number" name="commission" min="1" max="100" class="form-control" value="{{ @$clinic->commission }}" id="comission" placeholder="Commission Percentage %">
                @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('commission') }}</span>
                @endif
              </div>
             
          </div>
          
          <div class="row">  
            <div class="form-group col-md-6">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" autocomplete="off" name="email" value="{{ @$clinic->email }}" id="exampleInputEmail1" placeholder="Enter email" autocomplete="off">
              @if ($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>
            <div class="form-group col-md-6">
              <label for="name">Password</label>
              <input type="text" readonly name="password" class="form-control" value="xxxxxxxxxx" id="password" placeholder="password" autocomplete="off">
              @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
            </div>
          </div>


            <div class="form-group">
              
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" name="phone" class="form-control" value="{{ @$clinic->phone }}" id="phone" placeholder="Phone">
              @if ($errors->has('phone'))
                      <span class="text-danger">{{ $errors->first('phone') }}</span>
              @endif
            </div>
            <div class="form-group">
              <label for="phone">Category</label>
              
            </div>
            <input type="hidden" name="type" value="clinic">
            <input type="text" readonly  class="form-control" value="Clinic">

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-info" href="{{ route('clinic')}}">Cancel</a>
          </div>
        </form>
    </div>
  
</div>
   @endsection

@section('script')
<script>
$('#upload_logo').on('click' , function(){
  $('#logoFile').trigger('click')
})
function preview() {
    frame.src=URL.createObjectURL(event.target.files[0]);
}
</script>
@endsection