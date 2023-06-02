<?php

use App\Http\Controllers\Web\Admin\Appointment\AppointmentController;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Admin\CaseCon\CaseController;
use App\Http\Controllers\Web\Admin\Support\SupportController;
use App\Http\Controllers\Web\Admin\Clinic\ClinicController;
use App\Http\Controllers\Web\Admin\ClinicDoctor\ClinicDoctorController;
use App\Http\Controllers\Web\Admin\Dashbord\DashbordController;
use App\Http\Controllers\Web\Doctor\Dashbord\DashbordController as DoctorDashbordController;
use App\Http\Controllers\Web\Admin\Doctor\DoctorController;
use App\Http\Controllers\Web\Admin\Geography\GeographyController;
use App\Http\Controllers\Web\Admin\Order\OrderController;
use App\Http\Controllers\Web\Admin\Patient\PatientController;
use App\Http\Controllers\Web\Admin\Setting\SettingController;
use App\Http\Controllers\Web\Admin\Shipping\ShippingCompanyChargeController;
use App\Http\Controllers\Web\Admin\Shipping\ShippingCompanyController;
use App\Http\Controllers\Web\Admin\Slider\SliderController;
use App\Http\Controllers\Web\Admin\User\UserController;
use App\Http\Controllers\Web\Admin\Roles\RoleController;
use App\Http\Controllers\Web\Doctor\Auth\AuthController as AuthControllerDoctor;
use App\Http\Controllers\Web\Doctor\CaseCont\CaseController as DoctorCaseController;
use App\Http\Controllers\Web\Doctor\CaseCont\OrderAlignerController;
use App\Http\Controllers\Web\Doctor\CaseCont\PaymentController;
use App\Http\Controllers\Web\Admin\CaseCon\PaymentController as DoctorPaymentController;
use App\Http\Controllers\Web\Doctor\Profile\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/storage-link', function () {
    $exitCode = Artisan::call('storage:link');
});

Route::get('/link-down', function () {
    $exitCode = Artisan::call('down');
});

/// test mail
Route::get('my-demo-mail', 'ContactController@myDemoMail');
Route::get('send-mail', [ContactController::class, 'sendDemoMail']);
// Route::get('test',[ContactController::class,'test']);
/// test mail


//// Auth Routes
Route::get('logout', [AuthController::class, 'distroy'])->name('logout')->middleware('auth');
Route::get('/',  [AuthController::class, 'loginView'])->name('welcome')->middleware('guest');
Route::group(['prefix' => 'login', 'middleware' => 'guest'], function () {
    Route::get('/',  [AuthController::class, 'loginView'])->name('login');
    // Route::get('/new',  [AuthController::class, 'loginViewnew'])->name('new');
    Route::post('/', [AuthController::class, 'login']);
});


Route::group(['middleware' => 'guest'], function () {
    Route::get('/password/reset',  [AuthController::class, 'resetPasswordView'])->name('reset.password');
    Route::post('/password/reset', [AuthController::class, 'resetPassword']);

    Route::get('/change/password', [AuthController::class, 'changePasswordView'])->name('change.password');
    Route::post('/change/password', [AuthController::class, 'changePassword']);

    Route::get('/patient-signup', [AuthController::class, 'patientSignup']);
    Route::view('/signup', 'originator.container.auth.signup')->name('signup');
    // Route::view('/signup1', 'originator.container.auth.signupprev')->name('signup1');
    Route::post('/sign-up', [AuthController::class, 'signUpPost'])->name('signUpPost');


    Route::get('get-state-by-country', [GeographyController::class, 'getStateByCountry'])->name('get-state-by-country');
    Route::get('get-city-by-state', [GeographyController::class, 'getCityByState'])->name('get-city-by-state');
    Route::get('get-shipping-by-city', [GeographyController::class, 'getShippingByCity'])->name('get-shipping-by-city');

});
//// Auth Routes


