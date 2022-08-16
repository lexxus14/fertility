@extends('layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Lead</h1>
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
              <form id="quickForm" action="{{route('LeadUpdate')}}" method="POST" enctype="multipart/form-data">
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
                  <?php $intPatientId=0; ?>
                @foreach($patients as $patient)
                <input type="hidden" name="txtpatientId" value="{{$patient->id}}">
                <?php $intPatientId= $patient->id; ?>
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
                            <input type="text" class="form-control" name="txtMainContactPerson" value="{{$patient->MainContactPerson}}" placeholder="Enter ...">
                          </div>
                      </div>
                      <div class="col-sm-4">
                          <div class="form-group">
                            <label>Lead Source</label>
                            <select class="form-control select2" name="cmbLeadSourceId" style="width: 100%;">
                               @foreach($leadsources as $leadsource)
                                @if($leadsource->id == $patient->LeadSourceId)
                                  <option value="{{$leadsource->id}}" selected>{{$leadsource->description}}</option>
                                @else
                                  <option value="{{$leadsource->id}}">{{$leadsource->description}}</option>
                                @endif
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
                            <input type="text" class="form-control" name="txtMainContactNo" value="{{$patient->MainContactNo}}" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="txtMainEmail" value="{{$patient->MainEmail}}" placeholder="Enter ...">
                          </div>
                        </div>
                      </div>   
                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <div class="icheck-primary d-inline">
                              @if($patient->IsPatient==0)
                              <input type="checkbox" id="chkIsPatient" name="chkIsPatient" >
                              @else
                              <input type="checkbox" id="chkIsPatient" name="chkIsPatient" checked>
                              @endif
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
                          <!-- text input -->
                          <div class="form-group">
                            <label>File No</label>
                            <input type="text" class="form-control" name="txtFileNo" value="{{$patient->FileNo}}" placeholder="Enter ...">
                          </div>
                        </div>
                    </div>                    
                      <div class="row">
                        <div class="col-sm-4">
                          <!-- text input -->
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="txtWifeName" value="{{$patient->WifeName}}" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="txtWifeLastName" value="{{$patient->WifeLastName}}" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Birth Date</label>
                            <div class="input-group date" id="birthdate" data-target-input="nearest">
                                <input type="text" id ="WifeDateofBirth" class="form-control datetimepicker-input" name="WifeDateofBirth" data-target="#birthdate"/>

                                <script>
                                const d = new Date("{{$patient->WifeBirthDate}}");
                                let text = d.toLocaleString();
                                document.getElementById("WifeDateofBirth").value = text;
                                </script>

                                <div class="input-group-append" data-target="#birthdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Married Since</label>
                            <div class="input-group date" id="marrieddate" data-target-input="nearest">
                                <input type="text" id="txtWifeMarriedSince" class="form-control datetimepicker-input" name="txtWifeMarriedSince" data-target="#marrieddate"/>

                                <script>
                                const d1 = new Date("{{$patient->MarriedSince}}");
                                let text1 = d1.toLocaleString();
                                document.getElementById("txtWifeMarriedSince").value = text1;
                                </script>

                                <div class="input-group-append" data-target="#marrieddate" data-toggle="datetimepicker">
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
                            <label>Address</label>
                            <input type="text" class="form-control" name="txtWifeAddress" value="{{$patient->WifeAddress}}" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="WifeEmailAddress" value="{{$patient->WifeEmailAddress}}" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" class="form-control" name="WifeContactNo" value="{{$patient->WifeContactNo}}" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Nationality</label>
                            <select class="form-control select2" name="cmbWifeNationality" style="width: 100%;">
                               @foreach($nationalities as $nationality)
                                  @if($nationality->id == $patient->WifeNationalityId)
                                  <option value="{{$nationality->id}}" selected>{{$nationality->description}}</option>
                                  @else
                                  <option value="{{$nationality->id}}">{{$nationality->description}}</option>
                                  @endif
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
                              @if($patient->IsIVF=='on')
                              <input type="checkbox" id="checkboxPrimary1" name="chkIVFBefore" checked>
                              @else
                              <input type="checkbox" id="checkboxPrimary1" name="chkIVFBefore" >
                              @endif
                              <label for="checkboxPrimary1">IVF Before
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="icheck-primary d-inline">
                              @if($patient->IsHasChildren=='on')
                              <input type="checkbox" id="checkboxPrimary2" name="chkHasChildren" checked>
                              @else
                              <input type="checkbox" id="checkboxPrimary2" name="chkHasChildren" >
                              @endif
                              <label for="checkboxPrimary2">Has Children
                              </label>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="icheck-primary d-inline">
                              @if($patient->IsMiscarriage=='on')
                              <input type="checkbox" id="checkboxPrimary3" name="chkMiscarriage" checked>
                              @else
                              <input type="checkbox" id="checkboxPrimary3" name="chkMiscarriage">
                              @endif
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
                          <!-- text input -->
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="txtHusbandName" value="{{$patient->HusbandName}}" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="txtHusbandLastName" value="{{$patient->HusbandLastName}}" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Birth Date</label>
                            <div class="input-group date" id="husbandbirthdate" data-target-input="nearest">
                                <input type="text" id="txtHusbandBirthDate" class="form-control datetimepicker-input" name="txtHusbandBirthDate" data-target="#husbandbirthdate"/>

                                <script>
                                const d2 = new Date("{{$patient->HusbandBirthDate}}");
                                let text2 = d2.toLocaleString();
                                document.getElementById("txtHusbandBirthDate").value = text2;
                                </script>

                                <div class="input-group-append" data-target="#husbandbirthdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Nationality</label>
                            <select class="form-control select2" name="cmbHusbandNationality" style="width: 100%;">
                               @foreach($nationalities as $nationality)
                                @if($nationality->id == $patient->HusbandNationalityId)
                                  <option value="{{$nationality->id}}" selected>{{$nationality->description}}</option>
                                @else
                                  <option value="{{$nationality->id}}">{{$nationality->description}}</option>
                                @endif
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
                            <input type="text" class="form-control" name="txtHusbandAddress" value="{{$patient->HusbandAddress}}" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control" name="txtHusbandEmailAddress" value="{{$patient->HusbandEmailAddress}}" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" class="form-control" name="txtHusbandContactNo" value="{{$patient->HusbandContactNo}}" placeholder="Enter ...">
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
                            <textarea id="inputNote" name="txtnote" class="form-control" rows="4">{{$patient->Notes}}</textarea>
                          </div>
                        </div>
                      </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="exampleInputFile">Attach File:</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile" name="inputFile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>                            
                          </div>
                          <br>
                          <p>FILE:{{$patient->FileLink}} </p>
                          <p>NOTE: If you attach new file the old file will be deleted.</p>                          
                        </div>
                      </div>
                    </div>
                    
                  </div>

              
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-12">
                    <a href="{{route('LeadView')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save" class="btn btn-success float-right">
                  </div>
                </div> 
              </div>
            </div>
            @endforeach
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