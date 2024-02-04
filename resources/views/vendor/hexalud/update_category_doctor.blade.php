@extends('vendor.hexalud.layouts.dashboard', ['title' => 'Patient'])
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
  <!-- Offset Top -->
  <div class="offset-top"></div>

<!-- Manage Availability-Doctor Section -->
<section class="profile-wrapper edit-profile mb-lg-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <h1>Account</h1>
            </div>
            <div class="col-lg-4 pr-lg-0">
                <div class="bg-them border-0 text-center">
                    <div class="position-relative user-image-rd px-5 pt-5">
                                @if(Auth::user()->profile_image == '' &&  Auth::user()->profile_image == null)
                                 <img style="width:200px;" src="{{asset('assetss/images/ic_upload profile img.png')}}" alt="">
                                 @else
                                 <img style="width:200px;" src="{{Storage::disk('spaces')->url('uploads/'.Auth::user()->profile_image)}}" alt="">
                                @endif
                        <hr>
                    </div>
                    <ul class="doctor-list pb-2 text-left">
                    <li><a href="{{url('service_provider/profile')}}/{{Auth::user()->id}}"> Profile Details</a></li>
                            <li><a href="{{ url('service_provider/get_manage_availibilty')}}">Manage Availability</a></li>
                            <li><a href="{{ url('service_provider/get_manage_preferences')}}">Manage Preferences</a></li>
                            <li class="active"><a href="{{ url('service_provider/get_update_category')}}">Update Category</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 profile-detail">
               <div class="bg-them manage-profile h-100">
                <div class="row">
                    <div class="col-12">
                        <h6 class="mt-0 mb-4">Category Selected</h6>
                        @if(session('status.success'))
                            <div class="alert alert-outline alert-success custom_alert">
                                {{ session('status.success') }}
                            </div>
                        @endif

                        @if(session('status.error'))
                            <div class="alert alert-outline alert-danger custom_alert">
                                {{ session('status.error') }}
                            </div>
                        @endif
                    </div>


                    <div class="col-md-12 mb-3">
                    <div class="row">
                        <?php foreach ($categories as $key => $category) {
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
                                        <div class="col-md-6 mb-3 choose_category selected_category" data-id="{{ $category->id }}">
                                    @else
                                        <div class="col-md-6 mb-3 choose_category" data-id="{{ $category->id }}" >
                                    @endif
                                @else
                                    <div class="col-md-6 mb-3 choose_category" data-id="{{ $category->id }}">
                                @endif
                                    <div class="outer-phy d-flex align-items-center" style="background-color:{{ $category->color_code }}">
                                        <span>
                                        <img src="{{ Storage::disk('spaces')->url('original/'.$category->image) }}" class="img-fluid">
                                         </span>
                                        <h3 class="general">
                                            {{ $category->name }}
                                        </h3>
                                        <h3></h3>
                                    </div>
                                </div>
                           <?php } ?>
                            </div>

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
