@if(!isset($sign_page))
   <!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <a href=""><img src="{{ asset('assets/heal/images/ic_logo.png') }}"></a>
        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting.</p>
      </div>
      <div class="col-md-3">
        <h4 class="mb-4">Links</h4>
        <div class="mb-2"><a href="">About Us</a></div>
        <div class="mb-2"><a href="">Blogs</a></div>
        <div class="mb-2"><a href="">Terms & conditions</a></div>
        <div class="mb-2"><a href="">Privacy policy</a></div>
        <div class="mb-2"><a href="">Contact Us</a></div>
        <div class="mb-2"><a href="">Become a professional</a></div>
        <div class="mb-2"><a href="">Cookies Policy</a></div>
      </div>
      <div class="col-md-5">
        <div class="row">
          <div class="col-md-6">
            <h4 class="mb-4">Links</h4>
            <div class="mb-2"><a href="">Specialists</a></div>
            <div class="mb-2"><a href="">Therapists</a></div>
            <div class="mb-2"><a href="">Super Specialists</a></div>
            <div class="mb-2"><a href="">Homopathic</a></div>
          </div>
          <div class="col-md-6">
            <h4 class="mb-4">Social</h4>
            <div class="mb-2"><a href=""><img class="mr-3" src="{{ asset('assets/heal/images/ic_facebbok.png') }}">Facebook</a></div>
            <div class="mb-2"><a href=""><img class="mr-3" src="{{ asset('assets/heal/images/ic_insta.png') }}">Instagram</a></div>
            <div class="mb-2"><a href=""><img class="mr-3" src="{{ asset('assets/heal/images/ic_twitter.png') }}">Twitter</a></div>
          </div>
        </div>
        <div class="text-center mt-5">
          <a class="mr-4" href=""><img src="{{ asset('assets/heal/images/ic_google_play.png') }}"></a>
          <a class="mr-4" href=""><img src="{{ asset('assets/heal/images/ic_app_store.png') }}"></a>
        </div>
      </div>
    </div>
  </div>
</footer>
<hr>
<p class="text-center copyright">All Rights Reserved to Megsult 2020</p>
@else
    
@endif