<?php

// use App\Http\Controllers\Api\Auth\AuthController;

use App\Http\Controllers\Api\Doctor\Appointment\DoctorAppointmentController;
use App\Http\Controllers\Api\Doctor\Auth\DoctorAuthController;
use App\Http\Controllers\Api\Doctor\User\UserController as DoctorUserController;
use App\Http\Controllers\Api\Patient\Clinic\ClinicController;
use App\Http\Controllers\Api\Patient\Appointment\PatientAppointmentController;
use App\Http\Controllers\Api\Patient\Auth\PatientAuthController;
use App\Http\Controllers\Api\Patient\CaseController\CaseController;
use App\Http\Controllers\Api\Patient\CaseController\CaseAttachmentController;
use App\Http\Controllers\Api\Patient\CaseController\CaseSelfieController;
use App\Http\Controllers\Api\Patient\CaseController\CaseTimeLogController;
use App\Http\Controllers\Api\Patient\ClinicalConditionController;
use App\Http\Controllers\Api\Patient\Order\OrderAlignerKitController;
use App\Http\Controllers\Api\Patient\Order\OrderController;
use App\Http\Controllers\Api\Patient\Order\OrderImpressionKitController;
use App\Http\Controllers\Api\Patient\Reports\AverageReportController;
use App\Http\Controllers\Api\Patient\Reports\CaseReportController;
use App\Http\Controllers\Api\Patient\Slider\SliderController;
use App\Http\Controllers\Api\Patient\User\AddressController;
use App\Http\Controllers\Api\Patient\User\UserController as PatientUserController;
use App\Http\Controllers\Api\Setting\SettingController;
use App\Models\CaseSelfie;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/', function () {
    return successJsonResponse_h('In Api');
});

Route::get('setting', [SettingController::class, 'index']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::controller(AuthController::class)->group(function(){
//     Route::post('register', 'register');
//     Route::post('login', 'login');
// });

Route::group(['prefix'=>'patient'],function(){
    Route::controller(PatientAuthController::class)->group(function(){
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('social-login', 'socialLogin');

        //forgot password
        Route::post('forgot-password', 'forgotPassword');
        Route::post('verify-reset-password', 'verifyResetPassword');
        Route::post('reset-password', 'resetPassword');
    });


    Route::middleware(['auth:sanctum', 'isPatient'])->group(function(){

        Route::group(['prefix'=>'user'],function(){
            Route::controller(PatientUserController::class)->group(function(){
                Route::post('/update', 'UpdateUser');
                Route::get('/', 'getUser');
            });
            Route::apiResource('address', AddressController::class);
        });

        Route::group(['prefix'=>'clinic'],function(){
            Route::controller(ClinicController::class)->group(function(){
                Route::get('all', 'getClinics');
                
                Route::group(['prefix'=>'doctor'],function(){
                    Route::get('all', 'getClinicDoctors');
                    Route::post('add-patient', 'addPatient');
                });

            });
        });
        
        //Appointment
        Route::group(['prefix'=>'appointment'],function(){
            Route::controller(PatientAppointmentController::class)->group(function(){
                Route::get('booked-date', 'getAppointmentBookedDate');
                Route::post('add', 'addAppointment');
                Route::get('get', 'getAppointments');
                Route::get('detail', 'getAppointmentDetail');
                Route::post('start', 'startAppointment');
                Route::post('cancel', 'cancelAppointment');

            });
        });

        //Order
        Route::group(['prefix'=>'order'],function(){

            Route::group(['prefix'=>'impression-kit'],function(){
                Route::get('/', [OrderImpressionKitController::class, 'index']);
                Route::post('/', [OrderImpressionKitController::class, 'create']);
            });

            Route::group(['prefix'=>'aligner-kit'],function(){
                Route::get('/', [OrderAlignerKitController::class, 'index']);
                Route::post('/', [OrderAlignerKitController::class, 'create']);
            });
            
            Route::controller(OrderController::class)->group(function(){
                Route::group(['prefix'=>'{order_id}'],function(){
                    Route::post('add-address', 'addAddress');
                    
                    Route::group(['prefix'=>'shipping-charges'],function(){
                        Route::get('get', 'getShipping');
                        Route::post('add', 'addShipping');
                    });

                    Route::post('checkout', 'checkout');
                });
            });
        });

        Route::get('slider', [SliderController::class, 'index']);
        Route::get('clinical-conditions', [ClinicalConditionController::class, 'index']);

        //Case
        Route::group(['prefix'=>'case'],function(){
            Route::post('processing-fee-paid/{case}', [CaseController::class, 'processingFeePaid']);
            Route::post('add-concern/{case}', [CaseController::class, 'addConcern']);
            //Route::post('update-no-of-trays/{case}', [CaseController::class, 'updateNoOfTrays']);
            //Route::post('update-no-of-days/{case}', [CaseController::class, 'updateNoOfDays']);
            Route::post('update-switch-time/{case}', [CaseController::class, 'updateSwitchTime']);

            Route::post('check-in/{case}', [CaseTimeLogController::class, 'checkIn']);
            Route::post('check-out/{case_time_log}', [CaseTimeLogController::class, 'checkOut']);
            Route::get('timelogs/{case}', [CaseTimeLogController::class, 'timelogs']);
            Route::get('timelogUpdateCheckoutCron', [CaseTimeLogController::class, 'timelogUpdateCheckoutCron']);
            
            // Route::post('add-selfie/{case}', [CaseSelfieController::class, 'store']);
            // Route::post('get-selfie/{case}', [CaseSelfieController::class, 'index']);

            Route::group(['prefix'=>'attachment'],function(){
                Route::controller(CaseAttachmentController::class)->group(function(){
                    Route::post('/', 'store');
                    Route::delete('{id}', 'destroy');
                });
            });
            
        });
        Route::apiResource('case', CaseController::class);
        Route::apiResource('case.selfie', CaseSelfieController::class);


        //report
        Route::group(['prefix'=>'report'],function(){
            Route::group(['prefix'=>'case/{case}'],function(){
                Route::post('average', [AverageReportController::class, 'averageReportByDays']);
                Route::post('by-date', [CaseReportController::class, 'reportByDate']);
                Route::post('by-day', [CaseReportController::class, 'reportByDay']);
            });
            
        });

    });
    
});

Route::group(['prefix'=>'doctor'],function(){
    Route::controller(DoctorAuthController::class)->group(function(){
        Route::post('register', 'register');
        Route::post('login', 'login');
        
        //forgot password
        Route::post('forgot-password', 'forgotPassword');
        Route::post('verify-reset-password', 'verifyResetPassword');
        Route::post('reset-password', 'resetPassword');
    });

    Route::middleware(['auth:sanctum', 'isDoctor'])->group(function(){
        
        Route::group(['prefix'=>'user'],function(){
            Route::controller(DoctorUserController::class)->group(function(){
                Route::post('/update', 'UpdateUser');
                Route::get('/', 'getUser');
            });
        });

        //Appointment
        Route::group(['prefix'=>'appointment'],function(){
            Route::controller(DoctorAppointmentController::class)->group(function(){
                Route::get('get', 'getAppointments');
                Route::get('detail', 'getAppointmentDetail');
                Route::post('cancel', 'cancelAppointment');
                Route::post('start', 'startAppointment');
                Route::post('add-treatment-plan', 'addTreatmentPlan');
            });
        });

    });
});
