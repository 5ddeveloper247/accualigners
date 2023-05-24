<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="{{trans('siteConfig.setting.name')}}">
    <meta name="keywords" content="admin, {{trans('siteConfig.setting.name')}}">
    <meta name="author" content="Aeshaz.com">
    <title>{{trans('siteConfig.setting.name')}} | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{asset(trans('siteConfig.setting.favIcon'))}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset(trans('siteConfig.setting.favIcon'))}}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">

    {{--CSS Files--}}
    @include('component.css')

    {{--
    <link rel="stylesheet" type="text/css" href="{{asset(trans('siteConfig.path.adminPanel').'/css/originator.css')}}">
    --}}
    {{--CSS Files End--}}


 <style>
        #column-visibility nav {
            margin-top: 20px;
        }
        a.logout-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
    </style>
</head>

<body
    class="{{ isset($bodyClasses) && !empty($bodyClasses) ? $bodyClasses : 'vertical-layout vertical-menu 2-columns fixed-navbar menu-expanded pace-done'}}"
    data-open="click" data-menu="vertical-menu"
    data-col="{{ isset($dataCol) && !empty($dataCol) ? $dataCol : '2-columns' }}">

    {{--Header--}}
    @if(isset($requiredSections['Header'])) @include($requiredSections['Header']) @endif
    {{--Header End--}}

    {{--Nav--}}
    @if(isset($requiredSections['Nav'])) @include($requiredSections['Nav']) @endif
    {{--Nav End--}}

    {{--Content--}}
    @yield('content')
    {{--Content End--}}

    {{--Footer--}}
    {{-- @if(isset($requiredSections['Footer'])) @include($requiredSections['Footer']) @endif --}}
    {{--Footer End--}}

    {{--JS Files--}}
    @include('component.js')
    {{--JS Files End--}}

    {{--extra individual JS start--}}
    @yield('extra-script')
    {{--extra individual JS end--}}


    <style>
        .modal-agreement .modal-header {
            font-size: 24px;
            font-weight: 700;
            text-transform: uppercase;
            color: #09b8de;
        }

        .modal-agreement p {
            font-size: 16px;
        }

        .modal-agreement ul li {
            font-size: 16px;
            color: black;
        }

        .modal-agreement h4 {
            font-size: 21px;
            font-weight: 700;
        }

        .modal-agreement h5 {
            font-size: 18px;
            font-weight: 700;
        }

        .modal-agreement .modal-body {
            max-height: 600px;
            overflow: hidden scroll;
        }

        .max-w-800 {
            max-width: 800px;
        }
        @media(max-width:768px){
            .header-navbar{
                width:100% !important;
            }
            .nav.navbar-nav{
                padding:0 !important;
            }
            .header-navbar .navbar-header{
                height:6rem;
            }
            .main-menu.menu-fixed {
    top: 6rem;
    height: calc(100% - 12rem);
}
        }
    </style>

    <button type="button" class="btn btn-info btn-lg mb-3 btnDentistAgreement" data-toggle="modal"
        data-target="#myModal" data-backdrop="static" data-keyboard="false">Dentist Agreement</button>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered max-w-800">

            <!-- Modal content-->
            <div class="modal-content modal-agreement">
                <div class="modal-header">
                    AccuAligners / Dentist Workflow & Agreement
                    <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                </div>
                <div class="modal-body">
                    <p>
                        All aligners are individually made, numbered and packed at the beginning of the treatment. The
                        aligners are sent to
                        you immediately, along with a prescribed treatment schedule for each aligner. With each aligner,
                        you will receive a
                        summary chart indicating the purpose and location of the force points per level, as well as a
                        detailed sheet per level
                        indicating all IPR and the size and direction of the force points. This plan is presented to you
                        with a digital report
                        and animated link so you can see the movement of the teeth toward the final result. The
                        treatment plan will be made
                        available to you through the AccuAligners online portal for evaluation, change request, approval
                        and payment. You
                        can share the animated link with your patient to explain and simplify the treatment procedure
                        and final result. You
                        can then approve the treatment in the AccuAligners Online Portal so that we can fabricate the
                        required number of
                        aligners for your patient within 7 business days of receiving payment.
                    </p>
                    <h5>Start a case with AccuAligners by following the simple steps below:</h5>
                    <ul>
                        <li>Obtain informed consent from your patient</li>
                        <li>Upload physical or digital impressions, scanned files of the patient's teeth, bite
                            registrations, radiographs and photos of the patient's teeth to the AccuAligners Online
                            Portal</li>
                        <li>
                            With the support of our specialized clinical orthodontist team, we propose a professional
                            treatment plan, which is communicated to you within 3 to 7 business days in the AccuAligners
                            Online Portal.
                        </li>
                        <li>
                            You evaluate the treatment plan in the AccuAligners Online Portal by approving it or
                            requesting changes. Once
                            approved, we will create the aligners for your patient, which will be sent to you within 7
                            business days after
                            payment is received. You will also receive a treatment plan summary with separate details
                            for each aligner set. If
                            there are any changes, we will modify the treatment plan and upload it again to the
                            AccuAligners Online Portal
                            for evaluation until you approve it.
                        </li>
                        <li>
                            The period for wearing each aligner set is 2 weeks, shifting the teeth by 0.2-0.3 mm in each
                            step until the teeth reach their final position
                        </li>
                        <li>A single aligner may be required to complete the treatment plan.</li>
                    </ul>
                    <h4>Indications for Accualigners</h4>
                    <h5>Indications for AccuAligners are recommended for the treatment of the following indications:
                    </h5>
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
                        However, there are some limitations to treatment where you need to combine attachments or
                        perform extractions or IPR. Our trained team will guide you step by step to help you with the
                        necessary movement methods.
                    </p>

                    <h5>Payments Terms:</h5>
                    <p>
                        Once you have uploaded the treatment request (impressions + photos + x-rays) to the AccuAligners
                        Online Portal,
                        you will receive an invoice for AED 1000 to start treatment. Once the treatment has started, the
                        1000 AED is
                        included in the estimated treatment cost. If the treatment is not performed, the treatment plan
                        fee (AED 1,000) will
                        not be refunded.
                    </p>
                    <h5>Payment options:</h5>
                    <ul>
                        <li>Online payment on the AccuAligners Online Portal, bank transfer or cash payment of the
                            balance prior to the fabrication of the aligners.</li>
                        <li>The installment option is valid for the balance as follows:</li>
                        <li>(Treatment plan payment of 1,000) + 1st payment = 50% of the total amount. (The remaining
                            50% will be paid consecutively in the following two months.</li>
                    </ul>
                    <p> Any changes to the treatment plan due to the patient's failure to comply with the treatment plan
                        will be subject to
                        additional charges based on the changes. Please note that this agreement is valid for 1 year
                        from the date of signing.
                        Any price changes will be announced in a timely manner.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btnDentistAgreement agreementTrue"
                        data-dismiss="modal">Accept Agreement</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function(){
                
                var isAgreement = localStorage.getItem('DentistAgreement');
                
                if(!isAgreement){
                    $('.btnDentistAgreement').click();
                }
                
                $('.agreementTrue').click(function(){
                    
                    localStorage.setItem('DentistAgreement', true);
                    toastr.success("You have accepted dentist agreement.","Congratulations!",{positionClass:"toast-bottom-left",containerId:"toast-bottom-left"});
                
                    
                });
                
            });
            
            
    </script>
    

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
                   

                 

    
                <!--<script src="https://platform.illow.io/banner.js?siteId=6c2e0363-74a9-4cf2-be35-ba273de2901e"></script>-->
                
                <!--Start of Desku Script-->
                <script type="text/javascript">
                  window.lc_id = '926253651784';
                  window.lc_dc = 'accualigners';
                  var chatWidget = document.createElement('app-chat-box');
                  chatWidget.setAttribute('id', "widget");
                  document.body.insertAdjacentElement('beforeend', chatWidget);
                  var deskuInstall = document.createElement('script');
                  deskuInstall.src = 'https://desku-chat-widget-js.pages.dev/chat-widget.js';
                  deskuInstall.setAttribute('defer', true);
                  document.body.insertAdjacentElement('beforeend', deskuInstall);
                </script>
                <!--End of Desku Script-->




         <script>
        //Details display datatable
        $('#modal_dataTabe').addClass('table-responsive');
        $('#modal_dataTabe').removeClass('responsive');
        $('#modal_dataTabe').DataTable({
            info: false,
            searching: false,
            paging: false,
        });
        
        
        // $('#modal_dataTabe').DataTable( {
        //     responsive: true,
        //     searching: false,
        //     paging: false,
        //     info: false,
        //     order: [[0, 'desc']],
        //     responsive: {
        //         details: {
        //             display: $.fn.dataTable.Responsive.display.modal( {
        //                 header: function ( row ) {
        //                     var data = row.data();
        //                     return 'Details'
        //                 }
        //             } ),
        //             renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
        //                 tableClass: 'table border mb-0'
        //             } )
        //         }
        //     }
        // } );
            </script>

</body>

</html>