    @include('includes.header')
    <title>FAQS</title>
    <link href="{{asset('css/faqs.css')}}" rel="stylesheet" type="text/css">
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
        <!--TEXT-->
        <div class="form-issue">
            <p class="heading-form">Please browse help topics below</p>
        </div>
        <!-- Container issue-->
        <div class="container">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Accordion Item #1
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        Accordion Item #2
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <strong>This is the second item's accordion body.</strong>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Accordion Item #3
                    </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <strong>This is the third item's accordion body.</strong>
                        </div>
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
                    <p class="description">Get answers from our assistant</p>
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