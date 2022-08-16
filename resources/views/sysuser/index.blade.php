@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User's List</h1>
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
              	<a href="{{route('SystemUserCreate')}}" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-show"><b>Add New User</b></a>

                
                <hr>

                
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->

          <div class="col-md-9">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <!-- <th>Action</th> -->
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($systemusers as $systemuser)
                  <tr>
                    <td>{{$systemuser->id}}</td>
                    <td>{{$systemuser->name}} &nbsp {{$systemuser->last_name}}</td>
                    <!-- <td>                      
                        
                       

                        <a class="btn btn-primary btn-sm float-right" href="{{route('SystemUserEdit')}}/{{$systemuser->id}}">
                            <i class="fas fa-folder"></i>
                                  View
                          </a>

                          <a class="btn btn-info btn-sm float-right" href="{{route('SystemUserEdit')}}/{{$systemuser->id}}">
                            <i class="fas fa-pencil-alt"></i> Edit
                          </a>                       

                          <button type="button" class="btn btn-danger btn-sm open-modal-delete float-right" data-toggle="modal" data-target="#modal-delete" value="{{$systemuser->id}}"> <i class="fas fa-trash">
                                </i>Delete
                          </button>
                    </td> -->
                  </tr>    
                  @endforeach                            
                  </tbody>
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
            <form method="POST" action="{{route('SystemUserDelete')}}">
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

    <!-- Modal Lead Assessment -->
      <div class="modal fade" id="modal-show">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">New User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form id="quickForm" action="{{route('SystemUserStore')}}" method="POST" enctype="multipart/form-data">
              {{ csrf_field() }}
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control" name="txtname" placeholder="Name">
                    </div>
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" name="txtlastname" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" class="form-control" id="id_email" name="txtemail" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" id="password" name="txtpassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label>Retype Password</label>
                      <input type="password" class="form-control" id="password_again" name="txtrepassword" placeholder="Password">
                    </div>
                </div>
              </div>  
              <!-- <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="inputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>  -->     
            </div>            
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
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
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "searching": true,
      "ordering": true,
      "paging": false,
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

  <script >
  $(document).ready(function(){

    $('#id_email').keyup(function(){
      var val = $(this).val();
      $.get('{{route('GetUserEmail')}}' + '/' + val, function (data) {
          if(data.length>0){
            alert('Email already exist.');
            $('#id_email').val('');
          }
        });
    });

    /* Lead Reminder */
    $('#doc-date').datetimepicker({
        format: 'L'
    });

    $('.open-modal-delete').click(function(data){
      var id = $(this).val();
      $('#del_id').val(id);
    });

    $('#quickForm').validate({
    rules: {
      txtpassword: "required",
      txtrepassword: {
      equalTo: "#password"
      },

      txtname: {
        required: true
      },

      txtlastname: {
        required: true
      },

      txtemail: {
        required: true,
        email:true,
      },
    },
    messages: {

      txtname: {
        required: "Please provide the name."
      },
      txtlastname: {
        required: "Please provide the last name."
      },
      txtemail: {
        required: "Please provide the email.",
        email: "Please enter valid email."
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
  });
  </script>
@endsection