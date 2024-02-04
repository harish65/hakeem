<ul class="left-side-bar mb-3">
   <div class="tab">
      <li class="tablinks"><a href="{{ route('user.AppointmentHistory')}}" style="color: black !important;">Appointment</a></li>
      <li class="tablinks {{ $tab=='profile'?'active':'' }}" onclick="openCity(event, 'profile_detail')" id="defaultOpen"> Profile Details</li>
      <li class="tablinks {{ $tab=='notification'?'active':'' }}" onclick="openCity(event, 'notification')" > Notification</li>
      <li id="btn_login" data-id="{{ Auth::user()->id }}"  class="tablinks" onclick="openCity(event, 'change_password')">Change Password</li>
      {{-- <li   class="tablinks" onclick="openCity(event, 'Tokyo1')">Update Category</li> --}}
      <li  data-id="{{ Auth::user()->id }}"  class="tablinks" onclick="openCity(event, 'cookie_policy')">Cookie Policy</li>
      <li  data-id="{{ Auth::user()->id }}"  class="tablinks" onclick="openCity(event, 'privacy_policy')">Privacy Policy</li>
   </div>
</ul>