
<div class="top-header-area d-flex justify-content-between align-items-center">

    <div class="contact-info">


        <a href="{{route('classrooms.show',['classroomID'=> $classroom->classroomID ?? $classroomID])}}">Class</a>
        <a href="{{route('classroom.sessions',['classroomID'=> $classroom->classroomID ?? $classroomID])}}">Sessions Annonces</a>
        <a href="{{ route('session.create',['classroomID'=> $classroom->classroomID ?? $classroomID ]) }}">Create Annonce</a>
        <a  href="{{route('classroom.requests',['classroomID'=> $classroom->classroomID ?? $classroomID])}}">Requests</a>
        <a href="{{ route('teacher.createlive',['classroomID'=> $classroom->classroomID ?? $classroomID]) }}">Create Session</a>
        <a   href="{{ route('test.create',['classroomID'=> $classroom->classroomID ?? $classroomID]) }}" >Add Test</a>
        <a  href="{{ route('classroom.tests',['classroomID'=> $classroom->classroomID ?? $classroomID]) }}" >Classroom Tests</a>
        <a href="{{ route('course.create',['classroomID'=> $classroom->classroomID ?? $classroomID]) }}" >Add Course</a>
        <a  href="{{ route('classrooms.courses',['classroomID'=>$classroom->classroomID ?? $classroomID]) }}" >Classroom Courses</a>                </li>
        <a href="{{ route('classroom.edit',['classroomID'=>$classroom->classroomID ?? $classroomID]) }}">Edit</a>

    </div>
  </div>
