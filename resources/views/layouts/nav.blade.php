

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
                            <li><a href="{{ url('/teacher') }}">Home</a></li>
                            <li>
                                <a class="nav-link" href="{{ url('teacher/classrooms/create') }}">Create Class Room </a>
                            </li>
                            <li><a class="nav-link"  href="{{ url('teacher/classrooms') }}" >Your Classes</a></li>
                            <li><a class="nav-link"  href="{ {url('/users')}}" >{{$me->firstName }} {{$me->lastName}}</a></li>
                            
                        </ul>
    
                        <!-- Search Button -->
                        <div class="search-area invisible">
                            <form action="#" method="post">
                                <input type="search" name="search" id="search" placeholder="Search">
                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
    
                       
    
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



 