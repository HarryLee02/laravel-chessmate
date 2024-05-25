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