    @include('includes.header')
    <title>FAQS</title>
    <link href="{{asset('css/faqs.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css"/>
</head>
<body>
    @include('includes.navbar')
    <div class="mainbody">
        <!--Search bar-->
        <div class="wrapper">
            <div class="label">Submit your search</div>
            <div class="searchBar">
                <input id="searchQueryInput" type="text" name="searchQueryInput" placeholder="Describe your issue here . . ." value="" />
                <button id="searchQuerySubmit" type="submit" name="searchQuerySubmit">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="#666666" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Container issue-->
        <div class="container">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        <strong>What is ChessMate?</strong>
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <strong>ChessMate</strong> is a website built by a group of students from the University of Information Technology - Viet Nam <i class="fib fib-vn" ></i>. The website is designed to help users improve their chess skills and knowledge. Users can play chess online, read articles about chess, and buy chess-related products from the shop. The website also has a blog where users can post questions and get answers from the community. Currently, the website is under development since it is just a class project. However, any supports and feedbacks from users are highly appreciated and the team might consider further development in the future.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        Is it free to play?
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <strong>This website is free for playing!</strong> We aim to provide a platform for chess enthusiasts to play and improve their skills without any cost. However, for those who want more in-game features or just to support us, we also have a shop where users can buy chess-related products.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Is this website completed?
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <strong>Not yet.</strong> The group still has a lot of ideas to implement and features to add to the website. If you have any suggestions or feedback, feel free to contact us, we are always open to new ideas and improvements <i class="fa-light fa-face-smile"></i>.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        Want to support us?
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <strong>Bravo!</strong> 
                            <br>
                            Not many would think of supporting a class project, but you did! You can support us by donating via the link below. Thank you for your support <i class="bi bi-balloon-heart"></i>.
                            <br>
                            <a class="btn btn-primary" href="paypal.me/harrylee02" role="button">Link</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-container" onclick="blog()">
            <b class="title">Need more help?</b>
            <p class="steps">Try these steps:</p>
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3" style="font-size:70px;"> &#11088</div>
                    <div class="col-md-7">
                        <b class="post-title">Post to our Blog</b>
                        <p class="description">Get answers from the community</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    // Srcipt Navbar
    // Brandtext
    document.addEventListener('DOMContentLoaded', function AppearOnce() {
        const brandtext = "ChessMate";
        const brandElement = document.getElementById('brand-text');

        function type(index) {
            brandElement.textContent = brandtext.slice(0, index);
            if (index <= brandtext.length)
                setTimeout(() => type(index + 1), 500);
            else {
                setTimeout(() => {
                    document.removeEventListener('DOMContentLoaded', AppearOnce);
                    brandElement.textContent = brandtext;
                }, 1000);
            }
        }
        type(0);
    });

    // Hambuger
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerIcon = document.querySelector('.hamburger');
        const navLink = document.querySelector('.nav-link');
        const navItems = document.querySelectorAll('.nav-link li a');
        const loginBtn = document.querySelector('.login-btn');

        hamburgerIcon.addEventListener('click', function() {
            navLink.classList.toggle('show');
            if (navLink.classList.contains('show')) {
                navItems.forEach(item => item.style.display = 'block');
                loginBtn.style.display = 'block';
            } else {
                navItems.forEach(item => item.style.display = 'none');
                loginBtn.style.display = 'none';
            }
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth > 1000) {
                navItems.forEach(item => item.style.display = 'block');
                loginBtn.style.display = 'block';
            } else {
                navItems.forEach(item => item.style.display = 'none');
                loginBtn.style.display = 'none';
            }
        });
    });

    // Hiện option lên search bar
    document.addEventListener('DOMContentLoaded', function() {
        const selectElements = document.querySelectorAll('.select');
        selectElements.forEach(selectElement => {
            selectElement.addEventListener('change', function() {
                const selectedOption = this.value;
                const searchInput = document.getElementById('searchQueryInput');
                searchInput.value = selectedOption;
            });
        });
    });
</script>