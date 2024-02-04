@extends('vendor.hexalud.layouts.dashboard', ['title' => 'Doctor'])
@section('content')

  <!-- Offset Top -->
  <div class="offset-top"></div>

<!-- Revenue Section -->
<section class="revenue-content py-lg-5 mb-lg-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="bg-them mb-6">
                    <h4 class="border-bottom p-3 mb-2">Menu</h4>
                    <ul class="doctor-list pb-2">
                    <li><a href="{{url('user/doctor')}}"><i class="fas fa-calendar-week"></i> Appointments</a></li>
                            <li  class="active"><a href="{{url('service_provider/revenue')}}"><i class="fas fa-signal"></i>Revenue</a></li>
                            <li><a href="{{url('service_provider/prescription')}}"><i class="far fa-list-alt"></i>Prescription</a></li>
                    </ul>
                </div>
                <!-- <div class="bg-them">
                    <h4 class="border-bottom p-3 d-flex align-items-center justify-content-between"><span>Recent
                            Chats</span> <a class="txt-14 text-blue" href="#"> <b>View all</b></a></h4>

                    <ul class="recent-chat-list py-4">
                        <li class="">
                            <a href="">
                                <ul class="d-flex align-items-center justify-content-start px-3">
                                    <li class="chat-icon"><img src="images/ic_profile-header@2x.png" alt=""></li>
                                    <li class="chat-text">
                                        <h6 class="m-0 d-flex align-items-center justify-content-between"><label>
                                                Stella</label> <span class="online-time">1h</span></h6>
                                        <div class="pr-4 position-relative">
                                            <p class="m-0 ellipsis">But recently started facing som.............</p>
                                            <span class="msg-no position-absolute">2</span>
                                        </div>
                                    </li>
                                </ul>
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <ul class="d-flex align-items-center justify-content-start px-3">
                                    <li class="chat-icon"><img src="images/ic_profile-header@2x.png" alt=""></li>
                                    <li class="chat-text">
                                        <h6 class="m-0 d-flex align-items-center justify-content-between">
                                            <label>Gibby Radki</label> <span class="online-time">1h</span>
                                        </h6>
                                        <label class="status-txt d-block">Sure, No Problem</label>
                                    </li>
                                </ul>
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <ul class="d-flex align-items-center justify-content-start px-3">
                                    <li class="chat-icon"><img src="images/ic_profile-header@2x.png" alt=""></li>
                                    <li class="chat-text">
                                        <h6 class="m-0 d-flex align-items-center justify-content-between">
                                            <label>Jessica Stone</label> <span class="online-time">1h</span>
                                        </h6>
                                        <label class="status-txt d-block">Sure, No Problem</label>
                                    </li>
                                </ul>
                            </a>
                        </li>

                        <li>
                            <a href="">
                                <ul class="d-flex align-items-center justify-content-start px-3">
                                    <li class="chat-icon"><img src="images/ic_profile-header@2x.png" alt=""></li>
                                    <li class="chat-text">
                                        <h6 class="m-0 d-flex align-items-center justify-content-between">
                                            <label>Raheem Sterling</label> <span class="online-time">1h</span>
                                        </h6>
                                        <label class="status-txt d-block">Sure, No Problem</label>
                                    </li>
                                </ul>
                            </a>
                        </li>
                    </ul>


                </div> -->
            </div>
            <div class="col-lg-8">
                <div class="row align-items-center mb-4 pb-2">
                    <div class="col-sm-6">
                        <h3 class="appoitment-title">Revenue</h3>
                    </div>
                </div>

                <div class="row">
                    @if( $requests_data['services'])
                    @foreach($requests_data['services'] as $service)
                    <div class="col-sm-6">
                        <div class="revenue-box revenue-left d-flex align-items-center justify-content-between" style='margin-top: 15px; background-color: {{ $service["color_code"] }};'>
                            <div class="reven-left" style='background-color:".{{ $service["color_code"]}}'>
                                <div class="txt-16 mb-2">Total {{ $service['service_name']}}</div>
                                <h4 class="text-white">{{ $service['count']}}</h4>
                            </div>
                            <div class="revene-right">
                                <img src="{{asset('assetss/images/ic_chat_1234.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="revenue-bg p-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="m-0">Appointments</h6>
                                    <div class="txt-32">{{$requests_data['totalRequest']}}</div>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <!-- <a href="#"><img src="{{asset('assetss/images/ic_cal_234567.png')}}" alt=""></a> -->
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <ul class="apooint-status d-flex align-items-center justify-content-between">
                                        <li>
                                            <label class="d-block txt-14">Completed</label>
                                            <span class="d-block txt-24">{{$requests_data['completedRequest']}}</span>
                                        </li>
                                        <li>
                                            <label class="d-block txt-14">Unsuccessful</label>
                                            <span class="d-block txt-24">{{$requests_data['unSuccesfullRequest']}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-them mt-4 p-4">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <div class="txt-16 txt-color">Revenue</div>
                            <div class="txt-32">₹ {{  $requests_data['totalRevenue'] }}</div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <!-- <select class="form-control year-select pl-4 ml-auto" name="" id="">
                                <option value="">2019</option>
                                <option value="">2020</option>
                                <option value="">2021</option>
                            </select> -->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col py-4">
                            <!-- <img class="img-fluid" src="{{asset('assetss/images/graph-img.jpg')}}" alt=""> -->
                            <canvas id="myChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

    </section>
    <script>
        var _token = "{{ csrf_token() }}";


    </script>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        labels: [
            @foreach($requests_data['monthlyRevenue'] as $data_item)
                '{{ $data_item["monthName"] }}',
            @endforeach
        ],
        datasets: [{
            label: 'Revenue',
            data: [
                @foreach($requests_data['monthlyRevenue'] as $data_item)
                    '{{ $data_item["revenue"] }}',
                @endforeach
            ],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        fill: true,
        plugins: {
            filler: {
                propagate: false,
            },
            title: {
                display: false,
                text: (ctx) => 'Fill: ' + ctx.chart.data.datasets[0].fill
            }
        },
        interaction: {
            intersect: false,
        }
    }
});


</script>



@endsection
