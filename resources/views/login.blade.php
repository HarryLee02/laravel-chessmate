    @include('includes.header')
    <title>Login</title>
    <link href="{{asset('css/login.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
@if(session()->get('error'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('error') }}
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="blur">
        <h1>Form: Sign In</h1>
        <div class="container" id="container">
            <div class="form-container sign-in-container">
                <form method="POST" action="{{url('/login/auth')}}" >
                    @csrf
                    <h1>Sign in</h1>
                    
                    <input type="email" placeholder="Email" name="email"/>
                    <input type="password" placeholder="Password" name="password"/>
                    <a href="#" style="text-decoration: none;">Forgot your password?</a>
                    <button type="submit" name="login">Login</button>
                    <span>or use your account</span>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" onclick="playmode()"><i class="fas fa-gamepad"></i>PLay as Guest</button>
                        <button class="ghost" id="signUp" onclick="register()"><i class="fas fa-pen-fancy"></i>Create new account</i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <!--Home-->
    <a href="/home" class="back-to-home-button"><i class="fas fa-home" style="color:palevioletred"></i></a>
    <style>
        .back-to-home-button
        {
            display: inline-block;
            padding:10px 20px;
            text-decoration: none;
            background: white;
            border-radius: 5px;
            position:absolute;
            top:20px;
            z-index: 10;
            left: 20px;
            border: none;
        }
        .back-to-home-button:hover{
            background:darkturquoise;
        }
    </style>
</body>
</html>