@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Lead</h1>
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
                <h3 class="card-title">Lead Form</h3>
              </div>
              <form id="quickForm" action="{{route('LeadStore')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body p-0">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="bs-stepper">

                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">Main Contact</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    
                  </div>
                  <div class="bs-stepper-content">
                    
                    <!-- your steps content here -->  
                    <div class="row">
                      <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                          <label>Contact Person</label>
                          <input type="text" class="form-control" name="txtMainContactPerson" placeholder="Enter ...">
                        </div>                        
                      </div>  
                      <div class="col-sm-4">
                          <div class="form-group">
                            <label>Lead Source</label>
                            <select class="form-control select2" name="cmbLeadSourceId" style="width: 100%;">
                               @foreach($leadsources as $leadsource)
                                  <option value="{{$leadsource->id}}">{{$leadsource->description}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div> 
                    </div>                    
                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" class="form-control" name="txtMainContactNo" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="txtMainEmail" placeholder="Enter ...">
                          </div>
                        </div>
                      </div>   

                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <div class="icheck-primary d-inline">
                              <input type="checkbox" id="chkIsPatient" name="chkIsPatient" >
                              <label for="chkIsPatient">Is Patient
                              </label>
                            </div>
                          </div>
                          </div>
                          </div>                 
                  </div>

                  
                  <div class="bs-stepper-header" role="tablist">
                    <!-- your steps here -->
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">Wife</span>
                      </button>
                    </div>
                    <div class="line"></div>
                    
                  </div>
                  <div class="bs-stepper-content">
                    
                    <!-- your steps content here -->  

                    <div class="row"> 
                      <div class="col-sm-4">
                        <div class="form-group">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" id="IsWifePatient" name="IsWifePatient">
                            <label for="IsWifePatient">Patient
                            </label>
                          </div>
                        </div>
                      </div> 
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>File No</label>
                            <input type="text" class="form-control" name="txtFileNo" placeholder="Enter ...">
                          </div>
                        </div>
                    </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="txtWifeName" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="txtWifeLastName" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Birth Date</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="date" id="WifeDateofBirth" onChange = "ageCalculator()" class="form-control" name="WifeDateofBirth"/>
                                <!-- <div class="input-group-append" data-target="#birthdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div> -->
                            </div>
                            <!-- <div class="input-group date" id="birthdate" data-target-input="nearest">
                                <input type="text" id="WifeDateofBirth" onChange = "ageCalculator()" class="form-control datetimepicker-input" name="WifeDateofBirth" data-target="#birthdate"/>
                                <div class="input-group-append" data-target="#birthdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div> -->
                          </div>
                        </div>
                        <div class="col-sm-1">
                          <div class="form-group">
                            <label>Age</label>
                            <div class="input-group date">
                                <input type="text" id="w_age"  class="form-control"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Date of Marriage</label>
                            <div class="input-group date"  data-target-input="nearest">
                              <input type="date" class="form-control" id="marrieddate" onchange="MarriedSinceCalc()"  name="txtWifeMarriedSince"/>
                                <!-- <div class="input-group-append" data-target="#marrieddate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div> -->
                                <!-- <input type="text" class="form-control datetimepicker-input" name="txtWifeMarriedSince" data-target="#marrieddate"/>
                                <div class="input-group-append" data-target="#marrieddate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div> -->
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-1">
                          <div class="form-group">
                            <label>Married Since</label>
                            <div class="input-group date"  data-target-input="nearest">
                                <input type="text" class="form-control" id="marriedsince" name="">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="txtWifeAddress" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="WifeEmailAddress" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" class="form-control" name="WifeContactNo" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Nationality</label>
                            <select class="form-control select2" name="cmbWifeNationality" style="width: 100%;">
                               @foreach($nationalities as $nationality)
                                  <option value="{{$nationality->id}}">{{$nationality->description}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <div class="icheck-primary d-inline">
                              <input type="checkbox" id="checkboxPrimary1" name="chkIVFBefore" >
                              <label for="checkboxPrimary1">IVF Before
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="icheck-primary d-inline">
                              <input type="checkbox" id="checkboxPrimary2" name="chkHasChildren" >
                              <label for="checkboxPrimary2">Has Children
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="icheck-primary d-inline">
                              <input type="checkbox" id="checkboxPrimary3" name="chkMiscarriage">
                              <label for="checkboxPrimary3">Miscarriage
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                  </div>

                  <!-- Husband -->
                  <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">3</span>
                        <span class="bs-stepper-label">Husband</span>
                      </button>
                    </div>
                    <div class="line"></div>
                  </div>

                  <div class="bs-stepper-content">

                    <!-- your steps content here -->   
                    <div class="row"> 
                      <div class="col-sm-4">
                        <div class="form-group">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" id="IsHusbandPatient" name="IsHusbandPatient">
                            <label for="IsHusbandPatient">Patient
                            </label>
                          </div>
                        </div>
                      </div> 
                    </div>

                      <div class="row">

                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="txtHusbandName" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="txtHusbandLastName" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Birth Date</label>
                            <div class="input-group date" data-target-input="nearest">
                                <input type="date" class="form-control" id="husbandbirthdate" onchange="HusbandAge()" name="txtHusbandBirthDate" />
                                
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-1">
                          <div class="form-group">
                            <label>Age</label>
                            <div class="input-group date"  data-target-input="nearest">
                                <input type="text" class="form-control" id="h_age" name="">
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Nationality</label>
                            <select class="form-control select2" name="cmbHusbandNationality" style="width: 100%;">
                               @foreach($nationalities as $nationality)
                                  <option value="{{$nationality->id}}">{{$nationality->description}}</option>
                                @endforeach
                            </select>                            
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" name="txtHusbandAddress" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="txtHusbandEmailAddress" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" class="form-control" name="txtHusbandContactNo" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            
                          </div>
                        </div>
                      </div> 

                      <!-- <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="customFile" name="inputFile">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                          </div>
                          <div class="form-group">
                          </div>
                        </div>
                        
                      </div> -->                    
                    
                  </div>

                  <!-- Note -->
                  <div class="bs-stepper-header" role="tablist">
                    <div class="step" data-target="#logins-part">
                      <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                        <span class="bs-stepper-circle">4</span>
                        <span class="bs-stepper-label">Note</span>
                      </button>
                    </div>
                    <div class="line"></div>
                  </div>

                  <div class="bs-stepper-content">

                    <!-- your steps content here -->                      
                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Note</label>
                            <textarea id="inputNote" name="txtnote" class="form-control" rows="4"></textarea>
                          </div>
                        </div>
                      </div>

                    <div class="row">
                      <div class="col-sm-4">
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
                    </div>
                    
                    </div>

              
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-12">
                    <a href="{{route('LeadIndex')}}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save" class="btn btn-success float-right">
                  </div>
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

 <script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function (form) {
      // alert( "Form successful submitted!" );
       form.submit();
    }
  });
  $('#quickForm').validate({
    rules: {
      txtMainContactNo: {
        required: true
      },
      txtMainContactPerson: {
        required: true
      },
    },
    messages: {
      
      txtMainContactPerson: {
        required: "Please provide the contact person."
      },
      txtMainContactNo: "Please provide the contact number."
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

<script type="text/javascript">
  function ageCalculator() {
      var userinput = document.getElementById("WifeDateofBirth").value;
      var dob = new Date(userinput);
      if(userinput==null || userinput=='') {
        alert("**Choose a date please!");  
        return false; 
      } else {
      
      //calculate month difference from current date in time
      var month_diff = Date.now() - dob.getTime();
      
      //convert the calculated difference in date format
      var age_dt = new Date(month_diff); 
      
      //extract year from date    
      var year = age_dt.getUTCFullYear();
      
      //now calculate the age of the user
      var age = Math.abs(year - 1970);
      
      //display the calculated age
         // alert("Age is: " + age + " years. ");
         document.getElementById('w_age').value = age;
      }
  }

  function MarriedSinceCalc() {
      var userinput = document.getElementById("marrieddate").value;
      var dob = new Date(userinput);
      if(userinput==null || userinput=='') {
        alert("**Choose a date please!");  
        return false; 
      } else {
      
      //calculate month difference from current date in time
      var month_diff = Date.now() - dob.getTime();
      
      //convert the calculated difference in date format
      var age_dt = new Date(month_diff); 
      
      //extract year from date    
      var year = age_dt.getUTCFullYear();
      
      //now calculate the age of the user
      var age = Math.abs(year - 1970);
      
      //display the calculated age
         // alert("Age is: " + age + " years. ");
         document.getElementById('marriedsince').value = age + "yr(s)";
      }
  }

  function HusbandAge() {
      var userinput = document.getElementById("husbandbirthdate").value;
      var dob = new Date(userinput);
      if(userinput==null || userinput=='') {
        alert("**Choose a date please!");  
        return false; 
      } else {
      
      //calculate month difference from current date in time
      var month_diff = Date.now() - dob.getTime();
      
      //convert the calculated difference in date format
      var age_dt = new Date(month_diff); 
      
      //extract year from date    
      var year = age_dt.getUTCFullYear();
      
      //now calculate the age of the user
      var age = Math.abs(year - 1970);
      
      //display the calculated age
         // alert("Age is: " + age + " years. ");
         document.getElementById('h_age').value = age;
      }
  }
</script>
@endsection