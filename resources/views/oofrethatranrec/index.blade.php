@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lab Investigation List</h1>
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
              	<a href="{{route('LabCreate')}}/1" class="btn btn-primary btn-block"><b>Add New Lab Investigation</b></a>

                
                <hr>

                
                <div class="input-group" data-widget="sidebar-search">
				          <input class="form-control form-control-sidebar" type="search" placeholder="Search Patient" aria-label="Search">
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
		          <h3 class="card-title">Lab Investigation</h3>
		        </div>
		        <div class="card-body p-0">
		          <table class="table table-striped projects">
		              <thead>
		                  <tr>
		                      <th style="width: 1%">
		                          No
		                      </th>
		                      <th style="width: 20%">
		                          Name
		                      </th>
		                      <th style="width: 20%">
		                          Attending Nurse / Doctor
		                      </th>
		                      <th>
		                          Lab Investigation Name
		                      </th>
		                      <th style="width: 20%" class="text-center">
		                          Note
		                      </th>
		                      <th style="width: 20%">
		                      </th>
		                  </tr>
		              </thead>
		              <tbody>
		                  <tr>
		                      <td>
		                          1
		                      </td>
		                      <td>
		                          <a>
		                             Wife A A A
		                          </a>
		                          <br/>
		                          <small>
		                             Husband A A A
		                          </small>
		                      </td>
		                      <td>
		                          <ul class="list-inline">
		                              <li class="list-inline-item">
		                                  <img alt="Avatar" class="table-avatar" src="{{asset('dist/img/avatar.png')}}">
		                              </li>
		                              <li class="list-inline-item">
		                                  <img alt="Avatar" class="table-avatar" src="{{asset('dist/img/avatar2.png')}}">
		                              </li>
		                              <li class="list-inline-item">
		                                  <img alt="Avatar" class="table-avatar" src="{{asset('dist/img/avatar3.png')}}">
		                              </li>
		                          </ul>
		                      </td>
		                      <td class="project_progress">
		                          Lab Investigation 1
		                      </td>
		                      <td class="project-state">
		                          Lab Investigation Note 1
		                      </td>
		                      <td class="project-actions text-right">
		                          <a class="btn btn-primary btn-sm" href="{{route('PatientShow')}}/1">
		                              <i class="fas fa-folder">
		                              </i>
		                              View
		                          </a>
		                          <a class="btn btn-info btn-sm" href="#">
		                              <i class="fas fa-pencil-alt">
		                              </i>
		                              Edit
		                          </a>
		                          <a class="btn btn-danger btn-sm" href="#">
		                              <i class="fas fa-trash">
		                              </i>
		                              Delete
		                          </a>
		                      </td>
		                  </tr>
		                  <tr>
		                      <td>
		                          2
		                      </td>
		                      <td>
		                          <a>
		                             Wife B B B
		                          </a>
		                          <br/>
		                          <small>
		                             Husband B B B
		                          </small>
		                      </td>
		                      <td>
		                          <ul class="list-inline">
		                              <li class="list-inline-item">
		                                  <img alt="Avatar" class="table-avatar" src="{{asset('dist/img/avatar.png')}}">
		                              </li>
		                              <li class="list-inline-item">
		                                  <img alt="Avatar" class="table-avatar" src="{{asset('dist/img/avatar2.png')}}">
		                              </li>
		                              <li class="list-inline-item">
		                                  <img alt="Avatar" class="table-avatar" src="{{asset('dist/img/avatar3.png')}}">
		                              </li>
		                          </ul>
		                      </td>
		                      <td class="project_progress">
		                          Lab Investigation 2
		                      </td>
		                      <td class="project-state">
		                          Lab Investigation Note 2
		                      </td>
		                      <td class="project-actions text-right">
		                          <a class="btn btn-primary btn-sm" href="{{route('PatientShow')}}/0">
		                              <i class="fas fa-folder">
		                              </i>
		                              View
		                          </a>
		                          <a class="btn btn-info btn-sm" href="#">
		                              <i class="fas fa-pencil-alt">
		                              </i>
		                              Edit
		                          </a>
		                          <a class="btn btn-danger btn-sm" href="#">
		                              <i class="fas fa-trash">
		                              </i>
		                              Delete
		                          </a>
		                      </td>
		                  </tr>		                  
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
@endsection