    @include('includes/header')
    @include('includes/boardheader')
    <title>ChessMate</title>
    <link href="{{asset('css/home.css')}}" rel="stylesheet">
    <script src="{{asset('js/gameRandom.js')}}" type="module"></script>
</head>
<body>
    @include('includes/navbar')
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="mainbody">
        <!--Slide 1-->
        <div class="container-fluid container1">
            <div class="row">
                <div class="col-md-6" style="padding-top: 100px;">
                    <h1 style="color:black; font-weight: bold;font-size: xxx-large;"> ChessMate </h1>
                    <br/>
                    <div class="para" style="font-size: 20px;">
                        <p>A brand new, free and friendly website </p>
                        <p>designed for learning and practicing <strong style="color: black;">Chess.</strong> </p>
                    </div>
                    <div class="btn-play d-flex">
                        <button type="button" class="btn btn-success" onclick="login()" style="font-size: xx-large;margin: 100px;background-color: aliceblue;border-radius: 50px;border-style:hidden;">
                        <i class="fas fa-gamepad" style="text-decoration: none;"> <i class="custom-link" style="text-decoration: none; color:black;font-style: italic;">Play now!</i></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-5">
                    <!-- BAN CO REAL-->
                    <div class="img-chess" id="myBoard" style="width: 470px; margin: 0 auto;"></div>
                </div>
            </div>
        </div>    
        <!--Slide 2-->
        <div class="container-fluid container2">
            <div class="row">
                <div class="col-md-6 pd-10">
                    <h1 style="color:black; font-weight: bold;font-size: xxx-large;"> About us </h1>
                    <br/>
                    <div class="paragraph" style="font-size: 20px;">
                    <p style="font-style: italic;">“<strong>Chess</strong> is hard”.</p>
                    <p class="paragraph1">
                        While many see Chess as an elegant and intellectual game, involving mind-blowing tactics and countless hours mastering how to move 16 pieces, there's a deeper layer waiting to be explored. 
                        Beyond the board, emotions come alive <strong style="font-style: italic;"> glory, relief, anxiety, victory </strong>- as dedicated players immerse themselves in this timeless pursuit. It's those feelings that makes Chess so attractive.
                    </p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="img-chess">
                        <img src="{{asset('img/7.png')}}" class="d-block w-100" alt="Hình ảnh minh họa">
                    </div>
                </div>
            </div>
        </div>
        <!--Slide 3-->
        <div class="container-fluid container3">
            <div class ="para1">
                <h1 style="color:black; font-weight: bold;font-size: xxx-large;padding-bottom: 30px;margin-left: 100px;"> More things </h1>
                <p id ="animated-text">
                    <p class="text-center" >
                    A group of undergraduates has built this website so that everyone can enjoy playing Chess and learning new stuff without any anxiety.
                    </p>
                    <p class="text-center" >
                        Friendly, interactive and easy to use website is our ultimate goal.
                    </p>
                    <p class="text-center">
                        Since this is just a school project and we only use free hosting for 1 year, you may or may not be able to access this website in the future. 
                    </p>
                    <p class="text-center">
                    However, if this project worth developing, users can contact us anytime and we will try our best to make things work.
                    </p>
                </p>
            </div>
        </div>
        <!--Slide 4-->
        <div class="bd-example m-0 border-0">
            <div id="Interval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="5000">
                        <img src="{{asset('img/1.jpg')}}" class="d-block w-100" alt="Hình ảnh minh họa">
                    </div>
    
                    <div class="carousel-item " data-bs-interval="5000">
                        <img src="{{asset('img/2.jpg')}}" class="d-block w-100" alt="Hình ảnh minh họa">
                    </div>
                    
                    <div class="carousel-item " data-bs-interval="5000">
                        <img src="{{asset('img/3.jpg')}}" class="d-block w-100" alt="Hình ảnh minh họa">
                    </div>
    
                    <div class="carousel-item " data-bs-interval="5000">
                        <img src="{{asset('img/4.jpg')}}" class="d-block w-100" alt="Hình ảnh minh họa">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#Interval" data-bs-slide="prev">
                    <span class="visually-hidden">Prev</span>
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#Interval" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>    
            </div>
        </div>
</body>
<footer>
    @include('includes/footer')
</footer>
</html>
<script>
    // Srcipt Navbar
    // Brandtext
    document.addEventListener('DOMContentLoaded',function AppearOnce()
    {
        const brandtext = "ChessMate";
        const brandElement = document.getElementById('brand-text');
        function type(index)
        {
            brandElement.textContent=brandtext.slice(0,index);
            if (index <= brandtext.length)
            setTimeout(() => type(index+1),500);
            else
                {
                    setTimeout(() =>
                        {
                            document.removeEventListener('DOMContentLoaded',AppearOnce);
                            brandElement.textContent = brandtext;
                        },1000);
                }
        }
        type(0);
    });
    // Hambuger
    document.addEventListener('DOMContentLoaded', function () {
        const hamburgerIcon = document.querySelector('.hamburger');
        const navLink = document.querySelector('.nav-link');
        const navItems = document.querySelectorAll('.nav-link li a');
        const loginBtn = document.querySelector('.login-btn');

        hamburgerIcon.addEventListener('click', function () {
            navLink.classList.toggle('show');
            if (navLink.classList.contains('show')) {
                navItems.forEach(item => item.style.display = 'block');
                loginBtn.style.display = 'block';
            } else {
                navItems.forEach(item => item.style.display = 'none');
                loginBtn.style.display = 'none';
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 1000) {
                navItems.forEach(item => item.style.display = 'block');
                loginBtn.style.display = 'block';
            } else {
                navItems.forEach(item => item.style.display = 'none');
                loginBtn.style.display = 'none';
            }
        });
    });
 </script>