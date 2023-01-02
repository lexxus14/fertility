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
                <a href="{{route('PatientBookingIndex')}}/{{$intPatientId}}" class="btn btn-app bg-warning">
                  <span class="badge bg-teal">
                    <?php
                      $intTotalPatientResult =0;
                    ?>
                    @foreach($TotalPatientResults as $TotalPatientResult)
                    <?php
                      $intTotalPatientResult =$TotalPatientResult->TotalPatientResult;
                    ?>
                    @endforeach
                    {{$intTotalPatientResult}}</span>
                  <i class="fas fa-pencil-alt"></i> Patient Booking
                </a>
                <a href="{{route('PatientDocument')}}/{{$intPatientId}}" class="btn btn-app bg-secondary">
                  <span class="badge bg-success">
                     @foreach($TotalRecDocs as $TotalRecDoc)
                      <?php
                        $intTotalRecDoc = $TotalRecDoc->TotalRecDoc;
                      ?>
                    @endforeach
                    {{$intTotalRecDoc}}
                  </span>
                  <i class="fas fa-folder"></i> Documents
                </a>
                <a href="{{route('PatientDoctorNotes')}}/{{$intPatientId}}" class="btn btn-app bg-danger">
                  <span class="badge bg-teal">
                    @foreach($TotalRecDocNotes as $TotalRecDocNote)
                    <?php
                      $intTotalRecDocNote = $TotalRecDocNote->TotalRecDocNote;
                      ?>
                    @endforeach
                    {{$intTotalRecDocNote}}
                  </span>
                  <i class="fas fa-inbox"></i> Doc Notes
                </a>
                <a href="{{route('PatientLab')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-purple">
                    @foreach($TotalRecLabs as $TotalRecLab)
                    <?php
                      $intTotalRecLab = $TotalRecLab->TotalRecLab;
                      ?>
                    @endforeach
                    {{$intTotalRecLab}}
                  </span>
                  <i class="fas fa-flask"></i> Laboratory
                </a>
                
                <a href="{{route('PatientHistory')}}/{{$intPatientId}}" class="btn btn-app bg-warning">
                  <span class="badge bg-info">
                    @foreach($TotalRecHisAssessments as $TotalRecHisAssessment)
                    <?php
                      $intTotalRecHisAssessment = $TotalRecHisAssessment->TotalRecHisAssessment;
                      ?>
                    @endforeach
                    {{$intTotalRecHisAssessment}}</span>
                  <i class="fas fa-user-clock"></i> History Assessment
                </a>
