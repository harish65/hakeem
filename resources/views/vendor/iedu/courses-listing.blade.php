@extends('vendor.iedu.layouts.index', ['title' => 'Courses','show_footer'=>true])
@section('content')
<section class="most-pupular header-height">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- <div class="filter-bar">
          <span>Filter By :</span>
          <select class="">
            <option>Course</option>
            <option>Course</option>
          </select>
          <select class="">
            <option>Class</option>
            <option>Class</option>
          </select>
        </div> -->
      </div>
      <div class="col-md-12">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#flamingo" role="tab" aria-controls="pills-flamingo" aria-selected="true">Most Popular</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#cuckoo" role="tab" aria-controls="pills-cuckoo" aria-selected="false">Faculty of Communication</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#ostrich" role="tab" aria-controls="pills-ostrich" aria-selected="false">Faculty of Law</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#tropicbird" role="tab" aria-controls="pills-tropicbird" aria-selected="false">Faculty of Engineering</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#tropicbird1" role="tab" aria-controls="pills-tropicbird" aria-selected="false">Faculty of Management</a>
          </li>
        </ul>
        <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="flamingo" role="tabpanel" aria-labelledby="flamingo-tab">
          <h4 class="mb-4 mt-4">Most Popular</h4>
          <div class="row">
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-1.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="cuckoo" role="tabpanel" aria-labelledby="profile-tab">
          <h4 class="mb-4 mt-4">Most Popular</h4>
          <div class="row">
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-1.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-3.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-2.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-3.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-1.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-2.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="ostrich" role="tabpanel" aria-labelledby="ostrich-tab">
          <h4 class="mb-4 mt-4">Most Popular</h4>
          <div class="row">
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-1.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-3.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-2.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-3.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-1.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-2.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="tropicbird" role="tabpanel" aria-labelledby="tropicbird-tab">
          <h4 class="mb-4 mt-4">Most Popular</h4>
          <div class="row">
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-1.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-3.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-2.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-3.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-1.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-2.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="tropicbird1" role="tabpanel" aria-labelledby="tropicbird-tab">
          <h4 class="mb-4 mt-4">Most Popular</h4>
          <div class="row">
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-1.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-3.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-2.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-3.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-1.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="popular-block">
                <div class="image-block">
                  <img src="images/courses-list-2.png">
                </div>
                <div class="p-4">
                  <h5>Social Learning</h5>
                  <p>Robert Crusine</p>
                  <div class="row d-flex align-items-center">
                    <div class="col-6">
                      <h6 class="">13 Courses </h6>
                    </div>
                    <div class="col-6">
                      <button class="btn d-inline-block float-right"><span>Choose</span></button>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>        
      </div>
    </div>
  </div>
</section>
@endsection