//Admmin Routes
Route::prefix(trans('siteConfig.subDomain.web.originator'))->name('admin.')->group(function () {

    Route::middleware(['auth','role:admin'])->group(function () {

      Route::get('/', [DashbordController::class, 'index'])->name('dashbord');

      /* Dashboard new */
      Route::get('/new', [DashbordController::class, 'index_new'])->name('index.new');

      /* get currencies  */
      Route::get('/currencies_get', [SettingController::class, 'get_currency'])->name('currencies');
      Route::post('/add_currency', [SettingController::class, 'add_currency'])->name('add_currency');
      Route::post('/add_additional', [SettingController::class,'add_additional'])->name('add_additional2');
      Route::post('/delete', [SettingController::class,'delete'])->name('delete2');


        Route::group(['prefix' => 'geography'], function () {
            Route::get('get-state-by-country', [GeographyController::class, 'getStateByCountry'])->name('get-state-by-country');
            Route::get('get-city-by-state', [GeographyController::class, 'getCityByState'])->name('get-city-by-state');
            Route::get('get-shipping-by-city', [GeographyController::class, 'getShippingByCity'])->name('get-shipping-by-city');
        });

        /// roles
        Route::resource('user', UserController::class);
        //new route
        Route::post('update_new_user', [UserController::class,'update_new'])->name('update_new_user');

        Route::resource('roles', RoleController::class);
        Route::resource('patient', PatientController::class);
        Route::get('clinic-doctors', [PatientController::class, 'clinicDoctors'])->name('get-doctor-by-clinic');

        Route::resource('clinic', ClinicController::class);
        //new routes
        Route::get('clinicnew', [ClinicController::class,'new_index'])->name('clinicnew');
        Route::get('/fetch_countries', [ClinicController::class,'new_create'])->name('fetch_countries');
        Route::post('/add_clinic', [ClinicController::class,'new_store'])->name('add_clinic');
        Route::get('/edit_clinic/{id}', [ClinicController::class,'new_edit'])->name('edit_clinic');
        Route::post('update_new_clinic', [ClinicController::class,'update_new'])->name('update_new_clinic');

        /*_______help & Support______*/
        Route::get('support', [SupportController::class,'index_new'])->name('support');
        Route::post('search_case', [SupportController::class,'search_result'])->name('search_case');
        Route::post('show_message', [SupportController::class,'specific_case_concerns'])->name('show_message');
        Route::post('send_message', [SupportController::class,'add_message'])->name('send_message');
        Route::post('send_notification', [SupportController::class,'sendNotificationMail'])->name('send_notification');
        // return View("originator.container.helpSupport.support");

        Route::resource('doctor', DoctorController::class);

         //new route
         Route::post('update_new_doctor', [DoctorController::class,'update_new'])->name('update_new_doctor');

        Route::resource('clinic.doctor', ClinicDoctorController::class);
        //new route
        Route::post('/add_clinic_doctor/{id}', [ClinicDoctorController::class,'new_store'])->name('add_clinic_doctor');
        Route::post('/showDoctors', [ClinicDoctorController::class,'showClinicDoctors'])->name('showDoctors');
        Route::post('update_new_clinicDoc/', [ClinicDoctorController::class,'update_new'])->name('update_new_clinicDoc');
        Route::post('delete_new_clinicDoc/{id}', [ClinicDoctorController::class,'new_destroy'])->name('delete_new_clinicDoc');

         Route::resource('shipping', ShippingCompanyController::class);
         Route::resource('shipping.charge', ShippingCompanyChargeController::class);

         Route::resource('appointment', AppointmentController::class)->only([
            'index', 'edit', 'destroy', 'create', 'store'
        ]);

         /* new appointment */
         Route::get('appointment_new', [AppointmentController::class,'index_new'])->name('appointment.new');
         Route::post('/appointment_get', [AppointmentController::class,'appointment_get'])->name('appointment.get');
         Route::post('/appointment_add', [AppointmentController::class,'appointment_add'])->name('appointment.add');
         Route::post('/appointment_update/{id}', [AppointmentController::class,'appointment_update'])->name('appointment.update');
         Route::delete('/appointment_delete/{id}', [AppointmentController::class,'appointment_delete'])->name('appointment.delete');

         Route::resource('order', OrderController::class)->only([
            'index', 'edit', 'update', 'destroy'
         ]);


         /* Order new*/
         Route::get('/order-new', [OrderController::class, 'index_old'])->name('order.new');
         Route::get('/order_edit/{id}', [OrderController::class, 'order_edit'])->name('order.edit.new');
         Route::post('/order_update', [OrderController::class, 'order_update'])->name('order.update.new');
         Route::post('/order_delete', [OrderController::class, 'delete'])->name('order.delete.new');


         Route::post('appointment-store', [AppointmentController::class, 'appointmentStore'])->name('appointmentStore');

         Route::resource('slider', SliderController::class);
         //new route
         Route::post('update_new_slider', [SliderController::class,'update_new'])->name('update_new_slider');

         Route::resource('case', CaseController::class);

         /* new route */
         Route::get('/case_new', [CaseController::class, 'index_new'])->name('case.new');
         Route::get('/case_view/{id}', [CaseController::class, 'case_view'])->name('case.view');
        //  Route::get('/index_new', [PaymentController::class,'new_index'])->name('index_new');
        Route::post('case/payment/store', [DoctorPaymentController::class, 'store_new'])->name('case.payment.store');
        Route::post('case/payment/invoice', [DoctorPaymentController::class, 'invoice_store'])->name('case.invoice.store');
        Route::post('update_new_case', [CaseController::class,'update_new'])->name('update_new_case');
        Route::post('case/change/status', [CaseController::class, 'change_status'])->name('case.chnage.status');
        Route::post('connect/case', [CaseController::class, 'connectCase'])->name('connect.case');
        Route::post('case/missing_aligners', [CaseController::class, 'missing_trays'])->name('case.missing_aligners');

        //ping doctor for paying digital scan
        Route::post('case/allow_doct', [CaseController::class, 'notify_about_digital_scan'])->name('case.allow_doct');
        Route::post('case/get-advices', [CaseController::class, 'getallAdvicesAdmin'])->name('case.add-advice');

        /*new route end */

         Route::post('case/impression-kit-received', [CaseController::class, 'impressionKitReceived'])->name('case.impression-kit-received');
         Route::post('case/aligner-kit-delivery', [CaseController::class, 'alignerKitDelivery'])->name('case.aligner-kit-delivery');
         Route::post('case/no-of-trays-update', [CaseController::class, 'noOfTraysUpdate'])->name('case.no-of-trays-update');
         Route::post('case/no-of-days-update', [CaseController::class, 'noOfDaysUpdate'])->name('case.no-of-days-update');
         Route::post('case/add-advice', [CaseController::class, 'addAdvice'])->name('case.add-advice');
         Route::post('case/upload-video', [CaseController::class, 'uploadVideo'])->name('case.upload-video');
         Route::post('case/delete-video', [CaseController::class, 'deleteVideo'])->name('case.delete-video');
         Route::post('case/embedded-video', [CaseController::class, 'embeddedVideo'])->name('case.embedded-video');

         /* new route  */
         Route::post('case/upload-attachment2', [CaseController::class, 'uploadAttachment2'])->name('case.upload-attachment2');
         Route::post('case/upload-attachments2', [CaseController::class, 'uploadAttachments2'])->name('case.upload-attachments2');
         Route::post('case/upload-attachment', [CaseController::class, 'uploadAttachment'])->name('case.upload-attachment');
         Route::post('/delete_attachment', [CaseController::class, 'deleteAttachment'])->name('delete_attachment');

         Route::post('case/upload-attachments', [CaseController::class, 'uploadAttachments'])->name('case.upload-attachments');
         Route::get('case/download-attachment/{case_id}', [CaseController::class, 'downloadAttachment'])->name('case.download-attachment');
         Route::post('case/destroy-attachment', [CaseController::class, 'destroyAttachment'])->name('case.destroy-attachment');
         Route::post('get-clinic-patients', [CaseController::class, 'getClinicPatients'])->name('case.get-clinic-patients');
         Route::post('get-patient-detail', [CaseController::class, 'getPatientDetail'])->name('case.get-patient-detail');

         Route::get('/setting_new', [SettingController::class, 'index_new'])->name('setting.new');

         Route::resource('setting', SettingController::class)->only([
            'index', 'store'
        ]);
    });
});

