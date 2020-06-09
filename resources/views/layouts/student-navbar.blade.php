

<!-- ##### Header Area Start ##### -->
<header class="header-area ">
    <div class="clever-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <!-- Menu -->
            <nav class="classy-navbar justify-content-between" id="cleverNav">

                <!-- Logo -->
                <a class="nav-brand" href="index.html"><img src="img/core-img/logo.png" alt="">RemoteClassroom</a>

                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>

                <!-- Menu -->
                <div class="classy-menu">

                    <!-- Close Button -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>

                    <!-- Nav Start -->

                    <div class="classynav">
                        <ul>
                                    <li >
                                        <a class="nav-link"  href="{{ url('student/classrooms') }}" >Your Classes</a>
                                    </li>
                                    <li >
                                        <a class="nav-link"  href="{{ url('student/classrooms/tests/all') }}" >Your tests</a>
                                    </li>
                                    <li >
                                        <a class="nav-link"  href="{{ url('/student/classroom/requests') }}" >Your Requests</a>
                                    </li>
                                    <li>
                                        <a class="nav-link"  href="{{ url('/student/classrooms/sessions/all') }}" >Announcement</a>
                                    </li>


                                    <li class="cta mt-sm-2">
                                        <a href="{{route('student.profile')}}" class="nav-link"><span>{{session('me')->firstName.' '.session('me')->lastNames}}</span>

                                        </a>

                                    </li>
                            <li class=" mt-sm-1">
                                <form method="post" action="{{route('logout')}}" class="nav-link"><input class="p-2 cta btn rounded btn-outline-primary" value="logout" type="submit">
                                    @csrf
                                </form>

                            </li>

                        </ul>




                    </div>
                    <!-- Nav End -->
                </div>
            </nav>
            @yield('classnav')
        </div>
    </div>


</header>

<!-- ##### Header Area End ##### -->

<!-- ##### Hero Area Start ##### -->




