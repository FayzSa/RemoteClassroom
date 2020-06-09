

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
                        <li><a class="nav-link"  href="{{route('Teacher.Profile')}}" >{{$me->firstName }} {{$me->lastName}}</a></li>
                            
                        </ul>
                        
                        
                        <!-- Search Button -->
                        <div class="search-area invisible">
                            <form action="#" method="post">
                                <input type="search" name="search" id="search" placeholder="Search">
                                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        <a class="btn btn-danger text-white" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                            
                            {{ __('Logout') }}
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                        </a>
                 
    
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>
            @yield('classnav') 
        </div>
    </div>

    
</header>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                
                    
                    <a class="btn btn-danger text-white" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}
                        <i class="fa fa-sign-out" aria-hidden="true"></i> 
                    </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> 
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>



<!-- ##### Header Area End ##### -->

<!-- ##### Hero Area Start ##### -->



 