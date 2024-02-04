@if(isset($doctors))
                        @foreach($doctors as $doctor)
                        <div class="doctor_box  mb-4">
                            <div class="row align-items-center">
                                <div class="col-lg-7 mb-3">
                                    <ul class="d-flex m-auto align-items-center justify-content-start">
                                        <li class="doctor_pic">
                                        <img src="{{Storage::disk('spaces')->url('uploads/'.$doctor['doctordetail']->profile_image)}}" alt="">
                                        </li>
                                        <li class="doctor_detail pl-3">
                                        <h4>@if($doctor['doctordetail']){{$doctor['doctordetail']->name}} @endif</h4>
                                        <p>@if($doctor['categoryData']){{$doctor['categoryData']->name}} @endif </p>
                                        <span class="rating vertical-middle">
                                            <img src="{{asset('assetss/images/ic_Starx18.svg')}}" alt="">
                                            <a class="review_txt" href="#"><i class="fas fa-star"></i> {{$doctor['rating']}} · {{$doctor['reviewcount']}} Reviews</a>
                                            <a class="view_profile d-block mt-2" href="#">View Profile</a>
                                        </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-5">
                                    @if($doctor['getServices'])
                                        @foreach($doctor['getServices'] as $key=>$servicetype)

                                    <div class="btn_group d-flex align-items-center justify-content-between text-16">


                                        <a class="chat_btn" style="background-color:red" href="javascript:void(0)" data-toggle="modal" data-target="#booking">
                                            <label class="d-block m-0">{{$key}}</label>
                                            <span>{{}} / min</span>
                                        </a>

                                    </div>

                                        @endforeach
                                       @endif

                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif


                    <div class="row mt-5 pt-lg-4">
                        <div class="col text-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                  <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                      <span aria-hidden="true">&laquo;</span>
                                    </a>
                                  </li>
                                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                                  <li class="page-item"><a class="page-link" href="#">5</a></li>
                                  <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                      <span aria-hidden="true">&raquo;</span>
                                    </a>
                                  </li>
                                </ul>
                              </nav>
                              <p class="text-14 mt-3">1 - 4 of 20 Results</p>
                        </div>
                    </div>
