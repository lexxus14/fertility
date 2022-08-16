@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Doctor Diagnosis List</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	<a href="{{route('DoctorDiagnosisCreate')}}" class="btn btn-primary btn-block"><b>Add New Doctor Diagnosis</b></a>

                
                <hr>

                
                <div class="input-group" data-widget="sidebar-search">
				          <input class="form-control form-control-sidebar" type="search" placeholder="Search Lead" aria-label="Search">
				          <div class="input-group-append">
				            <button class="btn btn-sidebar">
				              <i class="fas fa-search fa-fw"></i>
				            </button>
				          </div>
				        </div>
                <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Reports</strong>

                <p class="text-muted">
                	<a href="#">Report 1</a>
                	<br/>
                	<a href="#">Report 2</a>
                	<br/>
                </p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-9">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Doctor Diagnosis Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Notes</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($doctordiagnosis as $doctordiagnos)
                  <tr>
                    <td>{{$doctordiagnos->id}}</td>
                    <td>{{$doctordiagnos->code}}</td>
                    <td>{{$doctordiagnos->description}}</td>
                    <td>{{$doctordiagnos->note}}</td>
                    <td>
                      
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$doctordiagnos->id}}">
                        <a href="{{route('DoctorDiagnosisEdit')}}/{{$doctordiagnos->id}}" class=" badge bg-success">Edit</button></a>&nbsp
                        <button type="button" class=" badge bg-danger open-modal-delete" data-toggle="modal" data-target="#modal-delete" value="{{$doctordiagnos->id}}">Delete</button>
                      <!-- </form> -->
                    </td>
                  </tr>    
                  @endforeach                            
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>description</th>
                    <th>Notes</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you to delete?</p>
            </div>
            <form method="POST" action="{{route('DoctorDiagnosisDelete')}}">
              {{ csrf_field() }}
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete</button>
              </div>
              <input type="hidden" id="del_id" name="del_id" value="0">
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

  <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["excel", "pdf"],
      "searching": true,
      "ordering": true,
      "paging": true,
      "info": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $('.open-modal-delete').click(function(data){
      var id = $(this).val();
      $('#del_id').val(id);
    });

  });
</script>
@endsection