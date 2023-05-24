<style>
    body{
        display: none;
    }
</style>
@php
$title = 'Agreement';
@endphp
@extends('originator.root.dashboard_side_bar',['title' => $title])
@section('title', "Agreement")
         @endphp

<link rel="stylesheet" href="{{asset('vendors/css/case-style.css')}}"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

<div class="mobile-menu-overlay"></div>
<!-- saadullah -->
<div class="main-container">
    <div class="m-3">
        <div class="row">
            <div class="col-xl-12 borderradius" style="background-color:#F3F4F6;">
                <div class="row">

                    <div class="col-xl-12 mb-30  px-4"  >
                        <p class="mt-4">All aligners are individually made, numbered and packed at the beginning of the treatment. The aligners are sent to you immediately, along with a prescribed treatment schedule for each aligner. With each aligner, you will receive a summary chart indicating the purpose and location of the force points per level, as well as a detailed sheet per level indicating all IPR and the size and direction of the force points.</p>
                        
                        <p class="mt-4">This plan is presented to you with a digital report and animated link so you can see the movement of the teeth toward the final result. The treatment plan will be made available to you through the AccuAligners online portal for evaluation, change request, approval and payment. You can share the animated link with your patient to explain and simplify the treatment procedure and final result. You can then approve the treatment in the AccuAligners Online Portal so that we can fabricate the required number of aligners for your patient within 7 business days of receiving payment.</p>
                        
                        <h6 class="mb-2">Start a case with AccuAligners by following the simple steps below</h6>
                        
                        <ul style="list-style: inside;" class="unorderlist">
                        <li style="text-decoration: bullets;"> Obtain informed consent from your patient</li>
                        <li style="text-decoration: bullets;"> Upload physical or digital impressions, scanned files of the patient's teeth, bite registrations, radiographs and photos of the patient's teeth to the AccuAligners Online Portal</li>
                        <li style="text-decoration: bullets;">With the support of our specialized clinical orthodontist team, we propose a professional treatment plan, which is communicated to you within 3 to 7 business days in the AccuAligners Online Portal.</li>
                        <li style="text-decoration: bullets;">You evaluate the treatment plan in the AccuAligners Online Portal by approving it or requesting changes. Once approved, we will create the aligners for your patient, which will be sent to you within 7 business days after payment is received. You will also receive a treatment plan summary with separate details for each aligner set. If there are any changes, we will modify the treatment plan and upload it again to the AccuAligners Online Portal for evaluation until you approve it.</li>
                        <li style="text-decoration: bullets;">The period for wearing each aligner set is 2 weeks, shifting the teeth by 0.2-0.3 mm in each step until the teeth reach their final position</li>
                        <li style="text-decoration: bullets;">A single aligner may be required to complete the treatment plan.</li>
                        </ul>
                        
                        <h6 class="mb-2 mt-3">Indications for Accualigners</h6>
                        <p>Indications for AccuAligners are recommended for the treatment of the following indications:</p>
                        <ul style="list-style: inside;" class="unorderlist">
                        <li style="text-decoration: bullets;"> A diastema of 6.0 mm or less</li>
                        <li>Closing gaps</li>
                        <li>Overcrowding</li>
                        <li>Teeth rotation</li>
                        <li>Expansion</li>
                        <li>Anterior teeth and premolars in a crossbite</li>
                        <li>Correction prior to an orthopedic treatment</li>
                        <li>Passive/active/double retention appliance</li>
                        <li>Relapse</li>
                        <li>Deep bite</li>
                        <h6 class="mb-2 mt-3">The following indications are not recommended for treatment with exceed aligners:</h6>
                        <ul style="list-style: inside;" class="unorderlist">
                        <li>   A diastema greater than 6.0 mm                  
                        </li>
                        <li>Crowding larger than 6.0 mm</li>
                        <li>Class III</li>
                        <li>Monitoring of the torque or distal inclination of the teeth</li>
                        <li>Deciduous dentition or not fully erupted dentition</li>
                        <li>Active periodontal disease</li>
                        <li>Repetitive disease (depending on the severity of the individual case)</li>
                        <li>Patients with bruxism, craniomandibular dysfunction or hypersensitivity to materials</li>
                  <p class="mt-3">
                    However, there are some limitations to treatment where you need to combine attachments or perform extractions or IPR. Our trained team will guide you step by step to help you with the necessary movement methods.
                  </p>
                  <h6 class="mt-3">Payments Terms:</h6>
                  <p >
                    Once you have uploaded the treatment request (impressions + photos + x-rays) to the AccuAligners Online Portal, you will receive an invoice for AED 1000 to start treatment. Once the treatment has started, the 1000 AED is included in the estimated treatment cost. If the treatment is not performed, the treatment plan fee (AED 1,000) will not be refunded.
                  </p>
                  <h6 class="mt-3">Payment options:</h6>
                  <li>Online payment on the AccuAligners Online Portal, bank transfer or cash payment of the balance prior to the fabrication of the aligners.</li>
                  <li>The installment option is valid for the balance as follows:</li>
                  <li>(Treatment plan payment of 1,000) + 1st payment = 50% of the total amount.</li>
<p class="mt-3">Any changes to the treatment plan due to the patient's failure to comply with the treatment plan will be subject to additional charges based on the changes. Please note that this agreement is valid for 1 year from the date of signing. Any price changes will be announced in a timely manner.</p>
<h6> Agree with terms and condition</h6>
<input type="checkbox" id="chk_agree" {{$agreement_status->agreement_status?'checked':''}}>
I have read the agreement! 
                        </ul>
                    
                        
                            </div>
                </div>
<hr>
            @if($agreement_status->agreement_status == '0')
                <a class="btn bgcolor text-white casebtn float-right mb-4 px-4 py-3 h5" style="font-weight:bold;font-size: 15px!important;" onclick="saveAgreement('{{$agreement_status->id}}')">I Agree</a>
            @endif

            </div>
            
            </div>
            </div>



            <!-- js -->
            
            <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <script src="{{asset('vendors/scripts/core.js')}} "></script>
            <script src="{{asset('vendors/scripts/script.min.js')}} "></script>
            <script src="{{asset('vendors/scripts/dashboard_ajax.js')}} "></script>

</body>

</html>
<script>
    var base_url = "{{url('doctor')}}";
    function saveAgreement(id){
                if(!$("#chk_agree").prop("checked"))
                {
                    toastr.error('Please read the agreement','Not Check',{timeOut:3000});
                    return;
                }
                $.ajax({
                url: base_url+"/save_agreement", // the URL of the server-side script that handles the request
                type: "GET", // the type of request (POST or GET)
                data: {
                    id:  id,
                    status: 1
                }, // the data variables that you want to send along with the request
                success: function(response) {
                    // the function that is executed if the request is successful
                    if(response.done == true){
                    toastr.success('Agreement Accepted','Success',{timeOut:3000});
                    }else{
                    toastr.error('Error In Agreement Acception Retry','Error',{timeOut:3000});
                    }
                    setTimeout(function() {
                        location.reload();
                    }, 4000);
                },
                error: function(xhr) {
                    // the function that is executed if the request fails
                    console.log(xhr.responseText);
                }
                });

    }
        </script>