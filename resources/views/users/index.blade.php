<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Users List</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <a class="btn btn-primary" href="/users/create">Add new user</a>
          <hr>            
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row"><div class="col-sm-12">
            <table id="example1" class="table table-bordered table-striped dataTable" 
              role="grid" aria-describedby="example1_info">
              <thead>
              <tr role="row">
              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 182px;">ID</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;">FullName</th>
              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($user as $data)
              
              <tr role="row" class="odd">
                
                @if (!empty($data['FullName']) )
                <td class="sorting_1">{{ $data->id() }}</td>
                <td>{{ $data['FullName'] }}</td>
              
                <td>
                  <a class="btn btn-xs btn-warning"  href="/users/edit/{{ $data->id() }}" >edit</a>

                  <a class="btn btn-xs btn-danger" href="/users/delete/{{ $data->id() }}">delete</a>
                </td>
                @endif
               
              </tr>
              @endforeach
              </tbody>
              <tfoot>
              </tfoot>
            </table>
          
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>

