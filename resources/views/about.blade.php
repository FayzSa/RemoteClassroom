@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('About') }}</h1>

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow mb-4">

                <div class="card-profile-image mt-4">
                    <img src="{{ asset('img/favicon.png') }}" class="rounded-circle" alt="user-image">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12 mb-1">
                            <div class="text-center">
                                <h5 class="font-weight-bold">Remoote Cmassroom</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Remoote Classroom 2.0</h5>
                            <p>some text her e.</p>
                            <p>Recommend to all students and teches and much more .......</p>
                            
                        </div>
                    </div>

                    <hr>

                   

                </div>
            </div>

        </div>

    </div>

@endsection
