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


	$('input[name="month"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'), 10)
	}, function (start, end, label) {
		var years = moment().diff(start, 'years');
	});



	$('input[name="appointment"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'), 10)
	}, function (start, end, label) {
		var years = moment().diff(start, 'years');
	});




	$('input[name="dob"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'), 10),
		locale: {
		  "format": "YYYY-MM-DD",
		  "separator": "-",
		}
	  }, function (start, end, label) {
		var years = moment().diff(start, 'years');  
	  });



	$('input[name="working_since"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'), 10),
		locale: {
			"format": "YYYY-MM-DD",
			"separator": "-",
		},		

	}, function (start, end, label) {
		var years = moment().diff(start, 'years');
	});



	$('input[name="working-date"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1901,
		maxYear: parseInt(moment().format('YYYY'), 10)
	}, function (start, end, label) {
		var years = moment().diff(start, 'years');
	});


$('input[name="date"]').daterangepicker({
	singleDatePicker: true,
	showDropdowns: true,
	minYear: 1901,
	maxYear: parseInt(moment().format('YYYY'), 10)
}, function (start, end, label) {
	var years = moment().diff(start, 'years');
});