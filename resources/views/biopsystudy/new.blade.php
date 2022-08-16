@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Biopsy Study</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Advanced Form</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Biopsy Study Form</h3>
              </div>
              <form action="{{route('BiopsyStudyStore')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="card-body p-0">

                  <div class="bs-stepper-content">
                    <div class="row">
                      <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <!-- <label>Patient Name:</label>
                            Wife A A A -->
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Patient Name:</label>
                            <h3>Wife A A A</h3>
                          </div>
                        </div>
                      </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                            <label>Date</label>
                            <div class="input-group date" id="birthdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#birthdate"/>
                                <div class="input-group-append" data-target="#birthdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Doctor</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Nurse</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                      </div>

                    <!-- your steps content here -->                      
                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Number of Embryo</label>
                            <input type="text" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Notes</label>
                            <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="customFile">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                          </div>
                          <div class="form-group">
                          </div>
                        </div>
                      </div>
                    
                  </div>

              
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save" class="btn btn-success float-right">
                  </div>
                </div> 
              </div>
            <!-- /.card -->
          </form>
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 <script type="text/javascript">
    $(function () { 
       //Date picker
    $('#birthdate').datetimepicker({
        format: 'L'
    });
    $('#marrieddate').datetimepicker({
        format: 'L'
    });    
    $('#husbandbirthdate').datetimepicker({
        format: 'L'
    });
  })
 </script> 
@endsection