
<!-- bundle -->
<!-- Vendor js -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>
@yield('script')
<!-- App js -->
<script src="{{asset('assets/js/app.min.js')}}"></script>
@if(config('client_connected') && (config::get("client_data")->domain_name=="mp2r"||config::get("client_data")->domain_name=="food"))
<div id="sb_widget"></div>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{asset('assets/js/widget.SendBird.js')}}"></script>
<script>
  	// var sb = sbWidget.start('B13514F8-4AB5-4ABA-87D6-C3904DA10C96');
	var appId = 'B13514F8-4AB5-4ABA-87D6-C3904DA10C96';
	var userId = '1';
	var nickname = 'Admin';
	sbWidget.startWithConnect(appId, userId, nickname, function() {
	  // do something...
	});

</script>
@endif
@if(config('client_connected') && (config::get("client_data")->domain_name=="elconsultation"))
<script type="text/javascript">
   function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
  }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
@endif
@yield('script-bottom')
