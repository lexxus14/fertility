@extends('layouts.app')
@section('content')
  
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../../dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$users->name}}&nbsp{{$users->last_name}}</h3>

                <!-- <p class="text-muted text-center">Software Engineer</p> -->

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$users->email}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Date Joined</b> <a class="float-right">{{date_format($users->created_at,"Y/m/d")}}</a>
                  </li>
                  <!-- <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <!-- <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              
            </div> -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="row">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="{{asset('dist/img/user1-128x128.jpg')}}" alt="user image">
                          <span class="username">
                            <a href="#">Jonathan Burke Jr.</a>
                            
                          </span>                          
                          <span class="description">Shared publicly - 7:30 PM today</span>
                          <span class="description">Transaction:<b>Transaction Name</b></span>
                        </div>
                      </div>
                      <!-- /.user-block -->
                      <div class="row">
                        <p>
                          <b>Patient Name</b> 
                          <br>Document Description
                        </p>
                        <p>
                          Lorem ipsum represents a long-held tradition for designers,
                          typographers and the like. Some people hate it and argue for
                          its demise, but others ignore the hate as they create awesome
                          tools to help create filler text for everyone from bacon lovers
                          to Charlie Sheen fans.
                        </p>
                      </div>

                      <!-- <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p> -->

                      <!-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment"> -->
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post">
                      <div class="row">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="{{asset('dist/img/user1-128x128.jpg')}}" alt="user image">
                          <span class="username">
                            <a href="#">Jonathan Burke Jr.</a>
                            
                          </span>                          
                          <span class="description">Shared publicly - 7:30 PM today</span>
                          <span class="description">Transaction:<b>Transaction Name</b></span>
                        </div>
                      </div>
                      <!-- /.user-block -->
                      <div class="row">
                        <p>
                          <b>Patient Name</b> 
                          <br>Document Description
                        </p>
                        <p>
                          Lorem ipsum represents a long-held tradition for designers,
                          typographers and the like. Some people hate it and argue for
                          its demise, but others ignore the hate as they create awesome
                          tools to help create filler text for everyone from bacon lovers
                          to Charlie Sheen fans.
                        </p>
                      </div>

                      <!-- <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p> -->

                      <!-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment"> -->
                    </div>
                    <!-- /.post -->
                    
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <section class="content">
                      <form id="quickForm" action="{{route('SystemUserProfileUpdate')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" novalidate="">
                        {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{$users->id}}">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="card card-primary">
                            <div class="card-header">
                              <h3 class="card-title">Your Profile</h3>

                              <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                  <i class="fas fa-minus"></i>
                                </button>
                              </div>
                            </div>
                            <div class="card-body">
                              <div class="col-12">
                                    <div class="form-group">
                                      <label>Name</label>
                                      <input type="text" class="form-control" name="txtname" value="{{$users->name}}" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                      <label>Last Name</label>
                                      <input type="text" class="form-control" name="txtlastname" value="{{$users->last_name}}" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                      <label>Email</label>
                                      <input type="text" class="form-control" name="txtemail" id="id_email" value="{{$users->email}}" disabled="">
                                    </div>
                                    <div class="form-group">
                                      <label>Password</label>
                                      <input type="password" class="form-control" id="password" name="txtpassword" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                      <label>Retype Password</label>
                                      <input type="password" class="form-control" id="password_again" name="txtrepassword" placeholder="Password">
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="inputFile" accept="image/*" onchange="loadFile(event)">
                                        <label class="custom-file-label" for="exampleInputFile">Profile Pict</label>
                                      </div>  
                                      
                                        <img id="output" width="100" height="100" alt="Your Profile" />
                                        <script>
                                          var loadFile = function(event) {
                                            var output = document.getElementById('output');
                                            output.src = URL.createObjectURL(event.target.files[0]);
                                            output.onload = function() {
                                              URL.revokeObjectURL(output.src) // free memory
                                            }
                                            $("#output").show();
                                          };
                                        </script>
                                    </div>
                                </div>              
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <a href="#" class="btn btn-secondary">Cancel</a>
                          <input type="submit" value="Save" class="btn btn-success float-right">
                        </div>
                      </div>
                    </form>
                  </section>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
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


    <script >
  $(document).ready(function(){
    $("#output").hide();

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
      txtpassword: {
        required: false
      },
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

<script>
  $(function () {
    bsCustomFileInput.init();
  });
</script>
@endsection