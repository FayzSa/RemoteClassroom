@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Settings') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif





<div class="col-lg-8 order-lg-1">

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">My Account</h6>
        </div>

        <div class="card-body">
        <form method="POST" action="{{ route('Admin.Settings.update') }}" autocomplete="off" >
            
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="_method" value="PUT">

                <h6 class="heading-small text-muted mb-4">Admin Settings</h6>

                <div class="pl-lg-4">
                    

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="Email">Email address<span class="small text-danger">*</span></label>
                            <input type="email" id="email" class="form-control" name="Email" placeholder="example@example.com" value="{{ $admin->email}}" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        

                       
                        <div class="col-lg-8">
                            <div class="form-group focused">
                                <label class="form-control-label" for="new_password">New password</label>
                                <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group focused">
                                <label class="form-control-label" for="confirm_password">Confirm password</label>
                                <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                            </div>
                        </div>
                    </div> 
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

            <hr>
            <h6 class="heading-small text-muted mb-4">Disable Account</h6>
            <form method="POST" action="{{ route('Admin.Settings.disable') }}" autocomplete="off" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input type="hidden" name="_method" value="PUT">
            <div class="pl-lg-4">
                <div class="row">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary">Disable Account</button>
                    </div>
                </div>
            </div>
            </form>


        </div>

    </div>

</div>

@endsection