//Receptionist Routes
Route::prefix('receptionist')->name('receptionist.')->group(function () {

Route::middleware(['auth','role:receptionist'])->group(function () {
    Route::get('/', [DashbordController::class, 'index'])->name('dashbord');
         Route::group(['prefix' => 'geography'], function () {
             Route::get('get-state-by-country', [GeographyController::class, 'getStateByCountry'])->name('get-state-by-country');
                 Route::get('get-city-by-state', [GeographyController::class, 'getCityByState'])->name('get-city-by-state');
                     Route::get('get-shipping-by-city', [GeographyController::class, 'getShippingByCity'])->name('get-shipping-by-city');
    });


    Route::get('account-details/{id}', [ProfileController::class, 'index'])->name('case.profile.index');
    Route::post('profile-update/{id}', [ProfileController::class, 'updateProfile']);
    Route::post('change-password/{id}', [ProfileController::class, 'chnagePassword']);

    /// roles
    Route::resource('doctor', DoctorController::class);
    Route::get('clinic-doctors', [PatientController::class, 'clinicDoctors'])->name('get-doctor-by-clinic');

    Route::resource('clinic', ClinicController::class);
    Route::resource('clinic.doctor', ClinicDoctorController::class);
    Route::resource('slider', SliderController::class);

    Route::resource('setting', SettingController::class)->only([
        'index', 'store'
    ]);
});
});


