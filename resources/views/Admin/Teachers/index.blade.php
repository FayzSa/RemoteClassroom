@extends('layouts.admin')

@section('main-content')


  <!-- Custom styles for this page -->
  <link href="public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif




    <div class="container-fluid">

        <!-- Page Heading -->
        {{-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> --}}

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Teachers Liste</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="40px">Vector</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created date</th>
                    <th width="175px">Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>vector</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created Date </th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($teachers as $data)
                      
                          
                      
                
                  <tr>
                    <td>
                      <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle " src="{{ $data['ProfileIMG'] }}" alt="" width="35" height="35">
                      <div class="status-indicator bg-success"></div>
                    </div>
                </td>
                    <td>{{ $data['FirstName']." ".$data['LastName']}}</td>
                    <td>{{$data['Email']}}</td>
                    @if($data['active'])
                    <td><span class="badge badge-warning">Enabled</span></td>
                    @else
                    <td><span class="badge badge-warning">Disabled</span></td>
                    @endif
                    
                    <td>{{ Carbon\Carbon::parse(substr($data['CreatedDate'],0,19))->diffForHumans()}}</td>
                    @if($data['active'])
                    <td><a href="/teachers/status/{{ $data->id() }}" class="btn btn-danger ">
                      <i class="fas fa-user-lock"></i> disable Account
                    </a></td>
                @else
                <td><a href="/teachers/status/{{ $data->id() }}" class="btn btn-danger ">
                  <i class="fas fa-unlock-alt"></i> Enable Account
                </a></td>
                @endif
                  </tr>
               
                  @endforeach

                  
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    

      <script src="public/js/demo/datatables-demo.js"></script>

      <script src="public/vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="public/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    

@endsection