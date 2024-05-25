    @include('includes.header')
    <title>Your profile</title>
    <link href="{{asset('css/profile.css')}}" rel="stylesheet" type="text/css">
    <style>
        .hidden {
          display: none;
        }
      </style>        
</head>
<body>
    @include('includes.navbar')
    <span class="main_bg"></span>
    <div class="container">
        <section class="userProfile card">
            <div class="profile">
                <figure>
                    <img src="{{asset('img/logo.png')}}" alt="Avatar" width="250px" height="250px">
                </figure>
            </div>
        </section>

        <section class="work_skills card">

            <!-- ===== ===== Work Container ===== ===== -->
            <div class="work">
                <h1 class="heading">work</h1>
                <div class="primary">
                    <h1>Win 1000 matches</h1>
                    <span>Primary</span>
                    <p> <br> Since yesterday</p>
                </div>

                <div class="secondary">
                    <h1>Tutorial Finished  </h1>
                    <span>Secondary</span>
                    <p><br> Three weeks ago </p>
                </div>
            </div>

            <!-- ===== ===== Skills Container ===== ===== -->
            <div class="skills">
                <h1 class="heading">Mode</h1>
                <ul>
                    <li style="--i:0">Computer</li>
                    <li style="--i:1">Online</li>
                    <li style="--i:2">Practice</li>
                    <li style="--i:3">Tutorial</li>
                </ul>
            </div>
        </section>

        <section class="userDetails card">
            <div class="userName">
                <h1 class="name">{{$informations['profile']['displayName']}}</h1>
                <div class="map">
                    <i class="ri-map-pin-fill ri"></i>
                    <span>{{$informations['profile']['country']}}</span>
                </div>
                <p>Something ...</p>
            </div>
            <div class="rank">
                <h1 class="heading">Title</h1>
                <span style="background-color: #97273A; color:white; border-radius:7px; font-size:large;"> GM </span>
                <div class="rating">
                    <i class="ri-star-fill rate underrate"></i>
                    <i class="ri-star-fill rate underrate"></i>
                    <i class="ri-star-fill rate underrate"></i>
                    <i class="ri-star-fill rate underrate"></i>
                    <i class="ri-star-fill rate underrate"></i>
                </div>
            </div>
            <div class="btns">
                <ul>
                    <li class="sendMsg">
                        <i class="ri-chat-4-fill ri"></i>
                        <a href="#">Send Message</a>
                    </li>

                    <li class="sendMsg active">
                        <i class="ri-check-fill ri"></i>
                        <a href="#">Contacts</a>
                    </li>

                    <li class="sendMsg">
                        <a href="#">Report User</a>
                    </li>
                </ul>
            </div>

        </section>
        <section class="timeline_about card">
            <div class="tabs">
                <ul>
                    <li class="about active">
                        <i class="ri-user-3-fill ri"></i>
                        <span>About</span>
                    </li>

                    <li class="statistics">
                        <i class="ri-bar-chart-box-line ri"></i>
                        <span>Statistics</span>
                    </li>

                    <li class="notes">
                        <i class="ri-quill-pen-line ri"></i>
                        <span>Notes</span>
                    </li>

                    <li class="matches">
                        <i class="ri-sword-fill ri"></i>
                        <span>Matches</span>
                    </li>

                    <li class="achievements">
                        <i class="fa-light fa-medal"></i>
                        <span>Achievements</span>
                    </li>
                    
                </ul>
            </div>
            <div class="basic_info">
                    <div id="about" class="tab-content">
                        <h1 class="heading"><i class="fas fa-clone"></i>Basic Information</h1>
                        <ul>
                            <li class="full_name">
                                <h1 class="label">Full name:</h1>
                                <span class="info">{{$informations['profile']['displayName']}}</span>
                            </li>

                            <li class="address">
                                <h1 class="label">Country:</h1>
                                <span class="info">{{$informations['profile']['country']}}</span>
                            </li>

                            <li class="join">
                                <h1 class="label">Member since: </h1>
                                <span class="info">{{$informations['profile']['since']}}</span>
                            </li>

                            <li class="sex">
                                <h1 class="label">Gender:</h1>
                                <span class="info">{{$informations['profile']['gender']}}</span>
                            </li>
                        </ul>
                    </div>
                    <div id="statistics" class="tab-content hidden">
                        <h1 class="heading"><i class="fas fa-clone"></i>Your Statistics</h1>
                        <!-- Statistics Content Goes Here -->
                        <ul>
                            <li class="match_played">
                                <h1 class="label">Match played:</h1>
                                <span class="info">{{$informations['statistics']['match_played']}}</span>
                            </li>

                            <li class="wins">
                                <h1 class="label">Wins:</h1>
                                <span class="info">{{$informations['statistics']['wins']}}</span>
                            </li>

                            <li class="loses">
                                <h1 class="label">Loses: </h1>
                                <span class="info">{{$informations['statistics']['loses']}}</span>
                            </li>
                        </ul>
                    </div>
                    <div id="notes" class="tab-content hidden">
                        <h1 class="heading"><i class="fas fa-clone"></i>Your Notes</h1>
                        <!-- Notes Content Goes Here -->
                    </div>
                    <div id="matches" class="tab-content hidden">
                        <h1 class="heading"><i class="fas fa-clone"></i>History</h1>
                        <!-- Matches Content Goes Here -->
                    </div>
                    <div id="achievements" class="tab-content hidden">
                        <h1 class="heading"><i class="fas fa-clone"></i>Your achievements</h1>
                        <ul>
                            <li class="match_played">
                                <h1 class="label">{{$informations['achievements']['1']['Name']}}</h1>
                                <span class="info">{{$informations['achievements']['1']['Description']}}</span>
                            </li>
                            <li class="match_played">
                                <h1 class="label">{{$informations['achievements']['2']['Name']}}</h1>
                                <span class="info">{{$informations['achievements']['2']['Description']}}</span>
                            </li>
                        </ul>
                    </div>
            </div>

        </section>
    </div>
   
</body>
</html>
<script>
   document.addEventListener("DOMContentLoaded", function () {
        const tabs = document.querySelectorAll(".tabs li");

        tabs.forEach(tab => {
            tab.addEventListener("click", () => {
                const tabName = tab.getAttribute("class");
                const tabContent = document.getElementById(tabName);

                // Remove the 'active' class from all tabs
                tabs.forEach(t => t.classList.remove("active"));

                // Add the 'active' class to the clicked tab
                tab.classList.add("active");

                // Hide all tab contents
                document.querySelectorAll(".tab-content").forEach(content => {
                    content.classList.add("hidden");
                });

                // Show the content of the clicked tab
                tabContent.classList.remove("hidden");
            });
        });
    });
 </script>