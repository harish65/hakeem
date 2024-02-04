@extends('vendor.iedu.layouts.index', ['title' => 'Topic','show_footer'=>true])
@section('content')
<section class="listing-main-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="breadcrum mb-4">
               <a href="{{ url('user/requests')}}">Back</a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
              <div class="listing-tab-inner-left">
                 <ul class="nav nav-pills">
                  <h3>{{ $subject->name }}</h3>
                  <li class="active"><a class="active" data-toggle="pill" href="#home">Topics</a></li>
                  <li><a data-toggle="pill" href="#menu1">Add Topic</a></li>
                  <!-- <li><a data-toggle="pill" href="#menu2">Add Item-1</a></li> -->
                  <!-- <li><a data-toggle="pill" href="#menu3">Add Item-2</a></li> -->
                </ul>
              </div>
          </div>
          <div class="col-md-9">
              <div class="tab-content">
              <div id="home" class="tab-pane fade in active show">

                @foreach($topics as $topic)
                <div class="tags-list">
                <img height="100px" width="100px" style="top:-25%;" src="{{ ($topic->image_icon)?Storage::disk('spaces')->url('uploads/'.$topic->image_icon):'' }}">
                    <span><h5>{{ ($topic)?ucwords($topic->title):'' }}</h5>
                    <p>Author:{{ ($topic)?$topic->sp_data->name:'' }}</p></span>
                </div>
              @endforeach
              </div>
              <div id="menu1" class="tab-pane fade">
                <!-- <a href="#">Add new</a> -->
                <form method="post" action="{{ route('subject.topics.add') }}" enctype="multipart/form-data">
                    <input type="hidden" name="subject_id" value="{{ $subject_id }}">
                    <input type="hidden" name="type" value="image">
                    <input type="hidden" name="_token" value="{{ @csrf_token() }}">

                    <div class="form-group">
                        <label>Preview Image</label>
                        <input type="file" name="image" placeholder="Icon" accept="image/*" required="">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" placeholder="Topic" required="">
                    </div>
                    <label>Topic Description</label>
                    <div class="form-group">
                        {{-- <input type="text" name="description" placeholder="Topic overview" required=""> --}}
                        <textarea class="ckeditor form-control" name="description" required=""></textarea>
                    </div>
                    <!-- <div class="form-group">
                        <label>Add Material  <a href="#">Add new</a></label>
                    </div> -->
                    <div class="form-group">
                        <label>Add price</label>
                        <input type="number" name="price" placeholder="Add price" required="">
                    </div>
                     <div class="form-group">
                        <button type="submit" class="form-control" name="submit">Add Topic</button>
                    </div>
                </form>
              </div>
              <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
              </div>
              <div id="menu3" class="tab-pane fade">
                <h3>Menu 3</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
              </div>
            </div>
            </div>
        </div>
      </div>
  </section>


  <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <script type="text/javascript">
      $(document).ready(function() {
      $('.ckeditor').ckeditor();
      });
  </script>
@endsection


