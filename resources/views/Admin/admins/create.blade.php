@extends('layouts.admin')

@section('main-content')


  <!-- Custom styles for this page -->
  <link href="public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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




    <div class="col-lg-8 order-lg-1">

        <div class="card shadow mb-4">
    
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Admin</h6>
            </div>
    
            <div class="card-body">
            <form method="POST" action="{{ route('admins.store') }}" autocomplete="off" >
                
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
                    <input type="hidden" name="_method" value="PUT">
    
                    <h6 class="heading-small text-muted mb-4">Admin Information</h6>
    
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="FirstName">First Name<span class="small text-danger">*</span></label>
                                <input type="text" id="FirstName" class="form-control" name="FirstName" placeholder="First Name" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="LastName">Last Name<span class="small text-danger">*</span></label>
                                <input type="text" id="LastName" class="form-control" name="LastName" placeholder="Last Name here" >
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="Email">Email address<span class="small text-danger">*</span></label>
                                <input type="email" id="email" class="form-control" name="Email" placeholder="example@example.com" >
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            
    
                           
                            <div class="col-lg-8">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="password"> password</label>
                                    <input type="password" id="assword" class="form-control" name="password" placeholder="New password">
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="password_confirmation">Confirm password</label>
                                    <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirm password">
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
    
              
    
    
            </div>
    
        </div>
    
    </div>
    

      <script src="public/js/demo/datatables-demo.js"></script>

      <script src="public/vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="public/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    

@endsection