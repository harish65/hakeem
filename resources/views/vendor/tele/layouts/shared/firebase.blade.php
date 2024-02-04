<!-- firebase integration started -->

    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
    <!-- Firebase App is always required and must be first -->
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-app.js"></script>

    <!-- Add additional services that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-functions.js"></script>

    <!-- firebase integration end -->

    <!-- Comment out (or don't include) services that you don't want to use -->
    <!-- <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase-storage.js"></script> -->

    <script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-analytics.js"></script>
    {{--  firbasekey=AAAAJ8gszY4:APA91bEyU_fZQpGyj04N3nLl5q8NpILB0Q2mBKJUDiu3L1ZSmE2WoaETeTyLDgMzYgrztQfhK_14V3GEGK1guX3jfas6IyKWaUPjc5kX3-g2PHRMfSPe7kMrqOJ2OJ1DxM_WpG_eiXL8  --}}
    <!-- Firebase integration End-->
    <script type="text/javascript">
    // Your web app's Firebase configuration
    {{--  const firebaseConfig = {
        apiKey: "AIzaSyBzY9-1VASmAuaJIWdVCLv434BaIn9LGdE",
        authDomain: "mydoctor-b75b0.firebaseapp.com",
        databaseURL: "https://mydoctor-b75b0.firebaseio.com",
        projectId: "mydoctor-b75b0",
        storageBucket: "mydoctor-b75b0.appspot.com",
        messagingSenderId: "960044561911",
        appId: "1:960044561911:web:ec25cc8b988def0876eaf2",
        measurementId: "G-91PRWR1KEY"
    };  --}}
    {{--  const firebaseConfig = {
        apiKey: "AIzaSyDOvO0sYgYAUpdWBMowalz-bWdQolqqPhQ",
        authDomain: "telegreen-expert.firebaseapp.com",
        projectId: "telegreen-expert",
        storageBucket: "telegreen-expert.appspot.com",
        messagingSenderId: "228366500806",
        appId: "1:228366500806:web:d356df19bf765c1d84a8c7",
        measurementId: "G-SX0JT44LBP"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    //firebase.analytics();
    const messaging = firebase.messaging();
        messaging
    .requestPermission()
    .then(function () {
    //MsgElem.innerHTML = "Notification permission granted."
        console.log("Notification permission granted.");

         // get the token in the form of promise
        return messaging.getToken()
    })
    .then(function(token) {
     // print the token on the HTML page
      console.log(token);
      $.ajax({
            type: "get",
            dataType: "json",
            url: base_url + '/update/device/token',
            data: {
                device_token : token
            },
            success: function (response) {
                console.log(response.message);
            }
        });



    })
    .catch(function (err) {
        console.log("Unable to get permission to notify.", err);
    });

    messaging.onMessage(function(payload) {
        console.log(payload);
        var notify;
        if(payload.notification && payload.notification.title){
            notify = new Notification(payload.notification.title,{
            body: payload.notification.body
        });
        } else {
            notify = new Notification(payload.data.title,{
            body: payload.data.body
        });
        }

        var current_url = window.location.href;
        $.ajax({
            type: "get",
            dataType: "json",
            url: "{{route('get_notification_data')}}",
            data: {
                'current_url' : current_url
            },
            success: function (response) {
                console.log(response);
                var myClass = $('#user_notification_count').attr("class").split(' ')[0];
                $('#ringing_bell_icon').html(`<img src="{{asset('assetss/images/bell.gif')}}" alt="" style="height:40px;">`);
                if(myClass != 'notify-no')
                {
                    $('#user_notification_count').addClass('notify-no');
                }
                $('#user_notification_count').html(response.notification_count);
                if(response.same_page)
                {
                    $('#all_notification_html').html(response.all_notification_html);
                }
                $('#notifications').html(response.notifiaction_html);
                setTimeout( function(){
                   $('#ringing_bell_icon').html('<i class="far fa-bell" style="font-size: 24px;"></i>');
                  }  , 5000 );
            }
        });

        console.log(payload.notification);
    });

        //firebase.initializeApp(config);
    var database = firebase.database().ref().child("/users/");

    database.on('value', function(snapshot) {
        renderUI(snapshot.val());
    });

    // On child added to db
    database.on('child_added', function(data) {
        console.log("Comming");
        if(Notification.permission!=='default'){
            var notify;

            notify= new Notification('CodeWife - '+data.val().username,{
                'body': data.val().message,
                'icon': 'bell.png',
                'tag': data.getKey()
            });
            notify.onclick = function(){
                alert(this.tag);
            }
        }else{
            alert('Please allow the notification first');
        }
    });

    self.addEventListener('notificationclick', function(event) {
        event.notification.close();
    });
  --}}




</script>
