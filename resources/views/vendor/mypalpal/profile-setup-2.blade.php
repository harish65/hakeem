@extends('vendor.tele.layouts.home', ['title' => 'Profile'])
@section('content')

<style>
    .setup-right .outer-phy .general, .outer-text .general {
        font-size: 28px;
    }
    .choose_category {
        cursor: pointer;
    }

    .setup-right .outer-phy .general, .outer-text .general {
        line-height: 270px;
    }
</style>

<div class="offset-top"></div>

   <!-- Setup Profile Section -->
   <section class="setup-wrapper position-relative">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-5">
                    <div class="setup-left">
                        <img class="img-fluid" src="{{asset('assets/care_connect_live/images/setup-bg.jpg')}}" alt="">

                        <div class="expert-box">
                            <div class="heading-32">Join the best Experts</div>
                            <p>Millions of people are looking for the right expert on TFH. Start your
                                digital journey with Expert Profile</p>
                        </div>
                    </div>
                </div>
                <div class="offset-lg-4 col-lg-8 setup-box">
                    <div class="setup-right pl-lg-3">
                        <div class="p-6 pb-0">
                            <h1>Set up your profile</h1>
                            <p class="mt-2">Set up your personal details, skills, consultation types and Availability
                            </p>
                            <hr class="my-lg-4">
                            <h4 class="mb-4">Select a category</h4>
                            @if(session('status.success'))
                                <div class="alert alert-outline alert-success custom_alert">
                                    {{ session('status.success') }}
                                </div>
                            @endif

                            <!-- <div class="alert alert-outline alert-success custom_alert">
                                some alert here
                            </div> -->

                            @if(session('status.error'))
                                <div class="alert alert-outline alert-danger custom_alert">
                                    {{ session('status.error') }}
                                </div>
                            @endif
                        </div>

                        <div class="p-6 pt-0">
                            <div class="row">
                        <?php
                        foreach ($categories as $key => $category) {
                            $CategoryServiceProvider = new \App\Model\CategoryServiceProvider;
                            $category_data = $CategoryServiceProvider->getCategoryData($category->id);
                            $category->name = $category_data->name;
                            $category->color_code = $category_data->color_code;
                            $category->description = $category_data->description;
                            $category->image = $category_data->image;
                            $category->image_icon = $category_data->image_icon;
                        ?>

                            <input type="hidden" name="categoryid" class="categoryid" value="{{ $category->id }}">
                                @if(sizeof($cat_info) > 0 )
                                    @if($category->id == $cat_info[0])
                                        <div class="col-md-6 mb-3 choose_category" data-id="{{ $category->id }}" data-user_id="{{$id}}">
                                    @else
                                        <div class="col-md-6 mb-3" data-id="{{ $category->id }}" data-user_id="{{$id}}" style="opacity: 0.4;">
                                    @endif
                                @else
                                    <div class="col-md-6 mb-3 choose_category" data-id="{{ $category->id }}" data-user_id="{{$id}}">
                                @endif
                                    <div class="outer-phy d-flex align-items-center" style="background-color:{{ $category->color_code }}">
                                      <span>  <img src="{{ Storage::disk('spaces')->url('original/'.$category->image) }}" class="img-fluid"></span>
                                        <h3 class="general">
                                            {{ $category->name }}
                                        </h3>
                                        <h3></h3>
                                    </div>
                                </div>
                           <?php } ?>
                            </div>
                            <div class="form-footer2" style="margin:20px;">
                                <a class="text_16" href="{{url('/profile/profile-setup-one/'.$id)}}"><i
                                        class="fas fa-chevron-left left-back align-middle pr-2"></i>
                                    <span>Back</span></a>
                                    <a style="float:right;" class="default-btn radius-btn ml-4" href="{{url('/profile/profile-step-three/'.$id)}}"><span>Next</span> </a>

                            </div>



                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var _category_docs_url = "{{ url('/profile/docs_by_category') }}";
        var _category_id_url = "{{ url('/profile/doc_categories') }}";

        var _doc_img_path = "{{ asset('/') }}";

        var _doc_edit_path = "{{ url('/profile/doc_edit') }}/";
        var _doc_del_path = "{{ url('/profile/doc_delete') }}/";


        @if(session('next_needed_doc_id') && session('needed_cat_id'))
            var _next_needed_doc_id = "{{ session('next_needed_doc_id') }}";
            var _next_needed_cat_id = "{{ session('needed_cat_id') }}";
        @else
            var _next_needed_doc_id = null;
        @endif
    </script>
@endsection
