<nav>
    <!-- <link href="{{asset('css/nav.css')}}" rel="stylesheet" type="text/css"> -->
    <!--Logo-->
    <div class="logo">
        <img src="{{asset('img/logo.png')}}" alt="Logo Image"> 
    </div>
    <div class="nav-brand">
            <span class="nav-text" id="brand-text"></span>
    </div>
    <!--Nav Item-->
    <div class="hamburger">
        <i class="fas fa-bars"></i>
    </div>
    <!--Nav link-->
    <ul class="nav-link">
        <li><a href="/home">HOME</a></li>
        <li><a href="/playmode">PLAYMODE</a></li>
        <li><a href="/shop">SHOP</a></li>
        <li><a href="/blog">BLOG</a></li>
        <li><a href="/faqs">FAQS</a></li>
        @if(session()->get('logged_in'))
            <li>
                <form method="POST" action="{{url('/logout')}}">
                    @csrf
                    <button class="login-btn" type="submit" >Logout</button>
                </form>
            </li>
            <li>
                <form method="GET" action="{{url('/profile')}}">
                    <button class="login-btn">
                    <i class="ri-user-settings-line"></i>
                    </button>
                </form>
            </li>
        @else
            <li><button class="login-btn" href="/login" onclick="login()">Login</button></li>
        @endif
    </ul>
</nav>
