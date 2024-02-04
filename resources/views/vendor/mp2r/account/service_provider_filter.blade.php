@extends('vendor.mp2r.layouts.index', ['title' => 'Manage Availability','header_after_login'=>true])
@section('css')
    
@endsection
@section('content')

<style>
.hide{
	display:none;
}
.imgt{
height: 79px;
    width: 79px;
    border-radius: 50%;
    object-fit: cover;
    /* border: solid; */
}
</style>

	<section class="main-height-clr bg-clr">
		<div class="container">
			<div class="row">
					<!-- left side  -->
				<!-- left side  -->
				<div class="col-md-4 col-lg-4 col-sm-4">
					<div class="left-dashboard mt-5">
						<div class="side-head pb-0">
						<h3 class="">Service Provider Dashboard</h3>
						</div>
						<hr/>
						@include('vendor.mp2r.layouts.spmenu',['tab' =>'search'])
					</div>
				</div>
				
				<!-- left side  end -->	
				<div class="col-lg-8 col-md-8 col-sm-8">
					<section class="right-side mt-5">
						<div class="row align-items-center">
							<div class="col-md-12 col-sm-12">
								<h3 class="appointment">Select a Category</h3>
							</div>
						</div>
					</section>
					<section class="wrapper wrap">
						<div class="row">
			                @foreach($categories as $category)
			                	@if($category->id == 4)
			                    <div class="col-md-6 col-lg-6 col-sm-6 select_category"  data-category_id="{{ $category->id}}" data-is_subcategory="{{ $category->is_subcategory}}">
			                        <a href="https://findhelp.org/search_results/%7BZipCode">
			                            <div class="outer-cover" style="box-shadow: inset 0 2px 0 0 {{ $category->color_code}}, 0 1px 6px 0 rgba(0,0,0,0.11);background-color: {{ $category->color_code}};">
			                                <h2 class="mat-provider">{{ $category->name }} </h2>
			                                <img style="height: 200px" src="{{ Storage::disk('spaces')->url('uploads/'.$category->image) }}" class="img-fluid ml-auto d-block pt-3">
			                            </div>
			                        </a>
			                    </div>
			                    @elseif($category->id == 2)
			                    <div class="col-md-6 col-lg-6 col-sm-6 select_category"  data-category_id="{{ $category->id}}" data-is_subcategory="{{ $category->is_subcategory}}">
			                        <a href="{{ route('sp.SPCounselor',['id' => $category->id ])}}">
			                            <div class="outer-cover" style="box-shadow: inset 0 2px 0 0 {{ $category->color_code}}, 0 1px 6px 0 rgba(0,0,0,0.11);background-color: {{ $category->color_code}};">
			                                <h2 class="mat-provider">{{ $category->name }} </h2>
			                                <img style="height: 200px" src="{{ Storage::disk('spaces')->url('uploads/'.$category->image) }}" class="img-fluid ml-auto d-block pt-3">
			                            </div>
			                        </a>
			                    </div>
			                    @else
			                    <div class="col-md-6 col-lg-6 col-sm-6 select_category"  data-category_id="{{ $category->id}}" data-is_subcategory="{{ $category->is_subcategory}}">
			                        <a href="{{ route('SPCategoryFilter',['id' => $category->id ])}}">
			                            <div class="outer-cover" style="box-shadow: inset 0 2px 0 0 {{ $category->color_code}}, 0 1px 6px 0 rgba(0,0,0,0.11);background-color: {{ $category->color_code}};">
			                                <h2 class="mat-provider">{{ $category->name }} </h2>
			                                <img style="height: 200px" src="{{ Storage::disk('spaces')->url('uploads/'.$category->image) }}" class="img-fluid ml-auto d-block pt-3">
			                            </div>
			                        </a>
			                    </div>
			                    @endif
			                @endforeach
		            	</div>
					</section>
				</div>
			</div>
		</div>
	</section>

@endsection
@section('script')
<script>
   function openCity(evt, cityName,dot1) {
	//   alert('a');
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";

  evt.currentTarget.className += " active";
  $('.dot').hide();
  //document.getElementsByClassName('dot').style.display = "none";
  document.getElementById(dot1).style.display = "inline-block";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

@endsection