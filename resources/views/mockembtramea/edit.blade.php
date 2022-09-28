@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1>Invoice</h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php
      $strMainContactPerson ="";
      $strMainContactNo="";
      $strMainEmail="";
      $intPatientId=0;
      $strPatientName="";
      ?>
      @foreach($patients as $patient)
      <?php
        $strMainContactPerson = $patient->MainContactPerson;
        $strMainContactNo = $patient->MainContactNo;
        $strMainEmail = $patient->MainEmail;
        $intPatientId=$patient->id;

        if($patient->IsHusbandPatient==1)
        {
          $strPatientName=$patient->HusbandName.' '.$patient->HusbandLastName;
        }
        else
        {
          $strPatientName= $patient->WifeName.' '.$patient->WifeLastName; 
        }

      ?>
    <section class="content"> 
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Application buttons -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <div class="card-body">               
                <!-- <p>Application Buttons with Custom Colors</p> -->
                <a href="{{route('LeadView')}}/{{$intPatientId}}" class="btn btn-app bg-secondary">                  
                  <i class="fas fa-user-plus"></i> Info
                </a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">          


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <!-- <i class="fas fa-user"></i> Patient Profile -->
                    <!-- <small class="float-right">Date: 2/10/2014</small> -->
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->              
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  Main Contact
                  <address>
                  <strong>{{$strMainContactPerson}}</strong><br>
                    Email: {{$strMainEmail}}<br>
                    Contact No: {{$strMainContactNo}}<br>
                    Lead Source: {{$patient->LeadSource}}<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  Wife
                  <address>
                    <strong>{{$patient->WifeName}}&nbsp{{$patient->WifeLastName}}</strong><br>
                    Birth Date:{{$patient->WifeBirthDate}}<br>
                    Married Since:{{$patient->MarriedSince}}<br>
                    Contact No: {{$patient->WifeContactNo}}<br>
                    Nationality: {{$patient->WifeNationality}}<br>
                    Address: {{$patient->WifeAddress}}<br>
                    Email: {{$patient->WifeEmailAddress}}<br>
                    <div class="form-group">
                      @if($patient->IsIVF=='on')
                      <input type="checkbox" id="checkboxPrimary1" checked>
                      @else
                      <input type="checkbox" id="checkboxPrimary1" >
                      @endif
                      <label for="checkboxPrimary1">IVF Before
                      </label>
                      @if($patient->IsHasChildren=='on')
                      <input type="checkbox" id="checkboxPrimary2" checked>
                      @else
                      <input type="checkbox" id="checkboxPrimary2" >
                      @endif
                      <label for="checkboxPrimary2">Has Children
                      </label>
                      @if($patient->IsMiscarriage=='on')
                      <input type="checkbox" id="checkboxPrimary3" checked>
                      @else
                      <input type="checkbox" id="checkboxPrimary3" >
                      @endif
                      <label for="checkboxPrimary3">Miscarriage
                      </label>
                  </div>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  Husband
                  <address>
                    <strong>{{$patient->HusbandName}}&nbsp{{$patient->HusbandLastName}}</strong><br>
                    Birth Date: {{$patient->HusbandBirthDate}}<br>
                    Contact No: {{$patient->HusbandContactNo}}<br>
                    Nationality: {{$patient->HusbandNationality}}<br>
                    Address: {{$patient->HusbandAddress}}<br>
                    Email: {{$patient->HusbandEmailAddress}}<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                  <b>Profile No:{{$patient->FileNo}}</b><br>
                  <br>
                  <b>NOTE:</b> {{$patient->Notes}}<br>
                </div>
                <!-- /.col -->
              </div>
              @endforeach
              <!-- /.row -->
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <section class="content">
    <?php 
      $ImageUtPoImage=""; 
      $ImageUtPoCaOr=""; 
    ?>
    @foreach($docresults as $docresult)
    <?php 
      $ImageUtPoImage=$docresult->UtPoImage; 
      $ImageUtPoCaOr=$docresult->UtPoCaOr;
    ?>
   <form action="{{route('MocEmbTraMeasUpdate')}}" method="POST" enctype="multipart/form-data" class="needs-validation add-product-form" id="quickForm" novalidate="">
        {{ csrf_field() }}
      <input type="hidden" name="txtpatientId" value="{{$intPatientId}}">
      <input type="hidden" name="docId" value="{{$docresult->id}}">
      <input type="hidden" name="UtPoImage" id="UtPoImage" value="0">
      <input type="hidden" name="UtPoCaOr" id="UtPoCaOr" value="0">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-header">
              <h3 class="card-title">Mock Embryo Transfer Measurement</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

              <div class="form-group row">                
                <div class="col-md-2">
                  <label for="docdate" class="col-form-label">Date</label>
                  <input type="date" class="form-control" id="docdate" name="docdate" value="{{$docresult->docdate}}" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsWalEasy==1)
                      <input type="checkbox" name="IsWalEasy" id="IsWalEasy" checked>
                      @else
                      <input type="checkbox" name="IsWalEasy" id="IsWalEasy">
                      @endif
                      <label for="IsWalEasy">
                        Easy
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsWalDiff==1)
                      <input type="checkbox" name="IsWalDiff" id="IsWalDiff" checked>
                      @else
                      <input type="checkbox" name="IsWalDiff" id="IsWalDiff">
                      @endif
                      <label for="IsWalDiff">
                        Difference
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsWalWIntr==1)
                      <input type="checkbox" name="IsWalWIntr" id="IsWalWIntr" checked>
                      @else
                      <input type="checkbox" name="IsWalWIntr" id="IsWalWIntr">
                      @endif
                      <label for="IsWalWIntr">
                        With Introducer
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsWalMeCaNe==1)
                      <input type="checkbox" name="IsWalMeCaNe" id="IsWalMeCaNe" checked>
                      @else
                      <input type="checkbox" name="IsWalMeCaNe" id="IsWalMeCaNe">
                      @endif
                      <label for="IsWalMeCaNe">
                        Metal  Cannula needed
                      </label>
                    </div>                   
                  </div>
                  <div class="form-group">
                    <div class="icheck-success d-inline">
                      @if($docresult->IsWalTenN==1)
                      <input type="checkbox" name="IsWalTenN" id="IsWalTenN" checked>
                      @else
                      <input type="checkbox" name="IsWalTenN" id="IsWalTenN">
                      @endif
                      <label for="IsWalTenN">
                        Tennaculum needed
                      </label>
                    </div>                   
                  </div>
                </div>
              </div>

              <div class="row">                
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="Comments" class="col-form-label">Comments</label>
                    <textarea id="Comments" name="Comments" class="form-control" rows="4">{{$docresult->Comments}}</textarea>
                  </div>                  
                </div>             
              </div>

              <div class="row">                
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="UtMea" class="col-form-label">Uterus Measurement</label>
                    <input type="number" class="form-control" id="UtMea" name="UtMea" placeholder="mm" value="{{$docresult->UtMea}}">  
                  </div>                  
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <h3>Utirine Position</h3>
                  <div class="form-group">
                      <div class="icheck-success d-inline">
                        @if($docresult->IsUtPoAnteflex==1)
                        <input type="checkbox" name="IsUtPoAnteflex" id="IsUtPoAnteflex" checked>
                        @else
                        <input type="checkbox" name="IsUtPoAnteflex" id="IsUtPoAnteflex">
                        @endif
                        <label for="IsUtPoAnteflex">
                          Anteflex
                        </label>
                      </div>  
                      <div class="icheck-success d-inline">
                        @if($docresult->IsUtPoAnteverted==1)
                        <input type="checkbox" name="IsUtPoAnteverted" id="IsUtPoAnteverted" checked>
                        @else
                        <input type="checkbox" name="IsUtPoAnteverted" id="IsUtPoAnteverted">
                        @endif
                        <label for="IsUtPoAnteverted">
                          Anteverted
                        </label>
                      </div> 
                      <div class="icheck-success d-inline">
                        @if($docresult->IsUtPoAxial==1)
                        <input type="checkbox" name="IsUtPoAxial" id="IsUtPoAxial" checked>
                        @else
                        <input type="checkbox" name="IsUtPoAxial" id="IsUtPoAxial">
                        @endif
                        <label for="IsUtPoAxial">
                          Axial
                        </label>
                      </div>  
                      <div class="icheck-success d-inline">
                        @if($docresult->IsUtPoRetroverted==1)
                        <input type="checkbox" name="IsUtPoRetroverted" id="IsUtPoRetroverted" checked>
                        @else
                        <input type="checkbox" name="IsUtPoRetroverted" id="IsUtPoRetroverted">
                        @endif
                        <label for="IsUtPoRetroverted">
                          Retroverted
                        </label>
                      </div> 
                  </div>
                  <div class="form-group">                    
                    <div class="tools">
                      Tools:
                        <a id="tool-pencil">Pencil</a>
                          |
                        <a id="tool-eraser">Eraser</a>
                          |
                        <a id="tool-text">Text</a>                                            
                          |
                        <a id="tool-clear">Clear</a>                                                                                          
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="colors">
                        Color:
                          <a id="colorTool-black">Black</a>
                            |
                          <a id="colorTool-blue">Blue</a>
                            |
                          <a id="colorTool-red">Red</a>
                      </div>
                  </div>
                  <div class="literally core"></div>
                </div>  
                <div class="col-sm-6">            
                  <h3>Catheter Orientation</h3>
                  <div class="form-group"> 
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr1==1)
                      <input type="checkbox" name="IsCaOr1" id="IsCaOr1" checked>
                      @else
                      <input type="checkbox" name="IsCaOr1" id="IsCaOr1">
                      @endif
                      <label for="IsCaOr1">
                        1
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr2==1)
                      <input type="checkbox" name="IsCaOr2" id="IsCaOr2" checked>
                      @else
                      <input type="checkbox" name="IsCaOr2" id="IsCaOr2">
                      @endif
                      <label for="IsCaOr2">
                        2
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr3==1)
                      <input type="checkbox" name="IsCaOr3" id="IsCaOr3" checked>
                      @else
                      <input type="checkbox" name="IsCaOr3" id="IsCaOr3">
                      @endif
                      <label for="IsCaOr3">
                        3
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr4==1)
                      <input type="checkbox" name="IsCaOr4" id="IsCaOr4" checked>
                      @else
                      <input type="checkbox" name="IsCaOr4" id="IsCaOr4">
                      @endif
                      <label for="IsCaOr4">
                        4
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr5==1)
                      <input type="checkbox" name="IsCaOr5" id="IsCaOr5" checked>
                      @else
                      <input type="checkbox" name="IsCaOr5" id="IsCaOr5">
                      @endif
                      <label for="IsCaOr5">
                        5
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr6==1)
                      <input type="checkbox" name="IsCaOr6" id="IsCaOr6" checked>
                      @else
                      <input type="checkbox" name="IsCaOr6" id="IsCaOr6">
                      @endif
                      <label for="IsCaOr6">
                        6
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr7==1)
                      <input type="checkbox" name="IsCaOr7" id="IsCaOr7" checked>
                      @else
                      <input type="checkbox" name="IsCaOr7" id="IsCaOr7">
                      @endif
                      <label for="IsCaOr7">
                        7
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr8==1)
                      <input type="checkbox" name="IsCaOr8" id="IsCaOr8" checked>
                      @else
                      <input type="checkbox" name="IsCaOr8" id="IsCaOr8">
                      @endif
                      <label for="IsCaOr8">
                        8
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr9==1)
                      <input type="checkbox" name="IsCaOr9" id="IsCaOr9" checked>
                      @else
                      <input type="checkbox" name="IsCaOr9" id="IsCaOr9">
                      @endif
                      <label for="IsCaOr9">
                        9
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr10==1)
                      <input type="checkbox" name="IsCaOr10" id="IsCaOr10" checked>
                      @else
                      <input type="checkbox" name="IsCaOr10" id="IsCaOr10">
                      @endif
                      <label for="IsCaOr10">
                        10
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr11==1)
                      <input type="checkbox" name="IsCaOr11" id="IsCaOr11" checked>
                      @else
                      <input type="checkbox" name="IsCaOr11" id="IsCaOr11">
                      @endif
                      <label for="IsCaOr11">
                        11
                      </label>
                    </div>
                    <div class="icheck-success d-inline">
                      @if($docresult->IsCaOr12==1)
                      <input type="checkbox" name="IsCaOr12" id="IsCaOr12" checked>
                      @else
                      <input type="checkbox" name="IsCaOr12" id="IsCaOr12">
                      @endif
                      <label for="IsCaOr12">
                        12
                      </label>
                    </div>
                  </div>
                  <div class="form-group">                    
                    <div class="toolsc">
                      Tools:
                        <a id="tool-pencil-c">Pencil</a>
                          |
                        <a id="tool-eraser-c">Eraser</a>
                          |
                        <a id="tool-text-c">Text</a>                                            
                          |
                        <a id="tool-clear-c">Clear</a>                                            
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="colorsc">
                        Color:
                          <a id="colorTool-black-c">Black</a>
                            |
                          <a id="colorTool-blue-c">Blue</a>
                            |
                          <a id="colorTool-red-c">Red</a>
                      </div>
                  </div>
                  <div class="literally core-c"></div>
                </div> 
              </div>           

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="exampleInputFile">File</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="inputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <a href="{{route('MocEmbTraMeas')}}/{{$intPatientId}}" class="btn btn-secondary">Cancel</a>
                  <button type="submit" class="btn btn-success float-right" id="tool-save">Save</button> 
                </div>
              </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      

    </form>
    @endforeach
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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

