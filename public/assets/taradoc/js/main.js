jQuery(window).scroll(function () {
    var scroll = jQuery(window).scrollTop();

    if (scroll >= 50) {
        jQuery(".top-header").addClass("header-fixed");
    } else {
        jQuery(".top-header").removeClass("header-fixed");
    }
	
	//$(window).on("load resize",(function(){var o=$("header");$("body").css("padding-top",o.outerHeight())}))
	
});

jQuery(document).ready(function(){

	jQuery(".user-icon").click(function () {
		jQuery(".user-option").slideToggle();
	});

	$('#query_post').on('submit', function(e){
	    e.preventDefault();
	    $("#btn_text_val").html('Posting...');
	    $("#query_post .main_error").html(''); 
	    var $this = $(this);
	    $.ajax({
	        type: "post",
	        url: base_url+'/query_post',
	        data: $this.serializeArray(),
	        dataType: "json",
	        success: function (response) {
	        $("#btn_text_val").html('Post a query');
	        	$('#email').val(''); 
	        	$('#phone_number').val(''); 
	        	$('#query_data').val(''); 
	        	Swal.fire('Query Posted!','Your Query has been posted','success');
	        },
	        error: function (jqXHR) {
	        $("#btn_text_val").html('Post a query');
	          var response = $.parseJSON(jqXHR.responseText);
	          if(response.message){
	        	Swal.fire('Error!',response.message,'error');
	          }
	        }
	    });
  });

        $('#send_link').on('click', function(e){
            // var input = $('#phone');
            e.preventDefault();
            let phone = $("#phone_number").val();
            if(!phone){
                Swal.fire('Error!','Phone number not valid','error');
                return false;
            }
            $("#send_link").html('<b>Please Wait...</b>');
            var $this = $(this);
            $.ajax({
                type: "post",
                url: base_url+'/send_link',
                data: {phone:'+91'+phone},
                dataType: "json",
                success: function (response) {
                    $('#phone_number').val('');
                    Swal.fire('Sent Link!','Link has been sent','success');
                    $("#send_link").html('<b>Submit</b>'); 
                },
                error: function (jqXHR) {
                $("#send_link").html('<b>Submit</b>');
                  var response = $.parseJSON(jqXHR.responseText);
                  if(response.errors){
                    if(response.errors.phone){
                      Swal.fire('Error!',response.errors.address[0],'error');
                    }
                  }else if(response.message){
                      Swal.fire('Error!',response.message,'error');
                  }
                }
            });
          });
    
    
	// Home Testimonials  
	jQuery('.testimonials').slick({
		infinite: true,
		arrows: true,
		speed: 300,
		dots: false,				  
		autoplay: false,
		autoplaySpeed: 5000,
		  slidesToShow: 2,
		  slidesToScroll: 1,
		  responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true
			  }
			},
			{
			  breakpoint: 767,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true
			  }
			}

			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		]
	});


	// date-carousel
	jQuery('.date-carousel').slick({
		infinite: true,
		arrows: true,
		speed: 300,
		dots: false,				  
		autoplay: false,
		autoplaySpeed: 5000,
		  slidesToShow: 5,
		  slidesToScroll: 1,
		  responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 5,
				slidesToScroll: 1,
				infinite: true
			  }
			},
			{
			  breakpoint: 767,
			  settings: {
				slidesToShow: 4,
				slidesToScroll: 1,
				infinite: true
			  }
			}

			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		]
	});
	
	
	var input = document.querySelector("#country");
	window.intlTelInput(input, {
		utilsScript: "js/utils.js",
	});
});

$(function () {
	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }); 
	$('input[name="month"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'), 10)
	}, function (start, end, label) {
		var years = moment().diff(start, 'years');
	});
});

$(function () {
	$('input[name="appointment"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'), 10)
	}, function (start, end, label) {
		var years = moment().diff(start, 'years');
	});
});


$(function () {
	$('input[name="dob"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'), 10)
	}, function (start, end, label) {
		var years = moment().diff(start, 'years');
	});
});

$(function () {
	$('input[name="working-date"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'), 10)
	}, function (start, end, label) {
		var years = moment().diff(start, 'years');
	});
});