@extends('layouts.student-app')
@section('title','Profile')
@section('start')


<section class="hero-area bg-img bg-overlay-2by5" style="background-image: url({{ asset('clever/img/bg-img/bg1.jpg') }});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <!-- Hero Content -->
                <div class="hero-content text-center">
                    <h2>Welcome To Your Profile</h2>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('content')

    <!-- Page Heading -->


    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-4 order-lg-2">

            <div class="card shadow mb-4">

                <div class="events-thumb mt-4">
                    @if (empty($me->profileIMG))
                    <img src="{{'https://storage.googleapis.com/elearningapp-30a10.appspot.com/AdminprofileDefault/admindefaultprofile.png'}}"  alt="user-image">
                    @else
                <img src="{{$me->profileIMG}}" class="img-fluid" alt="user-image">
                @endif
                </div>
                <form method="POST" action="{{ route('student.update') }}" autocomplete="off" enctype="multipart/form-data">

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="ProfileIMG">
                                    <label class="custom-file-label" for="inputGroupFile01">Update your profile</label>
                                  </div>
                                      <hr>
                                <h5 class="font-weight-bold">{{  $me->firstName.' '.$me->lastName }}</h5>
                                <p><span class="badge badge-warning text-white">{{$me->type}}</span></p>
                                <a href="{{route('Teacher.Settings')}}"><span class="badge badge-primary">Settings</span></a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">My Account</h6>
                </div>

                <div class="card-body">


                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">Student information</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="FirstName">First Name<span class="small text-danger">*</span></label>
                                        <input type="text" id="FirstName" class="form-control" name="FirstName" placeholder="Name" value="{{  $me->firstName }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="LastName">Last name</label>
                                        <input type="text" id="last_name" class="form-control" name="LastName" placeholder="Last name" value="{{ old('last_name', $me->lastName) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email address<span class="small text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" name="Email" placeholder="example@example.com" value="{{ old('email', $me->email) }}" readonly="true">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Bio</label>
                                        <textarea class="form-control " name="Bio" placeholder="your bio here"  rows="4" >
                                            {{ old('Bio', $me->bio) }}

                                    </textarea>
                                </div>
                                    </div>
                                </div>


                                {{-- <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">New password</label>
                                        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Confirm password</label>
                                        <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
