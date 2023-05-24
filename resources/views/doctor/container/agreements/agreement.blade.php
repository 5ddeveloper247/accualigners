
<!-- @extends('doctor.root.index') -->

@section('title', "Case")


@section('content')

@php

    $requiredSections = [
        'Header' => 'doctor.components.side-nav',
        'Footer' => 'doctor.components.footer'
    ];

    $componentsJsCss = [
        'adminPanel.general',
        'adminPanel.datatable',
        'adminPanel.sweetalert',
    ];

@endphp

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-12 col-12 mb-1">
            <div class="row breadcrumbs-top">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('doctor.dashbord')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Accualigners Agreement</li>
                </ol>
              </div>
            </div>

            <div class="row" id="agreementSuccess">
                <div class="col-md-12 text-center">
                    <div class="alert-success py-1 mt-2">
                        <div class="text-white">
                            You have already accepted an agreement.
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="content-body">

            
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body pt-0 mt-2">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <h2>Accualigners Agreement</h2>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                          <p>
                                              All aligners are individually made, numbered and packed at the beginning of the treatment. The aligners are sent to
                                                you immediately, along with a prescribed treatment schedule for each aligner. With each aligner, you will receive a
                                                summary chart indicating the purpose and location of the force points per level, as well as a detailed sheet per level
                                                indicating all IPR and the size and direction of the force points. This plan is presented to you with a digital report
                                                and animated link so you can see the movement of the teeth toward the final result. The treatment plan will be made
                                                available to you through the AccuAligners online portal for evaluation, change request, approval and payment. You
                                                can share the animated link with your patient to explain and simplify the treatment procedure and final result. You
                                                can then approve the treatment in the AccuAligners Online Portal so that we can fabricate the required number of
                                                aligners for your patient within 7 business days of receiving payment.
                                          </p>
                                          <h5>Start a case with AccuAligners by following the simple steps below:</h5>
                                          <ul>
                                              <li>Obtain informed consent from your patient</li>
                                              <li>Upload physical or digital impressions, scanned files of the patient's teeth, bite registrations, radiographs and photos of the patient's teeth to the AccuAligners Online Portal</li>
                                              <li>
                                                  With the support of our specialized clinical orthodontist team, we propose a professional treatment plan, which is communicated to you within 3 to 7 business days in the AccuAligners Online Portal.
                                              </li>
                                              <li>
                                                  You evaluate the treatment plan in the AccuAligners Online Portal by approving it or requesting changes. Once
                                                    approved, we will create the aligners for your patient, which will be sent to you within 7 business days after
                                                    payment is received. You will also receive a treatment plan summary with separate details for each aligner set. If
                                                    there are any changes, we will modify the treatment plan and upload it again to the AccuAligners Online Portal
                                                    for evaluation until you approve it.
                                              </li>
                                              <li>
                                                  The period for wearing each aligner set is 2 weeks, shifting the teeth by 0.2-0.3 mm in each step until the teeth reach their final position
                                              </li>
                                              <li>A single aligner may be required to complete the treatment plan.</li>
                                          </ul>
                                          <h4>Indications for Accualigners</h4>
                                          <h5>Indications for AccuAligners are recommended for the treatment of the following indications:</h5>
                                          <ul>
                                              <li>A diastema of 6.0 mm or less</li>
                                              <li>Closing gaps</li>
                                              <li>Overcrowding</li>
                                              <li>Teeth rotation</li>
                                              <li>Expansion</li>
                                              <li>Anterior teeth and premolars in a crossbite</li>
                                              <li>Space retention in mixed/permanent dentition</li>
                                              <li>Correction prior to an orthopedic treatment</li>
                                              <li>Passive/active/double retention appliance</li>
                                              <li>Relapse</li>
                                              <li>Deep bite</li>
                                          </ul>
                                          <h5>The following indications are not recommended for treatment with eXceed aligners:</h5>
                                          <ul>
                                              <li>A diastema greater than 6.0 mm</li>
                                              <li>Crowding larger than 6.0 mm</li>
                                              <li>Class III</li>
                                              <li>Monitoring of the torque or distal inclination of the teeth</li>
                                              <li>Deciduous dentition or not fully erupted dentition</li>
                                              <li>Active periodontal disease</li>
                                              <li>Repetitive disease (depending on the severity of the individual case)</li>
                                              <li>Patients with bruxism, craniomandibular dysfunction or hypersensitivity to materials</li>
                                          </ul>
                                          <p>
                                              However, there are some limitations to treatment where you need to combine attachments or perform extractions or IPR. Our trained team will guide you step by step to help you with the necessary movement methods.
                                          </p>
                                          
                                          <h5>Payments Terms:</h5>
                                          <p>
                                              Once you have uploaded the treatment request (impressions + photos + x-rays) to the AccuAligners Online Portal,
                                                you will receive an invoice for AED 1000 to start treatment. Once the treatment has started, the 1000 AED is
                                                included in the estimated treatment cost. If the treatment is not performed, the treatment plan fee (AED 1,000) will
                                                not be refunded.
                                          </p>
                                          <h5>Payment options:</h5>
                                          <ul>
                                              <li>Online payment on the AccuAligners Online Portal, bank transfer or cash payment of the balance prior to the fabrication of the aligners.</li>
                                              <li>The installment option is valid for the balance as follows:</li>
                                              <li>(Treatment plan payment of 1,000) + 1st payment = 50% of the total amount.</li>
                                          </ul>
                                          <p>   Any changes to the treatment plan due to the patient's failure to comply with the treatment plan will be subject to
                                                additional charges based on the changes. Please note that this agreement is valid for 1 year from the date of signing.
                                                Any price changes will be announced in a timely manner.
                                            </p>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
</div>
<script>
    var agreement = document.getElementById("agreementSuccess");
    if (localStorage.getItem("DentistAgreement") == 'true') {
        console.log("true");
    }else{
        console.log("false");
        agreement.style.display = 'none';
    }
</script>

@stop
