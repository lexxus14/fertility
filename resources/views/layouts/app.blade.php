<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fertility</title>

  <link href="{{asset('plugins/literallycanvas.css')}}" rel="stylesheet" type="text/css" />

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- daterange picker -->
  <!-- <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css')}}"> -->
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
  <!-- <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}"> -->
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ asset('plugins/bs-stepper/css/bs-stepper.min.css')}}"> 

  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ asset('plugins/dropzone/min/dropzone.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>

<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>

<!-- jquery-validation -->
<script src="{{asset('plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('plugins/jquery-validation/additional-methods.min.js')}}"></script>

<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<!-- Star Rate -->
  <link rel="stylesheet" href="{{asset('plugins/star-rate/starrate.css')}}">
  <script src="{{asset('plugins/star-rate/starrate.js')}}"> </script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links  -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
<!--  <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Fertility</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          @if (!Auth::guest())
          <a href="{{route('SystemUserProfileEdit')}}/{{ Auth::user()->id }}" class="d-block">{{ Auth::user()->name }}</a>
          @endif
        </div>
      </div>

      <!-- SidebarSearch Form 
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>            
          </li>         
          <li class="nav-item">
            <a href="{{route('LeadIndex')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Leads</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('PatientIndex')}}" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>In-Patient</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Library
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Diagnostic</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Diagnostic Group</p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="{{route('ReasonIndex')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reason</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('VitalSignIndex')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vital Sign</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('DoctorDiagnosisIndex')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Doctor Diagnosis</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('DoctorsPlansIndex')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Doctor's Plan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('NationalityIndex')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nationality</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('LeadSourceIndex')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lead Source</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="{{route('MedicineIndex')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Medication</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('LabTestIndex')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lab Test</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('ProcedureIndex')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Procedure</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('StaffIndex')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Staff</p>
                </a>
              </li>              
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-pencil-alt"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('LeadReport')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Monthly Consulatation</p>
                </a>
              </li>              
            </ul>
            <!-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('ConsultationReport')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultation</p>
                </a>
              </li>              
            </ul> -->
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('MedicineReport')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Medicine</p>
                </a>
              </li>              
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('TreatmentReport')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Treatment</p>
                </a>
              </li>              
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-cogs"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('ImportLead')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Import Lead</p>
                </a>
              </li>              
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('SystemUserIndex')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>              
            </ul>
          </li>
          <!-- <li class="nav-header">Reports</li>
          <li class="nav-item">
            <a href="../iframe.html" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Consultation</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Medication </p>
            </a>
          </li> -->
          
          <!-- <li class="nav-header">User</li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Profile </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                         <i class="nav-icon far fa-circle text-warning"></i>
                <p>Logout</p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


        @yield('content')
 <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="#">Fertility</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0-rc
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- JQVMap 
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>-->

<!-- AdminLTE for demo purposes 
<script src="{{asset('dist/js/demo.js')}}"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) 
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>-->
</body>
</html>

