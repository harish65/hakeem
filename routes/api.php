<?php

use Illuminate\Http\Request;

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
//Route::get('request-test', 'API\ServiceController@test_time');
// Route::get('excel-file','Admin\CsvFilesController@getexcelfile');



Route::group(array('middleware'=>['log_after_request']), function(){
    Route::post('send-sms', 'SmsController@store');
    Route::post('send-email-otp', 'SmsController@sendEmailOtp');
    Route::post('email-verify', 'SmsController@verifyEmail');
    Route::any('webhook/razorpay', 'WebHookController@getHandleRazorPayWebhook');
    Route::any('webhook/stripe', 'WebHookController@getHandleStripeWebhook');
    Route::any('webhook/hyperpay', 'WebHookController@getHyperWebhook');
    Route::get('hyperpayreq', 'WebHookController@hyperPayRequest');
    //Copy and pay Routes Hyper pay Paymnet Gateway
    Route::get('webhook/preparecheckout', 'WebHookController@hyperpayCopyAndPay');  
    Route::get('webhook/hyperPayGetPaymentStatus', 'WebHookController@hyperPayGetPaymentStatus');  

    Route::group(["namespace"=>"API"],function() {
    Route::post('test-notification','UserController@testNotification');
    Route::post('test-call', 'CallerController@makeCallTestToken');

        /*app version */
        Route::post('appversion', 'DataController@appVersion');
        Route::get('clientdetail', 'DataController@getClientDetail');
        Route::get('countrydata', 'DataController@getCountryStateCity');
        Route::get('clientdetail_panel', 'DataController@getClientDetailForPanel');
        /* User Controller */
        Route::post('login', 'UserController@socialLogin');
        Route::get('user-check', 'UserController@checkUserExit');
        Route::post('verify-check-answer', 'UserController@checkVerifyAnswer');
        Route::get('security-questions', 'UserController@getSecurityQuestion');
        Route::post('reset-password', 'UserController@postResetPassword');
        Route::post('login2', 'UserController@socialLogin2');
        Route::post('forgot_password', 'UserController@forgot_password');
        Route::post('register', 'UserController@register');
        Route::post('register2', 'UserController@register2');
        Route::get('get-slots-list','ServiceController@getSlotsList');
        Route::get('get-pet-categories','PetController@getPetCategory');
        Route::get('get-pet-breed','PetController@getPetBreed');
        // Route::get('get-my-pets','PetController@getMyPets');
        /* Auth Routes */
        Route::get('wallet', 'CustomerController@getWalletBalance');
        Route::group(['middleware' => 'auth:api'], function() {
            Route::post('upload-certification', 'UserController@uploadCertification');
            Route::get('contact-list','CallerController@contactList');
            Route::post('contact-add','CallerController@addContactList');
            Route::post('contact-delete','CallerController@deleteContact');
            Route::post('contact-message','CallerController@sendContactMessage');
            Route::post('topic','CourseController@addTopic');
            Route::post('add-clinic','CurenikContoller@addClinic');
            Route::post('add-promo','CurenikContoller@addpromo');
            Route::post('default-clinic','CurenikContoller@defaultclinic');
            Route::delete('delete-clinic/{id}','CurenikContoller@deleteClinic');
            Route::get('tiers','CouponController@getTiers');
            Route::post('start-request','CallerController@startRequest');
            Route::post('start-call','CallerController@startCall');
            Route::post('change_password', 'UserController@change_password');
            Route::post('password-change', 'UserController@passwordChange');
            Route::post('update-security-question', 'UserController@updateSecurityQuestion');
            Route::post('profile-update', 'UserController@profieUpdate');
            Route::post('save-address', 'UserController@addAddress');
            Route::get('get-address', 'UserController@getAddress');
            Route::get('profile', 'UserController@getUserProfile');
            Route::post('update-phone', 'UserController@changePhoneNumber');
            Route::post('app_logout', 'UserController@app_logout');
            Route::get('delete-user', 'UserController@deleteUser');
            Route::get('delete-user-profile', 'UserController@deleteUserProfile');
            Route::get('getuser', 'UserController@GetUser');
            Route::post('update-fcm-id', 'UserController@updateFcmId');
            Route::get('getreferencelist', 'UserController@getReferenceByList');
            Route::get('getslotstime', 'UserController@getSlotsTime');
            Route::get('gethealthcarevisit', 'UserController@getHealthCareVisit');
            Route::get('gettypeofrecords', 'UserController@getTypeOfRecords');
            Route::get('getinvoicelist', 'UserController@getInvoiceList');
            Route::post('save_health_records', 'UserController@saveHealthRecords');
            Route::post('upload_profile_image', 'UserController@upload_profile_image');
            Route::get('gethealthrecordslist', 'UserController@getHealthRecordsList');
            Route::get('gethealthrecordsdetail', 'UserController@getHealthRecordsDetail');
            Route::post('edithealthrecords', 'UserController@editHealthRecords');
            Route::delete('deletehtrecords/{id}', 'UserController@destroy');
            Route::post('deletehtrecords', 'UserController@deletehtrecords');
            Route::delete('removeImage/{id}', 'UserController@removeImage');
            Route::post('saveMultipleImages', 'UserController@saveMultipleImages');
            Route::post('doctor-favourite','UserController@doctorFavourite');
       

            // For My Path
            Route::post('manual-available', 'UserController@postMannualAvailable');
            Route::get('online-flags', 'UserController@getOnlineFlags');
            Route::post('online-toggle', 'UserController@onlineToggle');
            Route::get('dates-slots', 'ServiceController@getSlotsByMultipleDates');
            Route::get('recent-view', 'ServiceController@getRecentList');
            Route::post('insurance-info', 'UserController@saveInsuranceInfo');
            /* askSupportQuestion  */
            Route::post('ask-questions', 'FeedController@askSupportQuestion');
            Route::post('reply-question', 'FeedController@replySupportQuestion');
            Route::get('ask-questions', 'FeedController@getaskSupportQuestion');
            Route::get('ask-question-detail', 'FeedController@getaskSupportQuestionDetail');

            Route::get('water-limit', 'FeedController@getWaterLimit');
            Route::post('water-limit', 'FeedController@postSetWaterLimit');
            Route::get('daily-usage', 'FeedController@getDailyUsage');
            Route::post('drink-water', 'FeedController@postDrinkWater');

            Route::get('protein-limit', 'ProteinController@getProteinLimit');
            Route::post('drink-protein', 'ProteinController@postDrinkProtein');
            Route::post('protein-limit', 'ProteinController@postSetProteinLimit');
            Route::get('daily-usage-protein', 'ProteinController@getDailyUsageProtein');

            Route::get('insurance-info', 'UserController@getUserInsuranceDetail');
            Route::post('add-family', 'UserController@addFamilyMember');
            /* Service Provider Controller */
            Route::get('wallet-sp', 'ServiceController@getWalletBalance');
            Route::get('advertisement', 'ServiceController@getAdvertiseMent');
            Route::post('set-filters', 'ServiceController@setFiltersForServiceProvider');
            Route::post('block-dates', 'ServiceController@postBlockDates');
            Route::get('block-dates', 'ServiceController@getBlockDates');
            Route::get('wallet-history-sp', 'ServiceController@getWalletHistory');
            Route::get('requests', 'ServiceController@getRequests');
            Route::get('cliniclist','ServiceController@getcliniclist');
            Route::get('waiting-screen','ServiceController@getwaitingscreen');
            Route::get('pending-request-by-date', 'ServiceController@getPendingRequestByDate');
            Route::post('accept-request', 'ServiceController@postAcceptRequest');
            Route::get('bank-accounts', 'ServiceController@getBankAccountsListing');
            Route::get('revenue', 'ServiceController@getRevenue');
            Route::post('subscribe-service', 'ServiceController@postSubscribe');
            Route::post('update-services', 'ServiceController@postSubscribeServiceOrFilters');
            Route::post('update-sp-categories', 'ServiceController@postServiceOrFilters');
            Route::post('manual-update-services', 'ServiceController@postMannualSubscribeService');
            Route::post('create-banner', 'DataController@addBanner');
            Route::post('delete-banner', 'DataController@deleteBanner');
            Route::get('master/selected/preferences', 'DataController@getSelectedMasterPreferences');
            Route::post('master/preferences/custom', 'DataController@postCustomMasterPreferences');

            Route::post('v2/master/preferences', 'FeedController@postV2MasterPreferences');
            Route::post('start-chat', 'ServiceController@postStartChat');
            Route::post('pre_screptions', 'ServiceController@postAddPreScriptions');
            Route::post('test_pre_scription', 'ServiceController@postAddPreScriptionssssss');
            Route::get('patient-list', 'ServiceController@getPatientList');
            Route::get('patient-curenik-list','ServiceController@getCurenikPatientList');
            Route::post('create-referal','ServiceController@postreferal');
            Route::get('request-detail', 'ServiceController@getRequestDetailById');
            Route::post('call-status', 'ServiceController@postCallStausChange');
            Route::post('create-package', 'PackageController@createPackage');
            Route::get('get-physio-slots', 'ServiceController@getCustomSlots');
            Route::post('post-physio-slots', 'ServiceController@postCustomSlots');
            Route::get('appointment-dates', 'ServiceController@getAppointmentByMonthDates');
            Route::post('create-medical-history', 'ServiceController@addMedicalHistory');
            Route::get('get-medical-history', 'ServiceController@getMedicalHistory');
            /* Customer Controller */

            // Route::get('wallet', 'CustomerController@getWalletBalance');
            Route::post('extra-payment', 'CustomerController@appointmentExtraPayment');
            Route::post('pay-extra-payment', 'CustomerController@acceptAppointmentExtraPayment');
            Route::get('wallet-history', 'CustomerController@getWalletHistory');
            Route::get('requests-cs', 'CustomerController@getRequestByCustomer');
            Route::get('cards', 'CustomerController@getPaymentCardListing');
            Route::post('create-request', 'CustomerController@postCreateRequest');
            Route::post('curenik-create-request', 'CustomerController@postcurenikCreateRequest');
            Route::post('update-request-symptoms', 'CustomerController@updateRequestSymptoms');
            Route::post('update-request-prefrences', 'CustomerController@updateRequestPrefrences');
            Route::post('request-user-approve', 'CustomerController@updateUserRequestStatus');
            Route::get('request-check', 'CustomerController@checkRequestCreated');
            Route::post('auto-allocate', 'CustomerController@postAutoAllocateRequest');
            Route::post('iedu-confirm-request', 'CustomerController@postIeduConfirmRequest');
            Route::post('iedu-create-request', 'CustomerController@postIeduCreateRequest');
            Route::post('cancel-request', 'CustomerController@postCancelRequest');
            Route::post('confirm-request', 'CustomerController@postConfirmRequest');
            Route::post('v2/confirm-request', 'UberLikeContoller@postConfirmRequest');
            Route::post('v2/create-request', 'UberLikeContoller@postCreateRequest');
            Route::get('v2/pendig-requests', 'UberLikeContoller@getPendingRequest');
            Route::post('v2/accept-request', 'UberLikeContoller@postAcceptRequest');
            Route::post('v2/cancel-request', 'UberLikeContoller@postCancelRequest');
            Route::post('add-review', 'CustomerController@postAddReview');
            Route::post('care-plans', 'CustomerController@postCarePlan');
            Route::post('update-care-plans', 'CustomerController@postUpdateCarePlan');

            /* Payment Controller */
            Route::post('add-money', 'PaymentController@postAddMoney');
            // for petpal consult project payment gateway
            Route::post('money-status', 'PaymentController@paymentTransaction');

            Route::post('paymentcheck', 'PaymentController@PayPhone');
            Route::Post('paymentdone', 'PaymentController@PayPhoneSuccess')->name('payment.start');
            Route::post('purchase-package', 'PaymentController@postPurchasePackage');
            Route::post('add-card', 'PaymentController@postAddCard');
            Route::post('update-card', 'PaymentController@updateCard');
            Route::post('delete-card', 'PaymentController@deleteCard');
            Route::post('complete-chat', 'PaymentController@postCompleteChat');
            Route::post('add-bank', 'PaymentController@postAddBankAccount');
            Route::post('payouts', 'PaymentController@payoutWalletToBankAccount');
            Route::post('enroll-user','PaymentController@postPayEnroll');
            // Route::post('order/create','PaymentController@postAddOrder');
            


            /* Chat Controller */
            Route::post('message', 'ChatController@sendMessage');
            Route::get('chat-listing', 'ChatController@getChatListing');
            Route::get('chat-messages', 'ChatController@getMessages');

            /* Caller Controller */
            Route::post('make-call','CallerController@makeCallRequest');

            Route::get('notifications','NotificationController@getNotificationList');
            Route::post('feeds', 'FeedController@store');
            Route::get('support-packages', 'PackageController@getSupportPackage');
            Route::post('feeds/update/{feed_id}', 'FeedController@postUpdateFeed');
            Route::post('feeds/delete/{feed_id}', 'FeedController@postDeleteFeed');
            Route::get('feeds/view', 'FeedController@postViewFeed');
            Route::get('faqs', 'FeedController@getFAQs');
            Route::post('feeds/add-favorite/{feed_id}', 'FeedController@addToFavorite');
            Route::post('feeds/add-comment/{feed_id}', 'FeedController@addToComment');
            Route::post('feeds/add-like/{feed_id}', 'FeedController@addToLike');
            Route::get('feeds/view/{feed_id}', 'FeedController@postViewFeed');
            /* Category Controller */
            Route::post('add-class','CategoryController@postCreateClass');
            Route::get('classes','CategoryController@getClasses');
            Route::post('class/status','CategoryController@putClassStatusChange');
            Route::post('class/join','CategoryController@joinClassByUser');
            Route::get('class/detail','CategoryController@getClassDetail');
            Route::post('additional-detail-data','CategoryController@postAdditionalFields');
            Route::post('sub-pack','CategoryController@postPackages');
            Route::post('subscription-pack','CouponController@postSubscriptionPlan');
            Route::post('subscription-topic','CouponController@postSubscriptionTopic');
            Route::get('pack-detail','CategoryController@getPackageDetail');
            Route::get('subscription-detail','CouponController@getSubscriptionDetail');
            Route::get('get-user-slots', 'CustomerController@getSlotsByDates');
            /* Subscribe Controller */
            Route::post('subscribe-plan','SubscribeController@postSubscribePlan');
            /* Operation Controller */
            Route::post('add-operation','OperationController@addOperation');
            Route::post('change-status','OperationController@changeStatusOperation');
            Route::post('edit-operation','OperationController@editOperation');
            Route::post('delete-operation','OperationController@deleteOperation');
            Route::get('get-operations', 'OperationController@getOperations');
            Route::post('get-doctor-operations', 'OperationController@getOperationsById');

            Route::post('group/assign', 'GroupController@assignVendorToGroup');
            Route::post('verification/insurance', 'DataController@verifyEligibility');
            Route::post('master/custom/masterfields', 'DataController@postCustomMasterFields');
            Route::get('master/custom/masterfields', 'DataController@getCustomMasterFields');

            Route::post('sp-course','CourseController@postspcourses');

            //New Customization by suraj
            Route::post('add-new-pet-profile','PetController@createPetProfile');
            Route::get('get-my-pets','PetController@getMyPets');
            Route::get('get-pets','PetController@ParticularPet');
            Route::post('update-pet-profile','PetController@updatePetProfile');
            Route::get('delete-pet-profile','PetController@deletePetProfile');

            //customization for vaccination for pet profiles
            Route::get('get-vaccination','VaccinationController@getVaccination');
            Route::post('add-vaccination','VaccinationController@createVaccination');
            Route::get('edit-vaccination','VaccinationController@editVaccination');
            Route::post('update-vaccination','VaccinationController@updateVaccination');
            Route::get('delete-vaccination','VaccinationController@deleteVaccination');

             //customization for medicines for pet profiles
             Route::get('get-medicine','MedicinesController@getMedicine');
             Route::post('add-medicine','MedicinesController@createMedicine');
             Route::get('edit-medicine','MedicinesController@editMedicine');
             Route::post('update-medicine','MedicinesController@updateMedicine');
             Route::get('delete-medicine','MedicinesController@deleteMedicine');
             Route::get('services', 'ServiceController@getServiceList');

        });
        //End auth api 
        Route::post('order/create','PaymentController@createHyperPayPrepareCheckout');
        Route::post('razor-pay-webhook','PaymentController@postWebhookRazorPay');
        Route::get('feeds', 'FeedController@index');
        Route::get('feeds/comments/{feed_id}', 'FeedController@getComments');
        Route::get('tips', 'FeedController@getTips');

        Route::get('groups', 'GroupController@groupsListing');
        Route::get('group-doctors', 'GroupController@groupsDoctorListing');
        Route::post('group/create', 'GroupController@createGroup');
        Route::get('testing','ServiceController@testing');

        Route::post('send-request-emergency', 'ServiceController@SendRequestEmergency');

        Route::post('cancel-request-emergency', 'ServiceController@CancelRequestEmergency');

        Route::post('contact-us','DataController@contactus');

        Route::get('pack-sub','CategoryController@getPackages');
        Route::get('pandemic','DataController@getPandemicList');
        Route::get('review-list', 'ServiceController@getDoctorReviewList');
        Route::get('home', 'DataController@getHomePageData');

        Route::get('plans', 'DataController@getPlans');
        Route::get('doctor-detail', 'ServiceController@getDoctorDetailById');
        Route::get('get-slots', 'ServiceController@getSlotsByDates');
        Route::get('get-date-slots', 'ServiceController@getSlotsByDatesdoctor');
        Route::get('coupons','CouponController@getCoupons');
        Route::get('categories','CategoryController@getCategories');
        Route::get('pincodes','PincodeController@getPincodes');
        Route::get('additional-details','CategoryController@getAdditionalFields');
        Route::get('additional-documents','CategoryController@getAdditionalDocuments');

        Route::get('sp-categories','CategoryController@getCategoriesViaServiceProvider');
        Route::get('doctor-list', 'ServiceController@getDoctorList');
        Route::get('clinic-doctor-list', 'ServiceController@doctorListFromClinic');
        Route::get('v2/doctor-list', 'UberLikeContoller@getDoctorList');
        Route::get('sp-list', 'ServiceController@getSPList');
        Route::get('auto-allocate', 'ServiceController@getDoctorData');

        Route::get('banners', 'ServiceController@getBannerList');
        Route::get('advertisements', 'ServiceController@getAdvertisementList');
        Route::get('clusters', 'ServiceController@getClusterList');
        Route::post('callback_exotel','CallerController@callbackExotel');
        Route::any('call','CallerController@callTwillio');
        Route::any('call1','CallerController@callTwillio');
        Route::any('placeCall','CallerController@placeCall');
        Route::any('incoming','CallerController@incoming');
        Route::any('accessToken','CallerController@accessTokenTwillio');
        Route::any('callback','CallerController@twillioCallback');
        Route::get('get-filters', 'ServiceController@getFiltersForServiceProvider');
        Route::get('pages', 'DataController@getPageContent');
        Route::get('master/preferences', 'DataController@getMasterPreferences');
        Route::get('master/duty', 'DataController@getMasterPreferencesDuty');
        Route::get('symptoms', 'DataController@getMasterSymptoms');
        Route::get('getsymptoms', 'DataController@getCategorySymptoms');
        Route::post('update-user-symptoms', 'DataController@updateUserCategorySymptoms');
        Route::post('upload-image', 'UserController@uploadImage');

        /* Course Controller */
        Route::get('courses','CourseController@getcourses');
        Route::get('topic-list','CourseController@getTopicList');
        Route::get('topic-detail','CourseController@getTopicDetail');
        Route::get('emsats','CourseController@getEmsatList');
        Route::get('subscriptions','CouponController@getSubscriptionList');
        Route::get('emsat-teachers','CourseController@getTeacherList');
        Route::post('claimmd/v1/eligibility', 'InsuranceController@verifyEligibility');
        Route::post('claimmd/v2/eligibility', 'InsuranceController@verifyEligibilityV2');
        //API For Clinic Listing
        Route::get('clinics','ClinicController@getAllClinics');
        Route::get('clinic-doctors','ClinicController@getClinicDoctors');
    });

    



});

