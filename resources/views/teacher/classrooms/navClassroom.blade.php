<nav class="navbar navbar-expand-md navbar-danger bg-white ">
  <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                  <a class="nav-link active" href="/">Annonce Session</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('classroom.requests',['classroomID'=> $classroom->classroomID ?? ''])}}">Requests</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/createlive') }}">Create Session</a>
                </li>
                
               <li class="nav-item">
                <a class="nav-link"  href="{{ route('test.create',['classroomID'=> $classroom->classroomID ?? '']) }}" >Add Test</a>
              </li>
         
              <li class="nav-item">
                <a class="nav-link"  href="{{ route('classroom.tests',['classroomID'=> $classroom->classroomID ?? '']) }}" >Classroom Tests</a>
              </li>
         
               <li class="nav-item">
                  <a class="nav-link"  href="{{ route('course.create',['classroomID'=> $classroom->classroomID ?? '']) }}" >Add Course</a>
                </li>
           
     
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('classrooms.courses',['classroomID'=>$classroom->classroomID]) }}" >Classroom Courses</a>                </li>
              
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