@extends('vendor.iedu.layouts.index', ['title' => 'About Us', 'show_footer'=>true])
@section('content')

<!-- Bannar Section -->
<section class="about-main">
    <img src="{{ asset('assets/iedu/images/about-bnr.png')}}" alt="">
    <h3>About Us</h3>
</section>
<section class="about-inner">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <p>Learning… a long journey that started with engraving on stones, then paper, pens and ink to be through screens by one touch. </p>
                <p>Since that knowledge is boundless like a shining sun whose rays reach the farthest darkening point, we get to students in their homes to learn according to the circumstances of their lives and times without pressure so the light of science shines in every place and time. </p>
                <p>I-Edu opens the doors for trainers, professors, teachers, training centers, celebrities, craftsmen, or even entrepreneurs from different fields and specializations to be part of our family and to teach, inspire, and enlighten the lives of people all over the world. </p>
                <p>You are free to choose the subject of lessons, courses, location of filming, prices and even the number of students to spread wings of creativity and to go off in the wide horizon. We will be your success partners in all you want to communicate to the audience through I-Edu website and application for direct learning. </p>
                <p>Join us on our journey to e-learning instead of traditional learning with a group of elite and inspiring teachers from around the world. </p>
                <p>Let’s start the story together and proceed with an ambitions journey to the future. </p>
                <p>I-Edu</p>
                <p>The knowledge you love. </p>
                <p>For more information: </p>
                <div class="about-social">
                    <p><i class="fa fa-phone" aria-hidden="true"></i></p>
                    <p><i class="fa fa-envelope" aria-hidden="true"></i></p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="about-img">
                    <img src="{{ asset('assets/iedu/images/about-in-1.png')}}" alt="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="about-img">
                    <img src="{{ asset('assets/iedu/images/about-in-2.png')}}" alt="">
                </div>
            </div>
            <div class="col-md-7">
                <p>التعليم.. رحلة طويلة بدأت بالنقش على الحجر.. ثم الورقة والقلم والحبر.. لتصل إلى التعلم خلف الشاشة بلمسة واحده </p>
                <p>و لأن المعرفة لا حدود لها ، كشمس شارقة تصل لأبعد نقطة معتمه </p>
                <p>نصل إلى طلاب العلم في منازلهم، ليتعلموا حسب ظروف حياتهم ووقتهم دون ضغوط، ليسطع نور العلم في كل مكان وزمان. </p>
                <p>يفتح الباب أمامكم سواء كنتم مدربين، أو أساتذة، معلمين، مراكز تدريبية، مشاهير، حرفيين، أو حتى أصحاب أعمال من مختلف المجالات والتخصصات لتكونوا جزءًا من عائلته.. لتعلموا.. وتلهموا.. وتنيروا حياة البشر في جميع أنحاء العالم. I-Edu</p>
                <p>تركنا لكم حرية اختيار موضوع الدروس والدورات ومكان التصوير والأسعار وحتى عدد الطلاب، لتفردوا أجنحة الإبداع وتنطلقوا في الأفق، سنكون شركاءكم في النجاح لكل ماتريدون إيصاله للجمهور عن طريق موقع وتطبيق </p>
                <p>I-Edu </p>
                <p>للتعليم المباشر.</p>
                <p>انضموا إلينا في مركب التحول من التعليم التقليدي إلى التعليم الإلكتروني، مع مجموعة من نخبة المعلمين والملهمين حول العالم. </p>
                <p>لنبدا القصة معًأ ونمضي في رحلة طموحة للمستقبل </p>
                <p>I-Edu</p>
            </div>
        </div>
        <!-- <h2>Loreum Ipsum is a dummy text</h2>
        <h5>Loreum Ipsum</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque mattis luctus dictum. Praesent porttitor ullamcorper odio, in finibus sem tempor nec. Ut in ligula eros. Proin venenatis feugiat tortor, et gravida justo tincidunt vitae. Aliquam faucibus a purus sit amet scelerisque. Nam in elit turpis. Nullam ut malesuada felis, sed ornare tortor. In felis magna, fringilla mollis eros non, imperdiet rutrum augue. Donec porttitor nisl sit amet orci bibendum, non tincidunt augue pharetra. Vestibulum quis neque condimentum, porta lorem nec, dictum libero. Curabitur at dolor mattis, posuere sapien.</p>
        <h5>Phasellus et nunc in dolor gravida vestibulum</h5>
        <p>Suspendisse rhoncus libero in fermentum posuere. Aliquam vitae nunc ultrices, tempor diam id, efficitur metus. Nam viverra, metus porttitor porta elementum, libero tortor aliquet ligula, id vulputate dolor nisl ac arcu. Nam in nibh nec urna efficitur imperdiet. Duis eu pellentesque purus, quis ultricies risus. Ut in neque viverra, ullamcorper mi pulvinar, rutrum nunc. Pellentesque vitae mi placerat, lobortis eros quis, aliquet mauris. Mauris volutpat orci augue, vel gravida ante fermentum ac. Suspendisse orci lacus, sollicitudin in lacus vel, iaculis maximus ex. Integer in suscipit est. Pellentesque vel massa vel augue semper posuere quis id nunc. Curabitur posuere ultrices orci ut hendrerit. Sed convallis suscipit quam in aliquam.</p>

        <p>Phasellus aliquam orci et tincidunt viverra. Sed sit amet purus vel risus dictum tincidunt at in nisl. Integer eu commodo nibh. Sed ut nulla tincidunt mi sodales ullamcorper vel eu enim. Etiam pharetra leo tincidunt euismod accumsan. Aenean justo lorem, blandit quis est nec, aliquet vestibulum ante. </p>
        <div class="row">
            <div class="col-md-5">
                <div class="about-img">
                    <img src="{{ asset('assets/iedu/images/about-in-1.png')}}" alt="">
                </div>
            </div>
            <div class="col-md-7">
                <div class="about-text pl-3">
                    <h5>Our Vision</h5>
                    <p>Eget lacinia nunc lacinia. Proin non nisl tristique, pulvinar arcu a, interdum mi. Suspendisse eu nisl vel turpis scelerisque tempus. Aliquam odio mauris, tincidunt in lorem eget, ornare venenatis massa. Cras in consectetur magna, eget sollicitudin mauris.</p>
                    <p>Eget lacinia nunc lacinia. Proin non nisl tristique, pulvinar arcu a, interdum mi. Suspendisse eu nisl vel turpis scelerisque tempus. Aliquam odio mauris, tincidunt in lorem eget, ornare venenatis massa. Cras in consectetur magna, eget sollicitudin mauris.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="about-text pr-3">
                    <h5>Our Vision</h5>
                    <p>Eget lacinia nunc lacinia. Proin non nisl tristique, pulvinar arcu a, interdum mi. Suspendisse eu nisl vel turpis scelerisque tempus. Aliquam odio mauris, tincidunt in lorem eget, ornare venenatis massa. Cras in consectetur magna, eget sollicitudin mauris.</p>
                    <p>Eget lacinia nunc lacinia. Proin non nisl tristique, pulvinar arcu a, interdum mi. Suspendisse eu nisl vel turpis scelerisque tempus. Aliquam odio mauris, tincidunt in lorem eget, ornare venenatis massa. Cras in consectetur magna, eget sollicitudin mauris.</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="about-img">
                    <img src="{{ asset('assets/iedu/images/about-in-2.png')}}" alt="">
                </div>
            </div>
        </div>
        <h5 class="pt-3">Morbi venenatis risus eu suscipit ullamcorper</h5>
        <p>Phasellus tempus egestas ultricies. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla auctor tellus sed orci tempus iaculis. Etiam facilisis felis sit amet ipsum maximus euismod. Aliquam non cursus arcu. Morbi venenatis risus eu suscipit ullamcorper. Donec pretium ullamcorper mi, vitae tempus orci tincidunt id. In facilisis suscipit mi at consequat. Duis mauris enim, feugiat placerat semper eget, ultrices ut nibh. Cras gravida tristique risus a pharetra. Quisque id diam sed lacus scelerisque interdum. Phasellus nec bibendum neque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam sit amet varius massa, nec eleifend orci. Ut quis nunc id metus viverra blandit. Suspendisse vestibulum eleifend velit, egestas volutpat est interdum ultrices.</p> -->
    </div>
</section>

<!-- <div class="cursor"></div> -->



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->


@endsection
