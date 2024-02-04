
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.3/vue.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <script src="{{ asset('assets/mp2r/js/intlTelInput.js')}}"></script>
    <script src="{{ asset('assets/mp2r/js/moment.min.js')}}"></script>
    <script src="{{ asset('assets/mp2r/js/main.js')}}"></script>
    @if(Auth::Check())
        <!-- <script src="{{ asset('assets/mp2r/js/customSendBird.js')}}"></script> -->
    @endif

        <script src="{{ asset('assets/mp2r/js/slick.js')}}"></script>

    @yield('script')
    <script>
        $('.carousel').carousel({
            pause: "false",
           
        });
    </script>

    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            utilsScript: "{{ asset('assets/mp2r/js/utils.js')}}",
        });
        // $('.dropdown-menu > li >a:not(a[href="#"])').on('click', function() {
        //         self.location = $(this).attr('href');
        // });
    </script>

    <script>
        $('.testimonials-slides').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            dots: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1024: {
                    items: 1
                }
            }
        });
        $(".toggle-password").click(function() {
              $(this).toggleClass("fa-eye fa-eye-slash");
              var input = $($(this).attr("toggle"));
              if (input.attr("type") == "password") {
                input.attr("type", "text");
              } else {
                input.attr("type", "password");
              }
            });
    </script>
    <script type="text/javascript">
        $(window).on("load resize",(function(){var o=$(".navigation-wrap");$("body").css("padding-top",o.outerHeight())}))
        </script>
    <style type="text/css">
        footer h3{
            text-align: center;
        }

        ul.footer_links{
            text-align: center;
        }
        .videoSection .o-video>iframe{
            z-index: 999;
        }
        .inputDiv input{
            width: 100%;
        }
        .carousel-item img {
            height: 650px;
            object-fit: contain;
            object-position: right;
        }

        .carousel-inner .carousel-item:nth-child(5).active::before {
            background-image: linear-gradient(to right, rgba(0, 0, 0, 1) 67%, transparent 85%);
        }

        @media only screen and (max-width: 576px) {
            .carousel-item img {
                height: 550px;
                object-fit: fill;
            }
            .carousel-inner .carousel-item:nth-child(5).active::before {
                background-image: none;
                background: rgba(0, 0, 0, 0.4);
            }
        }
    </style>
    <script>
        var slider = $(".day-slider");
        var scrollCount = null;
        var scroll= null;
        slider.slick({
              dots: false,
              infinite: false,
              // outline:'none';
              speed: 500,
              slidesToShow: 3,
              slidesToScroll: 1,
              responsive: [
                {
                  breakpoint: 990,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
              ]
            });
        slider.on('wheel', (function(e) {
            e.preventDefault();
            clearTimeout(scroll);
            scroll = setTimeout(function(){scrollCount=0;}, 200);
            if(scrollCount) return 0;
            scrollCount=1;
            if (e.originalEvent.deltaY < 0) {
                $(this).slick('slickNext');
                console.log('this',$(this));
            } else {
                console.log('this',$(this));
                $(this).slick('slickPrev');
            }
        }));
    slider.on('afterChange', function() {
        var dataId = $('.slick-current').attr("data-slick-index");
        $('.slick-current').trigger('click');    
    });
</script>

<script>
        var slider = $(".day-slider1");
        var scrollCount = null;
        var scroll= null;
        slider.slick({
              dots: false,
              infinite: true,
              speed: 500,
              slidesToShow: 3,
              slidesToScroll: 1,
              responsive: [
                {
                  breakpoint: 990,
                  settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
              ]
            });
        slider.on('wheel', (function(e) {
            e.preventDefault();
            clearTimeout(scroll);
            scroll = setTimeout(function(){scrollCount=0;}, 200);
            if(scrollCount) return 0;
            scrollCount=1;
            if (e.originalEvent.deltaY < 0) {
                $(this).slick('slickNext');
                console.log('this',$(this));
            } else {
                console.log('this',$(this));
                $(this).slick('slickPrev');
            }
        }));
    slider.on('afterChange', function() {
        var dataId = $('.slick-current').attr("data-slick-index");
        $('.slick-current').trigger('click');    
    });


    
</script>