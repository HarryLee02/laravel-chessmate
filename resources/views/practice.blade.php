    @include('includes/header')
    @include('includes/boardheader')
    <title>Practice</title>
    <link href="{{asset('css/practice.css')}}" rel="stylesheet">
    <script src="{{asset('js/gamePractice.js')}}" type="module"></script>
</head>
<body>
    @include('includes.navbar')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="center">
                    <br>
                    <div id="myBoard"style="width: 410px; margin: 0 auto;"></div>
                    <br>
                    <button id="changeTheme" type="button" style="align-items: center;">Random Theme</button>
                    <!-- <button id="restart" type="button" style="align-items: center;">Restart</button> -->
                    <button id="clear" type="button" style="align-items: center;">Clear board</button>
                    <button id="flip" type="button" style="align-items: center;">Flip board</button>
                    <button id="start" type="button" style="align-items: center;">Start this position</button>
                </div>
            </div>

            <div class="col-md-5">
                <textarea id="pgn" readonly>
                
                </textarea>
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