/// Lab technician
Route::prefix('lab-technician')->name('lab-technician.')->group(function () {

 Route::get('clinic-doctors', [PatientController::class, 'clinicDoctors'])->name('get-doctor-by-clinic');
     Route::middleware(['auth','role:lab-technician'])->group(function () {
         Route::get('/', [DashbordController::class, 'index'])->name('dashbord');
             Route::group(['prefix' => 'geography'], function () {
                 Route::get('get-state-by-country', [GeographyController::class, 'getStateByCountry'])->name('get-state-by-country');
                     Route::get('get-city-by-state', [GeographyController::class, 'getCityByState'])->name('get-city-by-state');
                          Route::get('get-shipping-by-city', [GeographyController::class, 'getShippingByCity'])->name('get-shipping-by-city');
    });

    /// roles
    Route::resource('order', OrderController::class)->only([
            'index', 'edit', 'update', 'destroy'
    ]);

    Route::get('account-details/{id}', [ProfileController::class, 'index'])->name('case.profile.index');
    Route::post('profile-update/{id}', [ProfileController::class, 'updateProfile']);
    Route::post('change-password/{id}', [ProfileController::class, 'chnagePassword']);
     });
});

//Doctor Routes
Route::prefix(trans('siteConfig.subDomain.web.doctor'))->name('doctor.')->group(function () {

     Route::middleware(['auth','role:doctor'])->group(function () {

         Route::group(['prefix' => 'geography'], function () {
            Route::get('get-state-by-country', [GeographyController::class, 'getStateByCountry'])->name('get-state-by-country');
            Route::get('get-city-by-state', [GeographyController::class, 'getCityByState'])->name('get-city-by-state');
            Route::get('get-shipping-by-city', [GeographyController::class, 'getShippingByCity'])->name('get-shipping-by-city');
         });

         Route::get('/', [DoctorDashbordController::class, 'index'])->name('dashbord');
         Route::get('/new', [DoctorDashbordController::class, 'index_new'])->name('dashbord.new');
         Route::get('/agreement/{id}', [DoctorDashbordController::class, 'agreement'])->name('agreement');
         Route::get('/save_agreement', [DoctorDashbordController::class, 'save_agreement'])->name('save_agreement');

         Route::get('case/download-attachment/{case_id}', [CaseController::class, 'downloadAttachment'])->name('case.download-attachment');

         Route::resource('case', DoctorCaseController::class);

          Route::post('case/store/new', [DoctorCaseController::class, 'case_store'])->name('case.store.new');
         /* new route */

         Route::post('/delete_attachment', [DoctorCaseController::class, 'deleteAttachment'])->name('delete_attachment');
         Route::get('/case_detail/{id}', [DoctorCaseController::class, 'show_new'])->name('case.detail');
         Route::get('case/new/', [DoctorCaseController::class, 'index_new'])->name('case.new');
         Route::post('update_new_case', [DoctorCaseController::class,'update_new'])->name('update_new_case');

         Route::get('account-details/{id}', [ProfileController::class, 'index'])->name('case.profile.index');
            /* new route */
         Route::get('account-details-new/{id}', [ProfileController::class, 'index_new'])->name('case.profile.index.new');


         Route::post('profile-update', [ProfileController::class, 'updateProfile'])->name('profile-update');
         Route::post('change-password/{id}', [ProfileController::class, 'chnagePassword']);

         Route::post('update-clinics/{id}', [ProfileController::class, 'updateClinics']);

         Route::get('downloads', [ProfileController::class, 'downloads'])->name('case.profile.downloads');
         Route::get('accualigner-agreements', [ProfileController::class, 'agreement'])->name('case.profile.agreement');

         /* NEw Route  */
         Route::post('case/payment/index_new', [PaymentController::class, 'index_new'])->name('case.payment.store.new');

         Route::get('/order_edit/{id}', [OrderController::class, 'order_edit'])->name('order.edit.new');

         Route::post('case/payment/store', [PaymentController::class, 'store_new'])->name('case.payment.store');

         /*________digital scan_________*/
         Route::post('case/payment/store_digitalScan', [PaymentController::class, 'store_digital_scan'])->name('case.payment.store_digitalScan');
         Route::post('case/payment/invoice_digitalScan', [PaymentController::class, 'invoice_store_digital_scan'])->name('case.invoice.store_digitalScan');

         Route::post('case/payment/invoice', [PaymentController::class, 'invoice_store'])->name('case.invoice.store');

         Route::post('case/payment/invoice-store', [PaymentController::class, 'storeInvoice'])->name('case.payment.storeInvoice');
         Route::resource('case.payment', PaymentController::class);

         Route::post('case/missing-tray-update', [DoctorCaseController::class, 'missingTrayUpdate'])->name('case.missing-tray-update');

                  /// missing-tray new
         Route::get('case/order-missing-tray/{case}', [OrderAlignerController::class, 'missingTrayIndex'])->name('case.order-missing-tray.index');
         Route::post('case/order-missing-tray/stripe-store', [OrderAlignerController::class, 'missingTrayStoreStripe'])->name('case.order-missing-tray.storeStripe');
         Route::post('case/order-missing-tray/invoice-store', [OrderAlignerController::class, 'missingTrayStoreInvoice'])->name('case.order-missing-tray.storeInvoice');

         /*  New msiing tray */
         Route::post('case/order-missing-tray/new', [OrderAlignerController::class, 'missingTrayIndex_new'])->name('case.order-missing-tray.index.new');
         Route::post('case/order-missing-tray/stripe-store_new', [OrderAlignerController::class, 'missingTrayStoreStripe_new'])->name('case.order-missing-tray.storeStripe_new');
         Route::post('case/order-missing-tray/invoice-store-new', [OrderAlignerController::class, 'missingTrayStoreInvoice_new'])->name('case.order-missing-tray.storeInvoice.new');

         Route::post('case/order-aligner/invoice-store', [OrderAlignerController::class, 'storeInvoice'])->name('case.order-aligner.storeInvoice');

         Route::resource('case.order-aligner', OrderAlignerController::class);

          /* new Route */
          Route::post('case/agree_order', [OrderAlignerController::class, 'index2'])->name('case.agree_order');
          Route::post('case/agree_order/store_new', [OrderAlignerController::class, 'store_new'])->name('case.agree_order.store');
          Route::post('case/agree_order/store_inovice_new', [OrderAlignerController::class, 'storeInvoice_new'])->name('case.agree_order.storeInvoice.new');

         Route::get('get-shipping-detail', [OrderAlignerController::class, 'getShippingDetail'])->name('get-shipping-detail');
         Route::get('case/order-aligner/second-installment/{case}', [OrderAlignerController::class, 'indexSecondInstallment'])->name('case.order-aligner.indexSecondInstallment');
         Route::post('case/order-aligner/second-installment/{case}', [OrderAlignerController::class, 'storeSecondInstallment'])->name('case.order-aligner.storeSecondInstallment');

         /* new route */
         Route::post('case/order-aligner/invoice-store/second-installment_new', [OrderAlignerController::class, 'storeSecondInstallment_new'])->name('case.order-aligner.storeInvoiceSecondInstallment.new');
         Route::post('case/order-aligner/second-installment_new', [OrderAlignerController::class, 'indexSecondInstallment_new'])->name('case.order-aligner.indexSecondInstallment.new');
         Route::post('case/order-aligner/invoice-store/second-installment-new', [OrderAlignerController::class, 'storeInvoiceSecondInstallment_new'])->name('case.order-aligner.storeInvoiceSecondInstallment.new');
         Route::post('case/get-advices', [DoctorCaseController::class, 'getallAdvicesDoctor'])->name('case.add-advice');


         Route::post('case/order-aligner/invoice-store/second-installment/{case}', [OrderAlignerController::class, 'storeInvoiceSecondInstallment'])->name('case.order-aligner.storeInvoiceSecondInstallment');

         Route::post('case/impression-kit-received', [DoctorCaseController::class, 'impressionKitReceived'])->name('case.impression-kit-received');
         Route::post('case/aligner-kit-delivery', [DoctorCaseController::class, 'alignerKitDelivery'])->name('case.aligner-kit-delivery');
         Route::post('case/no-of-trays-update', [DoctorCaseController::class, 'noOfTraysUpdate'])->name('case.no-of-trays-update');
         Route::post('case/no-of-days-update', [DoctorCaseController::class, 'noOfDaysUpdate'])->name('case.no-of-days-update');
         Route::post('case/add-advice', [DoctorCaseController::class, 'addAdvice'])->name('case.add-advice');
         Route::post('case/upload-video', [DoctorCaseController::class, 'uploadVideo'])->name('case.upload-video');
         Route::post('case/delete-video', [DoctorCaseController::class, 'deleteVideo'])->name('case.delete-video');
         Route::post('case/embedded-video', [DoctorCaseController::class, 'embeddedVideo'])->name('case.embedded-video');

           /* new route */
         Route::post('case/upload-attachment2', [DoctorCaseController::class, 'uploadAttachment2'])->name('case.upload-attachment2');

         Route::post('case/upload-attachment', [DoctorCaseController::class, 'uploadAttachment'])->name('case.upload-attachment');
         Route::post('case/destroy-attachment', [DoctorCaseController::class, 'destroyAttachment'])->name('case.destroy-attachment');
         Route::post('get-clinic-patients', [DoctorCaseController::class, 'getClinicPatients'])->name('case.get-clinic-patients');
         Route::post('get-patient-detail', [DoctorCaseController::class, 'getPatientDetail'])->name('case.get-patient-detail');

         Route::get('case/{case}/reports/{tray_no?}', [DoctorCaseController::class, 'reports'])->name('case.reports');
         Route::get('case/{case}/wearing-time-report', [DoctorCaseController::class, 'wearingTimeReport'])->name('case.wearing-time-report');
         Route::post('case/report-by-date', [DoctorCaseController::class, 'reportByDateCon'])->name('case.report-by-date');
         Route::post('case/graph-report', [DoctorCaseController::class, 'graphReportCon'])->name('case.graph-report');
    });
});
