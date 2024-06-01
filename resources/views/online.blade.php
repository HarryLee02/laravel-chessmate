    @include('includes/header')
    @include('includes/boardheader')
    <title>Online</title>
    <link href="{{asset('css/online.css')}}" rel="stylesheet">
    <!-- <script src="{{asset('js/gameOnline.js')}}" type="module"></script> -->
</head>
<body>
    @include('includes.navbar')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div id="clock-countdown">
                    <div id="clock"><span id="timer1">10:00</span></div>
                </div>
                <div class="center">
                    <div id="myBoard"style="width: 470px; margin: 0 auto; "></div>
                    <br>
                    <button id="resign" type="button" class="btn btn-danger">Resign</button>
                </div>
                <div id="clock-countdown2">
                    <div id="clock"><span id="timer2">10:00</span></div>
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
            if (window.innerWidth > 400) {
                navItems.forEach(item => item.style.display = 'block');
                loginBtn.style.display = 'block';
            } else {
                navItems.forEach(item => item.style.display = 'none');
                loginBtn.style.display = 'none';
            }
        });
    });
     // Pusher channels

    // const pusher = new Pusher('{{ config("broadcasting.connections.pusher.key") }}', {cluster: 'eu'});
    // const channel = pusher.subscribe('public');

    //  //receive move
    // channel.bind('move',function(data)
    // {
    //     $.post('/receive',{
    //         _token: '{{csrf_token()}}',
    //         move: data.move,
    //     }).done(function(res)
    //     {
    //         if(data.move)
    //         {
    //             board.position(res.move);
    //             board.resize();
    //         }
    //     });
    // })

    // //send move
    // $('#myBoard').on('move',function(data)
    // {
    //     $.ajax({
    //         url: '/broadcast',
    //         method: 'POST',
    //         headers: {
    //             'X-Socket-Id': pusher.connection.socket_id
    //         },
    //         data: {
    //             _token: '{{csrf_token()}}',
    //             move: data.move,
    //         }
    //     });
    // });
 </script>