<script src="{{asset('js/literallycanvas-core.js')}}" type="text/javascript"></script>

 <script type="text/javascript">
    $(function () { 
       //Date picker
    $('#lead-date').datetimepicker({
        format: 'L'
    });

    $('#lead-date-update').datetimepicker({
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
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

<script>


    
  $(document).ready(function(){

    var MainUrl = <?php echo "'".url('/')."/".$ImageUtPoCaOr."'"; ?>;
    
    var ImageBackgroundc = MainUrl;
    var backgroundImagec = new Image()  
    backgroundImagec.src = ImageBackgroundc;
    var strokeWidths;
    var colors;
    var setCurrentByName;
    var colorsc;
    var setCurrentByNamec;

    
      
      var lcc = LC.init(
        document.getElementsByClassName('core-c')[0],
        {
            
          backgroundShapes: [
            LC.createShape(
              'Image', {x: 1, y: 1, image: backgroundImagec, scale:1})
          ],
          defaultStrokeWidth: 2,      
        }

        );
      
      
    <!-- custom UI ... -->
    var toolsc = [
      {
        name: 'pencil-c',
        el: document.getElementById('tool-pencil-c'),
        tool: new LC.tools.Pencil(lcc)
      },
      {
        name: 'eraser-c',
        el: document.getElementById('tool-eraser-c'),
        tool: new LC.tools.Eraser(lcc)
      },
      {
        name: 'text-c',
        el: document.getElementById('tool-text-c'),
        tool: new LC.tools.Text(lcc)
      }
    ];
    colorsc = [
          {
            name: 'black-c',
            el: document.getElementById('colorTool-black-c'),
            color: '#000000'
          },{
            name: 'blue-c',
            el: document.getElementById('colorTool-blue-c'),
            color: '#0000ff'
          },{
            name: 'red-c',
            el: document.getElementById('colorTool-red-c'),
            color: '#ff0000'
          }
        ];

        setCurrentByNamec = function(ary, val) {
          ary.forEach(function(i) {
            $(i.el).toggleClass('current', (i.name == val));
          });
        };

    // Wire Colors
        colorsc.forEach(function(clr) {
          $(clr.el).click(function() {
            lcc.setColor('primary', clr.color)
            setCurrentByNamec(colorsc, clr.name);
          })
        })
        setCurrentByNamec(colorsc, colorsc[0].name);


    var activateToolc = function(t) {
        lcc.setTool(t.tool);
        toolsc.forEach(function(t2) {
          if (t == t2) {
            t2.el.style.backgroundColor = 'yellow';
          } else {
            t2.el.style.backgroundColor = 'transparent';
          }
        });
    }

    var activateColorc = function(t) {
        lcc.setColor(t.color);

        colorsc.forEach(function(t2) {
          if (t == t2) {
            t2.el.style.backgroundColor = 'yellow';
          } else {
            t2.el.style.backgroundColor = 'transparent';
          }
        });
    }

    toolsc.forEach(function(t) {
      t.el.style.cursor = "pointer";
      t.el.onclick = function(e) {
        e.preventDefault();
        activateToolc(t);
      };
    });
    activateToolc(toolsc[0]);

    colorsc.forEach(function(t) {
      t.el.style.cursor = "pointer";
      t.el.onclick = function(e) {
        e.preventDefault();
        activateColorc(t);
      };
    });
    activateColorc(colorsc[0]);
      
        
    $("#tool-clear-c").click(function (e) {
      lcc.clear();
    });



    var MainUrl = <?php echo "'".url('/')."/".$ImageUtPoImage."'"; ?>;
    
    var ImageBackground = MainUrl;
    var backgroundImage = new Image()  
    backgroundImage.src = ImageBackground;

      
      var lc = LC.init(
        document.getElementsByClassName('core')[0],
        {
            
          backgroundShapes: [
            LC.createShape(
              'Image', {x: 1, y: 1, image: backgroundImage, scale:1})
          ],
          defaultStrokeWidth: 2,      
        }

        );

      
    <!-- custom UI ... -->
    var tools = [
      {
        name: 'pencil',
        el: document.getElementById('tool-pencil'),
        tool: new LC.tools.Pencil(lc)
      },
      {
        name: 'eraser',
        el: document.getElementById('tool-eraser'),
        tool: new LC.tools.Eraser(lc)
      },
      {
        name: 'text',
        el: document.getElementById('tool-text'),
        tool: new LC.tools.Text(lc)
      }
    ];
    
    strokeWidths = [
          {
            name: 10,
            el: document.getElementById('sizeTool-1'),
            size: 10
          },{
            name: 20,
            el: document.getElementById('sizeTool-2'),
            size: 20
          },{
            name: 50,
            el: document.getElementById('sizeTool-3'),
            size: 50
          }
        ];
    colors = [
          {
            name: 'black',
            el: document.getElementById('colorTool-black'),
            color: '#000000'
          },{
            name: 'blue',
            el: document.getElementById('colorTool-blue'),
            color: '#0000ff'
          },{
            name: 'red',
            el: document.getElementById('colorTool-red'),
            color: '#ff0000'
          }
        ];

        setCurrentByName = function(ary, val) {
          ary.forEach(function(i) {
            $(i.el).toggleClass('current', (i.name == val));
          });
        };

    // Wire Colors
        colors.forEach(function(clr) {
          $(clr.el).click(function() {
            lc.setColor('primary', clr.color)
            setCurrentByName(colors, clr.name);
          })
        })
        setCurrentByName(colors, colors[0].name);


    var activateTool = function(t) {
        lc.setTool(t.tool);

        tools.forEach(function(t2) {
          if (t == t2) {
            t2.el.style.backgroundColor = 'yellow';
          } else {
            t2.el.style.backgroundColor = 'transparent';
          }
        });
    }

    var activateColor = function(t) {
        lc.setColor(t.color);

        colors.forEach(function(t2) {
          if (t == t2) {
            t2.el.style.backgroundColor = 'yellow';
          } else {
            t2.el.style.backgroundColor = 'transparent';
          }
        });
    }

    tools.forEach(function(t) {
      t.el.style.cursor = "pointer";
      t.el.onclick = function(e) {
        e.preventDefault();
        activateTool(t);
      };
    });
    activateTool(tools[0]);

    colors.forEach(function(t) {
      t.el.style.cursor = "pointer";
      t.el.onclick = function(e) {
        e.preventDefault();
        activateColor(t);
      };
    });
    activateColor(colors[0]);
      
        
    $("#tool-clear").click(function (e) {
      lc.clear();
    });

    $("#tool-save").click(function (e) {
      $("#UtPoImage").val(lc.getImage({scale: 1, margin: {top: 10, right: 10, bottom: 10, left: 10}}).toDataURL());
      $("#UtPoCaOr").val(lcc.getImage({scale: 1, margin: {top: 10, right: 10, bottom: 10, left: 10}}).toDataURL());
    });

  });
</script>


@endsection