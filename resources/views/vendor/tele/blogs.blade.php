

@extends('vendor.tele.layouts.index', ['title' => 'Blog Listing'])
@section('content')
<div class="offset-top"></div>
    <!-- Home Banner Section -->
    <!-- About us Section -->
    <!-- About us Section -->
    <section class="home_blog bg-white mb-5" id="blogs">
        <div class="container">
            <div class="row mb-4 pb-lg-3">
                <div class="col-12">
                    <div class="top-rounded-text mb-3"><span class="">Blogs</span></div>
                </div>
            </div>
            <div class="row  spacing-36">
                @foreach($blogs as $blog)
                <div class="col-lg-4 col-sm-6 mb-4 pb-lg-3">
                    <div class="blog-box radius-8 overflow-hidden">
                        <img src="{{ Storage::disk('spaces')->url('original/'.$blog->image) }}" alt="">
                        <div class="text-box py-4 px-3">
                            <h6 class="m-0">{{ $blog->title }}</h6>
                            <p>{{ \Illuminate\Support\Str::limit($blog->description, 99, $end='...') }}</p>

                            <div class="d-flex align-items-center justify-content-between mt-2">
                                <label class="text-14">Admin </label>
                                <a class="text-14" href="{{ url('web/blog-view').'/'.$blog->id }}">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
             <div class="col text-center">
                {{ $blogs->links() }}
             </div>
          </div>
        </div>
    </section>
@endsection
