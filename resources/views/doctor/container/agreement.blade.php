<style>
    body {
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

                    <div class="col-xl-12 mb-30  px-4">
                        <h6 class="mb-2 mt-3">Workflow Introduction</h6>
                        <p class="mt-4">AccuAligners are manufactured to the highest standards by our
                            Accualigners-certified dental laboratory. The aligners are fabricated from PVS impressions
                            (maxillary and mandibular) or digital intraoral scans taken by the dentist. It is the
                            dentist's responsibility to assess the patient's orthodontic treatment, dentition, oral
                            health and overall suitability for treatment before submitting the appropriate scan file to
                            the AccuAligners web portal.
                            It is the dentist's responsibility to keep all records in accordance with the
                            recommendations of the UAE Law. The Accualigners laboratory will produce the appropriate
                            number of aligners depending on treatment needs. Each set of aligners must be worn 24/7 (at
                            least 20 hours per day), except for eating and brushing teeth, to meet treatment
                            requirements.
                            If you require additional aligners, please contact us to discuss your requirements.</p>

                        <p class="mt-4">All aligners are individually made, numbered and packed at the beginning of the
                            treatment. The aligners are sent to you immediately, along with a treatment plan that
                            applies to each aligner. With each aligner, you will receive a summary chart indicating the
                            purpose and location of the force points per level, as well as a detailed sheet per level
                            indicating all IPR and the size and direction of the force points. This plan is presented to
                            you with a digital report and animated link so you can see the movement of the teeth toward
                            the final result. The treatment plan will be made available to you through the AccuAligners
                            online portal for evaluation, change request, approval and payment. You can share the
                            animated link with your patient to explain and simplify the treatment procedure and final
                            result. You can then approve the treatment in the AccuAligners online portal so that we can
                            make the required number of aligners for your patient within 7 business days of receiving
                            payment.</p>


                        <h6 class="mb-2 mt-3">Start a case with AccuAligners by following the simple steps below:</h6>
                        <ul style="list-style: inside;" class="unorderlist">
                            <li style="text-decoration: bullets;">Obtain informed consent from your patient.</li>
                            <li style="text-decoration: bullets;"> Upload physical or digital impressions, scanned files
                                of the patient's teeth, bite registrations, radiographs and photos of the patient's
                                teeth to the AccuAligners Online Portal.
                            </li>
                            <li style="text-decoration: bullets;">With the support of our specialized clinical
                                orthodontist team, we propose a professional treatment plan that is communicated to you
                                within 3 to 7 business days in the AccuAligners Online Portal.
                            </li>
                            <li style="text-decoration: bullets;">You evaluate the treatment plan in the AccuAligners
                                Online Portal by approving it or requesting changes. Once approved, we will create the
                                aligners for your patient, which will be sent to you within 7 business days after
                                payment is received. You will also receive a treatment plan summary with separate
                                details for each aligner set. If there are any changes, we will modify the treatment
                                plan and re-upload it to the AccuAligners online portal for evaluation until you approve
                                it.
                            </li>
                            <li style="text-decoration: bullets;">The time period for wearing each aligner set is 2
                                weeks, shifting the teeth 0.2-0.3mm at each step until they reach their final position
                            </li>
                            <li style="text-decoration: bullets;">A single aligner may be required to complete the
                                treatment plan.
                            </li>
                        </ul>

                        <h6 class="mb-2 mt-3">Impressions</h6>
                        <p>The AccuAligners system is based on a two-phase putty and wash polyvinylsiloxane (PVS) or a
                            digital impression by intraoral scan of the upper and lower dental arch in STL format.
                            AccuAligners can provide 1000 Aed digital impressions for maxilla and mandible. The accuracy
                            of the impressions ensures the correct fitting of the aligners. If the impressions are
                            rejected, you will be notified by email and asked to submit new impressions. It is the
                            dentist's responsibility to ensure that all impressions meet the highest standards and are
                            free of defects. All impressions submitted will not be returned, but if the dentist requires
                            study models, this should be indicated and is subject to additional charges.</p>

                        <h6 class="mb-2 mt-3">Photographs</h6>
                        <p>The photos we need are - pictures of the open mouth, showing both the upper and lower arches.
                            Lateral left and right buccal in centric occlusion, full face with lips retracted in centric
                            bite, full face lips at rest and lateral profile lips at rest.</p>

                        <h6 class="mb-2 mt-3">Treatment Types</h6>
                        <p>AccuAligners has a published range of movements and fabricates aligners according to the
                            requirements of the dentist-approved treatment plan and the overall assessment of the
                            patient's dentition and oral health. Any treatment for caries, periodontal disease or TMD
                            should be performed prior to treatment. The dentist should adhere to the prescribed ranges
                            of movements; any movements beyond these are the responsibility of the dentist. Special
                            attention should be paid to rotations, intrusions and extrusions, as these movements can be
                            difficult to achieve.</p>

                        <h6 class="mb-2 mt-3">Indications for Accualigners</h6>
                        <ul style="list-style: inside;" class="unorderlist">
                            <li style="text-decoration: bullets;">Indications for AccuAligners are recommended for the
                                treatment of the following indications:
                                <ul style="list-style: circle;
    margin-left: 40px;">
                                    <li>A diastema of 6.0 mm or less</li>
                                    <li>Closing gaps</li>
                                    <li>Overcrowding</li>
                                    <li>Teeth rotation</li>
                                    <li>Expansion</li>
                                    <li>Anterior teeth and premolars in a crossbite</li>
                                    <li>Space retention in mixed/permanent dentition</li>
                                    <li>Correction prior to an orthopedic treatment</li>
                                    <li>Correction prior to an orthopedic treatmen</li>
                                    <li>Relapse</li>
                                    <li>Deep bite</li>
                                </ul>
                            </li>
                            <li>The following indications are not recommended for treatment with eXceed aligners:
                                <ul style="list-style: circle;
    margin-left: 40px;">
                                    <li>A diastema greater than 6.0 mm</li>
                                    <li>Crowding larger than 6.0 mm</li>
                                    <li>Class III</li>
                                    <li>Monitoring of the torque or distal inclination of the teeth</li>
                                    <li>Deciduous dentition or not fully erupted dentition</li>
                                    <li>Active periodontal disease</li>
                                    <li>Repetitive disease (depending on the severity of the individual case)</li>
                                    <li>Patients with bruxism, craniomandibular dysfunction or hypersensitivity to materials</li>
                                    <li>Severe rotations beyond 30 degrees</li>
                                    <li>Mixed dentition</li>
                                    <li>Fixed bridge work, implants</li>
                                    <li>Poor Oral Hygiene</li>
                                    <li>Extraction space closure Un-erupted permanent teeth Class III Orthodontic cases.</li>
                                </ul>

                            </li>
                        </ul>
                        <p>However, there are some limitations to treatment where you need to combine attachments or
                            perform extractions or IPR. Our trained team will guide you step by step to help you with
                            the necessary movement methods.</p>


                        <h6 class="mb-2 mt-3">Patients Treatment (prior and during)</h6>
                        <p class="mt-3">
                            It is the dentist's responsibility to ensure that the patient has both signed and understood the consent form to perform the treatment. Inadequate compliance, use or misuse by the patient or the dentist may result in unsuccessful treatment. A case is considered closed or terminated when a period of 12 weeks has elapsed without any further written contact with Accualigners regarding treatment. If the dentist decides to resume treatment, it will be subject to digital evaluation and additional charges. If the patient has not adhered to the specified wear time or product usage, the company cannot be held responsible for incomplete treatment results. If the patient and dentist decide to continue treatment, new impressions and a new treatment form will be required. This may be considered a new treatment by the Company and will be charged at the full published list price. Treatments are suitable for both adults and adolescents 14 years of age and older, and the dentition should be fully erupted and not mixed.
                        </p>
                        <h6 class="mt-3">ACCUALIGNERS UAE PRICING</h6>
                       <table class="table">
                           <tbody>
                            <tr>
                                <td>AccuAligners Clear Trays (any numbers of trays)</td>
                                <td>AED 4500</td>
                            </tr>
                            <tr>
                                <td>1st Refinement</td>
                                <td>Included</td>
                            </tr>
                            <tr>
                                <td>2nd Refinement</td>
                                <td>Included</td>
                            </tr>
                            <tr>
                                <td>Additional Refinements</td>
                                <td>AED 699</td>
                            </tr>
                            <tr>
                                <td>Treatment Plan Assessment Only</td>
                                <td>AED 1000</td>
                            </tr>
                            <tr>
                                <td>Revision</td>
                                <td>Single</td>
                            </tr>
                           </tbody>
                       </table>
                        <h6 class="mt-3">What is the difference between a Revision and a Refinement?</h6>

                        <p class="mt-3">A Revision is a request to adjust the plan prior to approval. A Refinement is a post-approval request for a mid-course correction.</p>
                        <h6>Refund & Return policy</h6>
                        <p> At AccuAligners, we want to ensure that our customers have a positive experience when purchasing our aligners. We have established some guidelines that we believe are fair and customer friendly.</p>
                        <p> If you change your mind about your order prior to the treatment plan, you may request a cancellation within 24-48 hours of placing the order. However, once the order is processed, we will only offer refunds for cancellations minus the treatment plan fees.</p>
                        <p> For safety reasons, we are unable to accept returns on our impression kits. However, if our orthodontic team determines that you are not suitable for treatment with our invisible aligners, we will provide a full refund.</p>
                        <p> Once you receive your aligners, we will not take them back. However, if they do not fit properly, we will make new ones for you. And if you follow all the prescribed guidelines and are not satisfied with your results at the end of your treatment, please contact us so our team can reevaluate your case. If we conclude that additional aligners would be beneficial for you, you may be eligible for them.</p>
                        <p> If you receive a refund, it will be processed within 12-15 business days and refunded to your original payment method.</p>
                        <p> If you have any questions about your order, please do not hesitate to contact us at info@accualigners.com. We will be happy to assist you!</p>

                        <h6>Payments Terms:</h6>
                        <p>Once you have uploaded the treatment request (impressions + photos + x-rays) to the AccuAligners Online Portal, you will receive an invoice for AED 1000 to start treatment. Once treatment has started, the 1000 AED is included in the estimated treatment cost. If the treatment is not performed, the treatment plan fee (1000 AED) will not be refunded. The invoice is the immediate payment.</p>

                        <h6>Payment Process:</h6>
                        <ul>
                            <li>Online payment on the AccuAligners Online Portal, credit card or bank transfer of the balance prior to the fabrication of the aligners.</li>
                            <li>The installment option is valid for the balance as follows:
                                (Treatment plan payment of 1000) + 1st payment = 50% of the total amount. (The remaining 50% will be paid consecutively in the following two months.</li>
                        </ul>

                        <p>
                            Any changes to the treatment plan due to the patient's failure to comply with the treatment plan will be subject to additional charges commensurate with the changes. Please note that this agreement is valid for 1 year from the date of signing. Any price changes will be announced in a timely manner.
                        </p>

                        <h6>Dentist Finder and General Data</h6>
                        <p>
                            You may provide up to two practices, and the dentist is responsible for the details of the practice information. From time to time, we may share your information with our carefully selected partners to further support the development of the AccuAligners brand in the practice. If you do not wish us to share this information, you should notify us in writing that you wish to be removed from the dentist search .
                        </p>

                        <h6>Liabilities</h6>
                        <p>
                            The Company and its employees or agents cannot be held liable for the treatment outcome or for any injury or damage to the patient, or if the product is used in conjunction with other equipment to achieve results other than the desired results indicated on the treatment form. The dentist is responsible for both the evaluation and treatment of the patient and for the contents of the submitted treatment form. The treating dentist is solely responsible for prescribing and administering orthodontic treatment. Aligners therapy is unpredictable. Aligners offers no guarantee of successful treatment results. Individual results may vary.
                        </p>

                        <h6>General Use</h6>
                        <p>
                            These conditions are designed to ensure that both the patient and the dentist have the best experience when using the AccuAligners product. Retention is also an important part of follow-up care. If necessary, we can provide the final aligners to ensure retention. However, retention should be checked regularly to detect any movement. Our terms and conditions are subject to change without notice.
                        </p>

                        <input type="checkbox" id="chk_agree" {{$agreement_status->agreement_status?'checked':''}}>
                        I have read the agreement!



                    </div>
                </div>
                <hr>
                @if($agreement_status->agreement_status == '0')
                    <a class="btn bgcolor text-white casebtn float-right mb-4 px-4 py-3 h5"
                       style="font-weight:bold;font-size: 15px!important;"
                       onclick="saveAgreement('{{$agreement_status->id}}')">I Agree</a>
                @endif

            </div>

        </div>
    </div>


    <!-- js -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{asset('vendors/scripts/core.js')}} "></script>
    <script src="{{asset('vendors/scripts/script.min.js')}} "></script>
    <script src="{{asset('vendors/scripts/dashboard_ajax.js')}} "></script>

    </body>

    </html>
    <script>
        var base_url = "{{url('doctor')}}";

        function saveAgreement(id) {
            if (!$("#chk_agree").prop("checked")) {
                toastr.error('Please read the agreement', 'Not Check', {timeOut: 3000});
                return;
            }
            $.ajax({
                url: base_url + "/save_agreement", // the URL of the server-side script that handles the request
                type: "GET", // the type of request (POST or GET)
                data: {
                    id: id,
                    status: 1
                }, // the data variables that you want to send along with the request
                success: function (response) {
                    // the function that is executed if the request is successful
                    if (response.done == true) {
                        toastr.success('Agreement Accepted', 'Success', {timeOut: 3000});
                    } else {
                        toastr.error('Error In Agreement Acception Retry', 'Error', {timeOut: 3000});
                    }
                    setTimeout(function () {
                        location.reload();
                    }, 4000);
                },
                error: function (xhr) {
                    // the function that is executed if the request fails
                    console.log(xhr.responseText);
                }
            });

        }
    </script>
