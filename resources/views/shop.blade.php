@include('includes.header')
    <title>Shop</title>
    <link href="{{asset('css/shop.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    @include('includes.navbar')
    <div class="mainbody"> 
    <!--Search bar-->
        
        <div class="wrapper">
            <div class="label">Find your?</div>
                <div class="searchBar">
                    <input id="searchQueryInput" type="text" name="searchQueryInput" placeholder="What items do you want ? . . ." value="" />
                    <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                    </svg>
                    </button>
                </div>
            </div>
            <div class="panel">
                <h3 style="font-family:serif;">CheseMate Shop</h3>
                <div class="cart"><i class="fas fa-shopping-cart"></i></div>
            </div>
        <div class="nav-move">
            <a href="#">Board</a>
            <a href="#">Stickers</a>
            <a href="#">Calendar</a>
            <a href="#">Posters</a>
            <a href="#">Figures</a>
            <div class="animation start-home"></div>
            </div>

        <div class="container">
            <div class="content">
                <div class="row">
                    @foreach ($items['board_theme'] as $item)
                    <div class="col-md-4">
                        <div class="col-md-12 stuff">
                            <div class="upper">
                                <img  src="{{$item['link']}}" width="120" height="120">
                            </div>
                            <div class="downer">
                                <p>{{$item['name']}}</p>
                                <p>{{$item['price']}}</p>
                                <button type="button" class="btn add-to-cart">Add to cart</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
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
     // Shop Items
     
</script>