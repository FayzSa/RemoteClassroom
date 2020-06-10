<nav class="navbar navbar-expand-md navbar-danger bg-white shadow-sm mb-3">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Remote Classroom
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('student.classroom.joinview') }}">join Class Room </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ url('student/classrooms') }}" >Your Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ url('student/classrooms/tests/all') }}" >Your tests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ url('/student/classroom/requests') }}" >Your Requests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ url('/student/classrooms/sessions/all') }}" >Your sessions</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"  href="{{route('student.profile')}}" >{{session('me')->firstName.' '.session('me')->lastNames}}</a>
                </li>

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                <!--   @ guest
                      <li class="nav-item">
                          <a class="nav-link" href="{ { route('login') }}">{ { __('Login') }}</a>
                      </li>
                      @ if (Route::has('register'))
                          <li class="nav-item">
                              <a class="nav-link" href="{ { route('register') }}">{ { __('Register') }}</a>
                          </li>
                      @ endif
                  @ else
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              { { Auth::user()->name }} <span class="caret"></span>
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{ { route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  { { __('Logout') }}
                              </a>
                              <form id="logout-form" action="{ { route('logout') }}" method="POST" style="display: none;">
                                  @ csrf
                              </form>
                          </div>
                      </li>
                  @ endguest*/-->
            </ul>
        </div>
    </div>
</nav>