<!--                 <a href="{{route('PatientPathologyXray')}}/{{$intPatientId}}" class="btn btn-app bg-info">
                  <span class="badge bg-danger">
                    @foreach($TotalPathXrays as $TotalPathXray)
                    <?php
                      $intTotalPathXray = $TotalPathXray->TotalPathXray;
                      ?>
                    @endforeach
                    {{$intTotalPathXray}}
                  </span>
                  <i class="fas fa-microscope"></i>Pathology/X Ray
                </a> -->
                <a href="{{route('PatientConsultation')}}/{{$intPatientId}}" class="btn btn-app bg-secondary">
                  <span class="badge bg-info">
                    <?php $intTotalPatientConsultation = 0; ?>
                    @foreach($TotalPatientConsultations  as $TotalPatientResult)
                    <?php
                      $intTotalPatientConsultation = $TotalPatientResult->TotalPatientResult;
                      ?>
                    @endforeach
                    {{$intTotalPatientConsultation}}</span>
                  <i class="fas fa-comment-medical"></i>Patient Consultation
                </a>
                
                @if($intIsPatient==1)
                <!-- <p>Application Buttons with Custom Colors</p> -->

                <a href="{{route('PatientPatientVitalSign')}}/{{$intPatientId}}" class="btn btn-app bg-danger">
                  <span class="badge bg-teal">
                    <?php
                      $intTotalPatientVitalSign =0;
                    ?>
                    @foreach($TotalPatientVitalSigns as $TotalPatientVitalSign)
                    <?php
                      $intTotalPatientVitalSign =$TotalPatientVitalSign->TotalPatientVitalSigns;
                    ?>
                    @endforeach
                    {{$intTotalPatientVitalSign}}</span>
                  <i class="fas fa-file"></i> Vital Sign
                </a>

                <a href="{{route('DoctorConsultation')}}/{{$intPatientId}}" class="btn btn-app bg-danger">
                  <span class="badge bg-teal">
                    
                    {{$TotalDoctorDiagnosis}}</span>
                  <i class="fas fa-file"></i> Doctor Consultation
                </a>

                <a href="{{route('PatientCalendarIndex')}}/{{$intPatientId}}" class="btn btn-app bg-danger">
                  <span class="badge bg-teal">
                    
                    {{$TotalCalendar}}</span>
                  <i class="fas fa-file"></i> Calendar
                </a>              
               
                <a href="{{route('DiagHysteroscopy')}}/{{$intPatientId}}" class="btn btn-app bg-warning">
                  <span class="badge bg-danger">
                    <?php $intTotalPatientProcedure = 0; ?>
                    @foreach($TotalDiagnosticyHysteroscopy as $TotalDiagnosticyHysteroscop)
                    <?php
                      $intTotalPatientProcedure = $TotalDiagnosticyHysteroscop->TotalDiagnosticyHysteroscopy;
                      ?>
                    @endforeach
                    {{$intTotalPatientProcedure}}
                  </span>
                  <i class="fas fa-comment-medical"></i>Diag Hysteroscopy
                </a>

                <a href="{{route('PostOpPostProcNotes')}}/{{$intPatientId}}" class="btn btn-app bg-warning">
                  <span class="badge bg-danger">
                    <?php $intTotalPostOpPostNote = 0; ?>
                    @foreach($TotalPostOpPostNotes as $TotalPostOpPostNote)
                    <?php
                      $intTotalPostOpPostNote = $TotalPostOpPostNote->TotalPostOpPostNotes;
                      ?>
                    @endforeach
                    {{$intTotalPostOpPostNote}}
                  </span>
                  <i class="fas fa-comment-medical"></i>Post-Op/Post Proc Notes
                </a>

                <a href="{{route('PreOperaCheckList')}}/{{$intPatientId}}" class="btn btn-app bg-warning">
                  <span class="badge bg-danger">
                    <?php $intTotalPreOperaChecklist = 0; ?>
                    @foreach($TotalPreOperaChecklists as $TotalPreOperaChecklist)
                    <?php
                      $intTotalPreOperaChecklist = $TotalPreOperaChecklist->TotalPreOperaChecklists;
                      ?>
                    @endforeach
                    {{$intTotalPreOperaChecklist}}
                  </span>
                  <i class="fas fa-comment-medical"></i>Pre-Op Checklist
                </a>

                <a href="{{route('OperativeReport')}}/{{$intPatientId}}" class="btn btn-app bg-warning">
                  <span class="badge bg-danger">
                    <?php $intTotalOperativeReport = 0; ?>
                    @foreach($TotalOperativeReports as $TotalOperativeReport)
                    <?php
                      $intTotalOperativeReport = $TotalOperativeReport->TotalOperativeReports;
                      ?>
                    @endforeach
                    {{$intTotalOperativeReport}}
                  </span>
                  <i class="fas fa-book-open"></i>Operative Report
                </a>

                <a href="{{route('OVFReqForm')}}/{{$intPatientId}}" class="btn btn-app bg-warning">
                  <span class="badge bg-danger">
                    <?php $intTotalIVFRequisistionForm = 0; ?>
                    @foreach($TotalIVFRequisistionForms as $TotalIVFRequisistionForm)
                    <?php
                      $intTotalIVFRequisistionForm = $TotalIVFRequisistionForm->TotalIVFRequisistionForms;
                      ?>
                    @endforeach
                    {{$intTotalIVFRequisistionForm}}
                  </span>
                  <i class="fas fa-book-open"></i>IVF Req Form
                </a>

                <a href="{{route('MocEmbTraMeas')}}/{{$intPatientId}}" class="btn btn-app bg-warning">
                  <span class="badge bg-danger">
                    <?php $intTotalMocEmbTraMeas= 0; ?>
                    @foreach($TotalMocEmbTraMeas as $TotalMocEmbTraMea)
                    <?php
                      $intTotalMocEmbTraMeas = $TotalMocEmbTraMea->TotalMocEmbTraMeas;
                      ?>
                    @endforeach
                    {{$intTotalMocEmbTraMeas}}
                  </span>
                  <i class="fas fa-baby-carriage"></i>Mock Emb Trans
                </a>

                <a href="{{route('PostAnesthesiaRecs')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalPostAnesthesiaRecs= 0; ?>
                    @foreach($TotalPostAnesthesiaRecs as $TotalPostAnesthesiaRec)
                    <?php
                      $intTotalPostAnesthesiaRecs = $TotalPostAnesthesiaRec->TotalPostAnesthesiaRecs;
                      ?>
                    @endforeach
                    {{$intTotalPostAnesthesiaRecs}}
                  </span>
                  <i class="fas fa-procedures"></i>Post Anethesia Rec
                </a>

                <a href="{{route('PreAneCheRecs')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalPreAneCheRecs= 0; ?>
                    @foreach($TotalPreAneCheRecs as $TotalPreAneCheRec)
                    <?php
                      $intTotalPreAneCheRecs = $TotalPreAneCheRec->TotalPreAneCheRecs;
                      ?>
                    @endforeach
                    {{$intTotalPreAneCheRecs}}
                  </span>
                  <i class="fas fa-procedures"></i>Pre Anethesia Rec
                </a>

                <a href="{{route('IntraOperAnesRecs')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalIntraOperAnesRecs= 0; ?>
                    @foreach($TotalIntraOperAnesRecs as $TotalIntraOperAnesRec)
                    <?php
                      $intTotalIntraOperAnesRecs = $TotalIntraOperAnesRec->TotalIntraOperAnesRecs;
                      ?>
                    @endforeach
                    {{$intTotalIntraOperAnesRecs}}
                  </span>
                  <i class="fas fa-procedures"></i>Inter-Opera Anes Rec
                </a>

                <a href="{{route('ConOfAnesthesia')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalConOfAnesthesia= 0; ?>
                    @foreach($TotalConOfAnesthesias as $TotalConOfAnesthesia)
                    <?php
                      $intTotalConOfAnesthesia = $TotalConOfAnesthesia->TotalConOfAnesthesias;
                      ?>
                    @endforeach
                    {{$intTotalConOfAnesthesia}}
                  </span>
                  <i class="fas fa-procedures"></i>Anesthesia Consent
                </a>

                <a href="{{route('IVFEmbryoTransDataSheet')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalIVFEmbryoTransDataSheet= 0; ?>
                    @foreach($TotalIVFEmbryoTransDataSheets as $TotalIVFEmbryoTransDataSheet)
                    <?php
                      $intTotalIVFEmbryoTransDataSheet = $TotalIVFEmbryoTransDataSheet->TotalIVFEmbryoTransDataSheet;
                      ?>
                    @endforeach
                    {{$intTotalIVFEmbryoTransDataSheet}}
                  </span>
                  <i class="fas fa-procedures"></i>IVF/Emb Trans Data Sheet
                </a>

                <a href="{{route('SpermFreezing')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalSpermFreezing= 0; ?>
                    @foreach($TotalSpermFreezings as $TotalSpermFreezing)
                    <?php
                      $intTotalSpermFreezing = $TotalSpermFreezing->TotalSpermFreezings;
                      ?>
                    @endforeach
                    {{$intTotalSpermFreezing}}
                  </span>
                  <i class="fas fa-procedures"></i>Sperm Freezing
                </a>

                <a href="{{route('SpermThawing')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intSpermThawing= 0; ?>
                    @foreach($TotalSpermThawings as $TotalSpermThawing)
                    <?php
                      $intSpermThawing = $TotalSpermThawing->TotalSpermThawings;
                      ?>
                    @endforeach
                    {{$intSpermThawing}}
                  </span>
                  <i class="fas fa-procedures"></i>Sperm Thawing
                </a>

                <a href="{{route('SemenAnalysis')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalSemenAnalysis= 0; ?>
                    @foreach($TotalSemenAnalysis as $TotalSemenAnalysi)
                    <?php
                      $intTotalSemenAnalysis = $TotalSemenAnalysi->TotalSemenAnalysis;
                      ?>
                    @endforeach
                    {{$intTotalSemenAnalysis}}
                  </span>
                  <i class="fas fa-procedures"></i>Semen Analysis
                </a>

                <a href="{{route('OOcyteRetReport')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalOOcyteRetReports= 0; ?>
                    @foreach($TotalOOcyteRetReports as $TotalOOcyteRetReport)
                    <?php
                      $intTotalOOcyteRetReports = $TotalOOcyteRetReport->TotalOOcyteRetReports;
                      ?>
                    @endforeach
                    {{$intTotalOOcyteRetReports}}
                  </span>
                  <i class="fas fa-procedures"></i>OOcyte Retrieval
                </a>

                <a href="{{route('IUI')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalIUIs= 0; ?>
                    @foreach($TotalIUIs as $TotalIUI)
                    <?php
                      $intTotalIUIs = $TotalIUI->TotalIUIs;
                      ?>
                    @endforeach
                    {{$intTotalIUIs}}
                  </span>
                  <i class="fas fa-procedures"></i>IUI
                </a>

                <a href="{{route('OOctyeFreezeThawTrans')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalOOcyteFreezeThawTransRecs= 0; ?>
                    @foreach($TotalOOcyteFreezeThawTransRecs as $TotalOOcyteFreezeThawTransRec)
                    <?php
                      $intTotalOOcyteFreezeThawTransRecs = $TotalOOcyteFreezeThawTransRec->TotalOOcyteFreezeThawTransRecs;
                      ?>
                    @endforeach
                    {{$intTotalOOcyteFreezeThawTransRecs}}
                  </span>
                  <i class="fas fa-procedures"></i>OOcyte Freeze Thaw
                </a>

                <a href="{{route('EmbryologyRecordI')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalTotalEmbryologyRecordIs= 0; ?>
                    @foreach($TotalEmbryologyRecordIs as $TotalEmbryologyRecordI)
                    <?php
                      $intTotalTotalEmbryologyRecordIs = $TotalEmbryologyRecordI->TotalEmbryologyRecordIs;
                      ?>
                    @endforeach
                    {{$intTotalTotalEmbryologyRecordIs}}
                  </span>
                  <i class="fas fa-procedures"></i>Embryology Rec I
                </a>

                <a href="{{route('EmbryologyRecordII')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalTotalEmbryologyRecordIIs= 0; ?>
                    @foreach($TotalEmbryologyRecordIIs as $TotalEmbryologyRecordII)
                    <?php
                      $intTotalTotalEmbryologyRecordIIs = $TotalEmbryologyRecordII->TotalEmbryologyRecordIIs;
                      ?>
                    @endforeach
                    {{$intTotalTotalEmbryologyRecordIIs}}
                  </span>
                  <i class="fas fa-procedures"></i>Embryology Rec II
                </a>

                <a href="{{route('EmbTraFroEmb')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-danger">
                    <?php $intTotalTotalEmbTraEmbFroEmbs= 0; ?>
                    @foreach($TotalEmbTraEmbFroEmbs as $TotalEmbTraEmbFroEmb)
                    <?php
                      $intTotalTotalEmbTraEmbFroEmbs = $TotalEmbTraEmbFroEmb->TotalEmbTraEmbFroEmbs;
                      ?>
                    @endforeach
                    {{$intTotalTotalEmbTraEmbFroEmbs}}
                  </span>
                  <i class="fas fa-procedures"></i>Embryo Trans/Frozen
                </a>

                 <a href="{{route('PatientBiopsyStudy')}}/{{$intPatientId}}" class="btn btn-app bg-secondary">
                  <span class="badge bg-success">
                    <?php
                      $intTotalBiopsyStudy =0;
                    ?>
                    @foreach($TotalBiopsyStudys as $TotalBiopsyStudy)
                    <?php
                      $intTotalBiopsyStudy =$TotalBiopsyStudy->TotalBiopsyStudy;
                    ?>
                    @endforeach
                    {{$intTotalBiopsyStudy}}
                  </span>
                  <i class="fas fa-book"></i> Biopsy Study
                </a>
                <a href="{{route('PatientBiopsyResult')}}/{{$intPatientId}}" class="btn btn-app bg-success">
                  <span class="badge bg-purple">
                    <?php
                      $intTotalBiopsyResult =0;
                    ?>
                    @foreach($TotalBiopsyResults as $TotalBiopsyResult)
                    <?php
                      $intTotalBiopsyResult =$TotalBiopsyResult->TotalBiopsyResult;
                    ?>
                    @endforeach
                    {{$intTotalBiopsyResult}}
                  </span>
                  <i class="fas fa-book-open"></i> Biopsy Result
                </a>

                <a href="{{route('PatientFertilityResult')}}/{{$intPatientId}}" class="btn btn-app bg-danger">
                  <span class="badge bg-teal">
                    <?php
                      $intTotalPatientResult =0;
                    ?>
                    @foreach($TotalPatientResults as $TotalPatientResult)
                    <?php
                      $intTotalPatientResult =$TotalPatientResult->TotalPatientResult;
                    ?>
                    @endforeach
                    {{$intTotalPatientResult}}</span>
                  <i class="fas fa-heart"></i> Result
                </a>
                @endif

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>