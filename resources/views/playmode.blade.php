    @include('includes.header')
    <title>Choose playmode</title>
    <link href="{{asset('css/playmode.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    @include('includes.navbar')
    <div class="mainbody"> 
        <!--Mode Button-->
        <div class="button-play container">
            <div class="row">

                <div class="col-md-6">
                    <button class="button-computer" onclick="window.location.href='/computer' ">
                        <span>Computer</span>
                        <img src="{{asset('img/IMGcomputer.png')}}" alt="Hình minh họa">
                    </button>
                </div>
                
                <div class="col-md-6">
                    <button class="button-online" onclick="window.location.href='/online' ">
                        <span>Online</span>
                        <img src="{{asset('img/IMGonline.png')}}" alt="Hình minh họa">
                    </button>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="button-practice" onclick="window.location.href='/practice'">
                        <span>Practice</span>
                        <img src="{{asset('img/IMGpractice.png')}}" alt="Hình minh họa">
                    </button>
                </div>

                <div class="col-md-6">
                    <button class="button-puzzle" onclick="window.location.href='/puzzle'">
                        <span>Puzzle</span>
                        <img src="{{asset('img/IMGpuzzle.png')}}" alt="Hình minh họa">
                    </button>
                </div>
                
            </div>
        </div>
    </div>
</body>
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
