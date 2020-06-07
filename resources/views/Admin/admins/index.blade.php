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




    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="my-2">
            <h1 class="h3 mb-2 text-gray-800">Admins List</h1>

                  <a href="{{ route('admins.create') }}" class="btn btn-info btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-info-circle"></i>
                    </span>
                    <span class="text">Add New Admin</span>
                  </a>
    </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th width="40px">Vector</th>
                    <th>FullName</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created date</th>
                    <th width="175px">Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Vector</th>
                    <th>FullName</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>created date</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
                  @foreach ($admins as $data)
                      
                          
                      
                
                  <tr>
                    <td>
                      <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle " src="{{ $data['ProfileIMG'] }}" alt="" width="35" height="35">
                      <div class="status-indicator bg-success"></div>
                    </div>
                </td>
                @if($data->id() == session('uid'))
                    <td>{{ $data['FirstName']}} <span class="badge badge-warning"> My account  </span></td>
                    @else
                    <td>{{ $data['FirstName'].' '.$data['LastName']}} </td>
                    @endif
                    <td>{{$data['Email']}}</td>
                    @if($data['active'])
                    <td><span class="badge badge-warning">Enabled</span></td>
                    @else
                    <td><span class="badge badge-warning">Disabled</span></td>
                    @endif

                    
                    <td>{{ Carbon\Carbon::parse(substr($data['created_at'],0,19))->diffForHumans()}}</td>
                    @if($data['active'])
                    <td><a href="/admins/status/{{ $data->id() }}" class="btn btn-danger ">
                      <i class="fas fa-user-lock"></i> disable Account
                    </a></td>
                @else
                <td><a href="/admins/status/{{ $data->id() }}" class="btn btn-danger ">
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