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
}
canvas {
	-moz-user-select: none;
	-webkit-user-select: none;
	-ms-user-select: none;
}
</style>
 <script type="text/javascript" src="{{ asset('asset/js/jquery.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('asset/js/SendBirdCall.min.js') }}"></script>
	<section class="main-height-clr bg-clr">
		<div class="container">
			<div class="row">
					<!-- left side  -->
				<div class="col-md-4 col-lg-4 col-sm-4">
					<div class="left-dashboard mt-5">
						<div class="side-head pb-0">
						<h3 class="">Service Provider Dashboard</h3> 
						</div>
						<hr/>
						@include('vendor.mp2r.layouts.spmenu',['tab' =>'report'])
					</div>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-8">
					<section class="right-side mt-5">
					<div class="row align-items-center">
						<div class="col-md-12 col-sm-12">
						<h3 class="appointment">Reports</h3>
						</div>					
					</div>
					</section>
					<section class=" wrapper chats">
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-6">
								<div class="total-chats out">
								<p class="chat">Total Chats</p>
								<p class="chat2">{{$requests_data['totalChat']}}</p>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6">
								<div class="total-chats incoming">
								<p class="chat">Total Calls</p>
								<p class="chat2">{{$requests_data['totalCall']}}</p>
								</div>
							</div>
						</div>
						<section class="graph-sec">
							<div class="row  align-items-center m-0 p-4">
								<div class="col-md-6 col-lg-6">
								<h2 class="appoint">Appointments</h2>
								<h2 class="appoint pb-2">{{$requests_data['totalRevenue']}}</h2>
								</div>
								<div class="col-md-6 col-lg-6">
									<ul class="count-number nav">
									<li><h2 class="number">{{$requests_data['unSuccesfullRequest']}}</h2> <span class="red-dot"></span> Unsuccesful</li>
									<li><h2 class="number">{{$requests_data['completedRequest']}}</h2><span class="blue-dot"></span> Successful</li>
									</ul>
								</div>
							</div>
						</section>
						<img src="{{ asset('assets/mp2r/images/ic_line-graph.png') }}" class="img-fluid w-100">
						<div id="animationProgress"></div>
					</section>
					<br>
					<br>
					
				</div>
			</div>
		</div>
	</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('static/js/jquery-1.11.3.min.js') }}"></script>
<script src="{{ asset('static/js/util.js') }}"></script>
<script src="{{ asset('static/js/index.js') }}"></script>
@endsection
@section('script')
<script>
	var progress = document.getElementById('animationProgress');
	var config = {
		type: 'line',
		data: {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October','November', 'December'],
			datasets: [{
				label: 'Unsuccesful',
				fill: false,
				borderColor: window.chartColors.red,
				backgroundColor: window.chartColors.red,
				data: [
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor()
				]
			}, {
				label: 'Successful',
				fill: false,
				borderColor: window.chartColors.blue,
				backgroundColor: window.chartColors.blue,
				data: [
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor(),
					randomScalingFactor()
				]
			}]
		},
		options: {
			title: {
				display: true,
				text: 'Appointments'
			},
			animation: {
				duration: 2000,
				onProgress: function(animation) {
					progress.value = animation.currentStep / animation.numSteps;
				},
				onComplete: function() {
					window.setTimeout(function() {
						progress.value = 0;
					}, 2000);
				}
			}
		}
	};
	window.onload = function() {
		var ctx = document.getElementById('canvas').getContext('2d');
		window.myLine = new Chart(ctx, config);
	};
	document.getElementById('randomizeData').addEventListener('click', function() {
		config.data.datasets.forEach(function(dataset) {
			dataset.data = dataset.data.map(function() {
				return randomScalingFactor();
			});
		});
		window.myLine.update();
	});
</script>
@endsection