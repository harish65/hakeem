<?php
use App\Http\Controllers\Web\PaymentController;
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

// Route::Get('paymentcheck', 'API\PaymentController@PayPhone');

Route::get('payment/success',[PaymentController::class,'paymentSuccess']);

Route::get('web/blogs', 'HomeController@getBlogListing');
Route::any('data_deletion_fb', 'HomeController@DataDeltionRequest')->name('data_deletion_fb');
Route::any('deletion', 'HomeController@DataDeltionRequestStatus')->name('status_deletion_fb');
Route::get('generate-pdf', 'DynamicPDFController@pdfview')->name('generate-pdf');
Route::get('generate-physo','DynamicPDFController@physoview');
Route::get('getinvoicelist', 'DynamicPDFController@pdfInvoiceview');
Route::get('getinvoice', 'DynamicPDFController@pdfInvoiceview2');

Route::post('email/otp', 'Web\CustomerController@sendEmailOtp');
Route::post('send/otp', 'Web\CustomerController@Otp');

Route::get('pages', 'PagesController@termscondition')->name('termscondition');
Route::get('download/{file_name}', 'HomeController@download')->name('download');
Route::group(array('middleware' => ['log_after_request']), function () {
    Route::any('webhook/razorpay', 'WebHookController@getHandleRazorPayWebhook');
    Route::any('webhook/paystack', 'WebHookController@getHandlePayStackWebhook');
    Route::any('webhook/stripe', 'WebHookController@getHandleStripeWebhook');
    Route::any('al_rajhi_bank/webhook', 'WebHookController@getHandleAlRajhiWebhook');
    Route::any('webhook/hyperpay', 'WebHookController@getHyperWebhook');
    Route::any('webhook/telr', 'WebHookController@getHandleTelrWebhook');
    //Copy and pay Routes Hyper pay Paymnet Gateway
    Route::get('webhook/preparecheckout', 'WebHookController@hyperpayCopyAndPay');  


});
Route::post('query_post', 'HomeController@queryPost');
Route::post('request_demo', 'HomeController@postRequestDemo');
/* Iedu Route*/
Route::post('custom/login', 'Auth\CustomLoginController@customLogin')->name('custom-login');
Route::post('custom/sigup_validation', 'Auth\CustomLoginController@customSigupValidation')->name('custom-sigup_validation');
Route::post('custom/sigup', 'Auth\CustomLoginController@customSigup')->name('custom-sigup');
/* End Iedu Route*/
/* Care Coonect Live */

Route::post('forgot/password', 'HomeController@checkEmailUserNameExistornot')->name('custom-forgot-password');
Route::post('reset/password', 'HomeController@ResetPassword')->name('reset-password');
Route::post('custom/forgot', 'Auth\CustomLoginController@checkEmailUserNameExist')->name('custom-forgot');
Route::post('custom/question-verify', 'Auth\CustomLoginController@checkVerifyAnswer')->name('custom-verifyanswer');
Route::post('custom/reset-password', 'Auth\CustomLoginController@postResetPassword')->name('custom-reset-password');
Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback/google', 'Auth\LoginController@handleProviderCallback');
Route::get('/callback/facebook', 'Auth\LoginController@handleProviderCallbackFacebook');

Route::group(['domain' => env('GOD_PANEL'), 'middleware' => ['godpanel']], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

    Route::group(['middleware' => 'auth', 'namespace' => 'GodPanel'], function () {
        Route::get('clients', 'GodPanelController@getClients')->name('clinets');
        Route::get('client/{client_id}/features', 'ClientController@getClientFeatures')->name('client-features');
        Route::post('client/{client_id}/features/update', 'ClientController@postClientFeatureUpdate')->name('client-features-update');

        Route::get('features', 'FeaturesController@getFeaturePage')->name('features');
        Route::get('features/new', 'FeaturesController@addNewFeaturePage')->name('features-new');
        Route::post('features/new', 'FeaturesController@postNewFeature')->name('features-new');
        Route::get('features/edit/{feature_id}', 'FeaturesController@getEditFeaturePage')->name('edit-feature');
        Route::post('features/edit/{feature_id}', 'FeaturesController@postEditFeature')->name('edit-feature');

        Route::post('feature_type/new', 'FeaturesController@postFeatureType')->name('feature-type-new');
        Route::post('feature_type/update', 'FeaturesController@updateFeatureType')->name('feature-type-update');

        Route::get('subscriptions', 'FeaturesController@getSubscriptionPage')->name('subscriptions');
        Route::get('subscriptions/new', 'FeaturesController@createSubscriptionPage')->name('add-subscription');
        Route::post('subscriptions/new', 'FeaturesController@postSubscription')->name('add-subscription');
        Route::get('subscriptions/edit/{subsc`                              ription_id}', 'FeaturesController@editSubscriptionPage')->name('edit-subscription');
        Route::put('subscriptions/edit/{subscription_id}', 'FeaturesController@updateSubscription')->name('edit-subscription');

        Route::get('client/create', 'GodPanelController@getClientForm')->name('clinet-create');
        Route::post('client/create', 'GodPanelController@postClientCreate')->name('clinet-create');
        Route::get('godpanel/dashboard', 'GodPanelController@getDashboard')->name('godpanel-dashboard');
        Route::get('godpanel/variables', 'GodPanelController@getVariables')->name('get-godpanel-variables');
        Route::post('godpanel/variables/update', 'GodPanelController@postUpdateVariables')->name('godpanel-variables');
        Route::post('godpanel/check-domain', 'GodPanelController@checkDomain')->name('check-domain');
    });
});
Route::get('web/about-us', 'HomeController@getAboutUs')->name('about-us');
Route::get('support', 'HomeController@getSupportPage');
Route::get('web/doctor', 'HomeController@getWebDoctorPage');
Route::get('web/login', 'HomeController@getWebLoginPage');
Route::get('web/sign-up', 'HomeController@getWebSignupPage');
Route::get('web/courses', 'Web\IeduController@getWebCoursesPage');
Route::get('web/emsats', 'Web\IeduController@getWebEmsatsPage');
Route::get('web/tutor/course/{id}', 'Web\IeduController@getWebCourseDetail');
Route::get('web/stdudy-material', 'Web\IeduController@getStudyMaterial');
Route::get('web/grade', 'Web\IeduController@getgradesubjetcs');
Route::get('web/stdudy-material-detail/{id}', 'Web\IeduController@getStudyMaterialDetail');
Route::get('web/patient', 'HomeController@getWebPatientPage');
Route::get('web/support', 'HomeController@getWebSupportPage');
Route::get('web/blog-view/{blog_id}', 'HomeController@getBlogView');
Route::get('web/contact-us', 'HomeController@getContactUs')->name('contact-us');
Route::get('web/covid-19', 'HomeController@getCovid19')->name('covid-19');
Route::get('web/nurse-professionals', 'HomeController@getNurseProfessionals')->name('nurse-prof');
Route::get('web/homecare', 'HomeController@getHomepageHomecare')->name('homecare');
Route::get('web/dashboard', 'HomeController@getWebDasboard')->name('web-dashboard');
Route::get('web/jobs', 'HomeController@getWebDasboardJob')->name('web-jobs');
Route::get('web/nurses', 'HomeController@getWebDasboardNurses')->name('web-nurses');
Route::get('web/facility', 'HomeController@getWebDasboardFacility')->name('web-facility');
Route::get('web/facility-form', 'HomeController@getWebFacilityForm')->name('facility-form');

/* care connect live */
Route::post('/users/register', 'HomeController@register')->name('user.register');
Route::post('/users/verifyPhone', 'HomeController@verifyPhone')->name('user.verifyPhone');
Route::post('/users/resendotp', 'HomeController@resendOtp')->name('user.resendOtp');
Route::post('/users/resendotpemail', 'HomeController@resendOtpEmail')->name('user.resendOtpEmail');
Route::post('/users/login', 'HomeController@login')->name('user.login');
Route::get('/profile/profile-setup-one/{id}', 'ProfileController@profileSetupOne')->name('profile.profileSetupOne');
Route::post('/profile/edit', 'ProfileController@editProfile');
Route::get('/profile/doc_categories', 'ProfileController@getDocCategories');
Route::get('/profile/profile-step-two/{id}', 'ProfileController@profileStepTwo')->name('profile.profileStepTwo');
Route::get('/users/delete/{id}','HomeController@deleteUser')->name('user.deleteUser');

Route::get('/profile/profile-step-two-course/{id}', 'ProfileController@profileStepTwoCourse')->name('profile.profileStepTwoCourse');
Route::get('/profile/profile-step-two-emsat/{id}', 'ProfileController@profileStepTwoEmsat')->name('profile.profileStepTwoEmsat');
Route::get('/profile/profile-step-two-upload-documents/{id}', 'ProfileController@profileStepTwoUploadDocuments')->name('profile.profileStepTwoUploadDocuments');
Route::post('sp-course', 'ProfileController@postspcourses');
Route::post('sp-emsat', 'ProfileController@postspemsats');
Route::post('/profile/add_categories', 'ProfileController@postCategories');
Route::get('/profile/docs', 'ProfileController@getDocs');



Route::get('/profile/docs_by_category', 'ProfileController@getDocsByCategories');
Route::post('/profile/add_doc', 'ProfileController@postAddDoc');
Route::get('/profile/doc_delete/{id}', 'ProfileController@deleteDoc');
Route::get('/profile/doc_edit/{id}', 'ProfileController@getEditDoc');
Route::post('/profile/edit_doc', 'ProfileController@postEditDoc');

Route::post('/profile/add_availbility', 'ProfileController@addAvailbility');

Route::get('/profile/edit_availbility/{id}', 'ProfileController@editAvailbility');
Route::post('/profile/edit_availbility', 'ProfileController@postEditAvailbility');

Route::get('/profile/edit_availbility_new/{id}', 'ProfileController@editAvailbilityNew');

Route::post('/profile/submitServiceType', 'ProfileController@submitServiceType');

Route::post('/profile/add_service_type_avail', 'ProfileController@postAddServiceTypeAvail');
Route::post('/profile/remove_service_type_avail', 'ProfileController@postRemoveServiceTypeAvail');
Route::post('/profile/update_service_type_avail', 'ProfileController@postUpdateServiceTypeAvail');

Route::get('/profile/profile-step-three/{id}', 'ProfileController@profileStepThree')->name('profile.profileStepThree');
Route::get('/profile/profile-step-four/{id}', 'ProfileController@profileStepFour')->name('profile.profileStepFour');
Route::get('/profile/profile-step-four-availbility/{id}', 'ProfileController@profileStepFouravailbility')->name('profile.profileStepFouravailbility');
Route::post('/profile/setFilters', 'ProfileController@setFiltersForServiceProvider')->name('profile.setFiltersForServiceProvider');
Route::get('/users/experts_list', 'CustomerController@viewExperts')->name('users.experts_list');


/* end care connect live */
Route::get('/', 'HomeController@homePage')->name('index');
Route::get('get/cities', 'HomeController@getCities');
Route::get('get/city_deatils', 'HomeController@getCityDetails');
Route::group(['middleware' => 'auth', 'prefix' => '/'], function () {
    Route::get('third', 'RoutingController@thirdLevel')->name('third');
    Route::get('second', 'RoutingController@secondLevel')->name('second');
    Route::get('any', 'RoutingController@root')->name('any');
});
Route::get('admin/', function () {
    return redirect()->action('Auth\LoginController@showLoginForm');
});

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::any('logout', 'Auth\LoginController@logout')->name('logout');
// CLINIC LOGIN METHODS
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');




/* MYPATH SIGN-UP FORMS */
Route::get('register/service_provider', 'Auth\RegisterController@showRegistrationForm');
Route::get('register/service_provider2', 'Auth\RegisterController@showRegistrationForm2');
Route::get('register/service_provider3', 'Auth\RegisterController@showRegistrationForm3');
Route::post('register/service_provider', 'Auth\RegisterController@mypathRegister');
Route::post('register/makeonline', 'Auth\RegisterController@mypathRegister');
Route::get('register/user  ', 'Auth\RegisterController@showMypathUserRegister');
Route::post('register/user', 'Auth\RegisterController@postMypathUserRegister');

/*END MYPATH*/
Route::post('register', 'Auth\RegisterController@register');
Route::get('home', 'Auth\LoginController@showHomePage')->name('home');



Route::post('sendmessage', 'API\ChatController@sendMessage');
Route::post('send_link', 'SmsController@sendLink');
Route::get('/chat', function () {
    return view('chat');
});
//manage Doctor availabilty
Route::get('service_provider/get_manage_availibilty/{id}', 'Web\ServiceProviderController@getManageAvailibilty');
Route::group(array('namespace' => 'Admin', 'prefix' => 'clinic', 'middleware' => 'auth'), function () {
    Route::get('dashboard', 'AdminController@getDashboard')->name('admin_dashboard');
    Route::get('add_doctor', 'DoctorController@create')->name('add_doctor');
    Route::get('upload_documnets/{id}', 'DoctorController@uploadDocuments')->name('upload_documnets');
    Route::get('edit_upload_documnets/{id}', 'DoctorController@editUploadDocuments')->name('edit_upload_documnets');
    Route::get('update_upload_documnets/{id}/{docID}', 'DoctorController@updateUploadDocuments')->name('update_upload_documnets');
    Route::post('update-document', 'DoctorController@updateDocuments')->name('update-document');
    Route::post('doc_delete', 'DoctorController@deleteDoc');
    Route::post('doctor_delete', 'DoctorController@deleteServiceProvider');    
    Route::get('sub-categories/{id}','DoctorController@getSubCategories')->name('sub-categories');
     
    
});

Route::group(array('namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'), function () {
    Route::get('dashboard', 'AdminController@getDashboard')->name('admin_dashboard');
    Route::resource('slots', 'SlotController');
    Route::resource('healthCareVisit', 'HealthCareVisitController');
    Route::resource('typeOfRecord', 'TypeOfRecordsController');
    Route::get('Trevenue', 'AdminController@getRevenueByCategory');
    Route::get('send/email', 'AdminController@getSendEmail');
    Route::post('send/email', 'AdminController@postSendEmail');

    Route::get('update_schedule', 'AdminController@getScheduleTime')->name('update_schedule');
    Route::get('ad-hoc', 'AdminController@adHocSync')->name('ad-hoc');
    Route::post('update_schedule', 'AdminController@postScheduleTime');

    Route::resource('waiting', 'WaitingScreenController');
    Route::resource('csvfiles', 'CsvFilesController');
    Route::get('centre/doctors', 'AdminController@getCustomServiceProvider');
    Route::post('centre/doctor/delete', 'AdminController@postCustomServiceProviderDelete');
    Route::get('centre/doctor/{id}/edit', 'AdminController@getCustomServiceProviderEdit');
    Route::post('centre/doctor/update', 'AdminController@postCustomServiceProviderEdit');
    Route::get('centre/doctor/create', 'AdminController@addCustomServiceProvider');
    Route::post('centre/doctor/create', 'AdminController@postCustomServiceProvider');
    Route::post('assign/doctor', 'AdminController@postAssignDoctor');
    Route::get('feature-types', 'AdminController@getFeatureTypes')->name('admin_feature_types');
    Route::post('feature-types/{feature_type_id}', 'AdminController@postFeatures');
    Route::get('feature-types/{feature_type_id}', 'AdminController@getFeaturesByType')->name('admin_features');
    Route::get('payouts', 'AdminController@getPayoutRequest')->name('payouts');
    Route::get('payouts/{payout_id}/view', 'AdminController@getPayoutRequestView')->name('payout-view');
    Route::post('payouts/paid/{payout_id}', 'AdminController@postPayoutRequestMark')->name('payouts-status');
    Route::post('payouts/reject/{payout_id}', 'AdminController@postPayoutRejectMark')->name('payouts-reject');
    Route::get('app_version', 'AdminController@getCurrentAppVersion')->name('app_version');
    Route::get('app_version/create', 'AdminController@createAppVersion')->name('create_app_version');
    Route::post('app_version/create', 'AdminController@postAppVersion')->name('create_app_version');
    Route::resource('customers', 'CustomerController')->parameters([
        'customers' => 'user'
    ]);
    Route::get('patients', 'CustomerController@patientList')->name('patient-list');
    Route::get('patient/create', 'CustomerController@getPatientCreate')->name('patient-create');
    Route::post('patient/create', 'CustomerController@postPatientCreate')->name('patient-create');
    Route::get('patient/{id}/edit', 'CustomerController@getEditPatient');
    Route::post('patient/{id}/edit', 'CustomerController@postEditPatient');
    Route::resource('vendor/custom-fields', 'VendorCustomFieldsController')->parameters([
        'vendor/custom-fields' => 'customfield'
    ]);
    Route::resource('user/custom-fields', 'UserCustomFieldsController')->parameters([
        'user/custom-fields' => 'customfield'
    ]);

    Route::resource('subscriptions', 'SubscriptionsController')->parameters([
        'subscriptions' => 'package_plan'
    ]);

    Route::get('doctormanagers/delete-doctormanager', 'DoctorManagersController@deleteDoctorManager');

    Route::resource('doctormanagers', 'DoctorManagersController')->parameters([
        'doctormanagers' => 'user'
    ]);
    Route::get('doctormanagers', 'DoctorManagersController@doctormanagerList')->name('doctor-manager-list');
    Route::get('doctormanager/create', 'DoctorManagersController@getDoctorManagerCreate')->name('doctor-manager-create');
    Route::post('doctormanager/create', 'DoctorManagersController@postDoctorManagerCreate')->name('doctor-manager-create');
    Route::get('doctormanager/{id}/edit', 'DoctorManagersController@getEditDoctorManager');
    Route::post('doctormanager/{id}/edit', 'DoctorManagersController@postEditDoctorManager');

    Route::resource('cluster', 'ClusterController');
    Route::resource('insurance', 'InsuranceController');
    Route::resource('coupon', 'CouponController');
    Route::resource('package', 'PackageController');
    Route::resource('banner', 'BannerController');
    Route::resource('pincodes', 'PincodeController');
    Route::post('file-import', 'PincodeController@fileImport')->name('file-import');
    Route::get('file-export', 'PincodeController@fileExport')->name('file-export');
    Route::resource('advertisement', 'AdvertisementController');
    Route::resource('emsat', 'EmsatController');
    Route::resource('covid19', 'MarketingController');
    Route::get('services', 'ServiceTypeController@getServices')->name('services.index');
    /* Master Slot or Interval */
    Route::get('master_slot', 'MasterSlotController@index')->name('index-master-slot');
    Route::get('master_slot/edit', 'MasterSlotController@getAddOrEditSlot')->name('edit-master-slot');
    Route::post('master_slot/edit', 'MasterSlotController@postAddOrEditSlot')->name('edit-master-slot');
    Route::delete('master_slot/delete', 'MasterSlotController@DeleteAllSlot')->name('delete-master-slot');
    // End Master Slot

    Route::get('services/create', 'ServiceTypeController@create')->name('services');
    Route::post('services', 'ServiceTypeController@store')->name('services');
    Route::get('services/{id}/edit', 'ServiceTypeController@edit')->name('edit');
    Route::get('services/{id}/categories', 'ServiceTypeController@getCategories')->name('service-category');
    Route::get('categories', 'ServiceTypeController@getCategories')->name('get-category');
    Route::post('services/delete/{id}', 'ServiceTypeController@deleteEmergencySlot')->name('delete');

    Route::get(
        'services/{id}/categories/create',
        'ServiceTypeController@addCategoryToService'
    )->name('add-service-category');
    Route::post(
        'services/{id}/categories/create',
        'ServiceTypeController@postCategoryToService'
    )->name('add-service-category');
    Route::get(
        'services/categories/{id}/edit',
        'ServiceTypeController@editCategoryToService'
    )->name('edit-service-category');
    Route::put(
        'services/categories/{id}/edit',
        'ServiceTypeController@putCategoryToService'
    )->name('put-service-category');

    Route::put('services/{id}', 'ServiceTypeController@update')->name('edit');
    Route::post('verifypackage', 'PackageController@verifyPackage');
    Route::get('subcategories/{category_id}/create', 'CategoryController@addSubCategory')->name('add-service-category')->name('subcategory');
    Route::resource('service_enable', 'ServicesController');
    Route::resource('consultants', 'ConsultantController')->parameters([
        'consultants' => 'user'
    ]);
    Route::resource('support_packages', 'MasterPackageController')->parameters([
        'support_packages' => 'masterpackage'
    ]);
    Route::resource('app_detail', 'AppDetailController')->parameters([
        'app_detail' => 'appDetail'
    ]);
    Route::post('consultants/delete-doctor', 'ConsultantController@deleteServiceProvider');
    Route::post('consultants/delete-topic', 'ConsultantController@deleteTopic');
    Route::post('consultants/manual-online', 'ConsultantController@PostMakeOnline');
    Route::post('consultants/pre-online', 'ConsultantController@PostMakePreOnline');
    Route::post('consultants/send_message_to_pre', 'ConsultantController@PostPremiumMessage');
    Route::post('consultants/uploadxls', 'ConsultantController@PostUploadxls');
    Route::post('insurance/uploadxls', 'InsuranceController@PostUploadxls');
    Route::post('customers/delete-patient', 'CustomerController@deleteCustomer');
    Route::post('appointment/status', 'ChatRequestController@changeAppointmentStatus');
    Route::post('appointment/updatetoken', 'ChatRequestController@updateToken');
    Route::get('appointment/create', 'ChatRequestController@createSessionAppointment');
    Route::get('pending-requests', 'ChatRequestController@pendingRequests');
    Route::get('un-answered-requests', 'ChatRequestController@unAnswerRequests');
    Route::post('appointment/create', 'ChatRequestController@postSessionAppointment');
    Route::resource('call-requests', 'CallRequestController');
    Route::resource('chat-requests', 'ChatRequestController');
    Route::resource('requests', 'ChatRequestController');
    Route::resource('pages', 'PagesController');
    Route::resource('categories', 'CategoryController');
    Route::post('categories/disable', 'CategoryController@disbaleOrEnableCategory');
    Route::resource('additional-document', 'AdditionalDocumentController');
    Route::resource('course', 'CourseController');
    Route::resource('templates', 'TemplatesController');
    Route::post('templates/update/{id}', 'TemplatesController@update');
    Route::resource('categories/{category_id}/filters', 'FilterController')->parameters([
        'filters' => 'filter_type'
    ]);
    Route::get('filter_option/update/{id}', 'FilterController@addsFilterOption');
    Route::post('filter_option/update/{id}', 'FilterController@postAddsFilterOption');
    Route::resource('master/preferences', 'MasterPreferenceController')->parameters([
        'preferences' => 'master_preference'
    ]);

    Route::resource('master/duties', 'MasterPreferenceController')->parameters([
        'duties' => 'master_preference'
    ]);

    Route::resource('master/lifestyle', 'LifeStyleController')->parameters([
        'lifestyle' => 'master_preference'
    ]);

    Route::resource('master/medical_history', 'MedicalHistoryController')->parameters([
        'medical_history' => 'master_preference'
    ]);
    Route::resource('master/symptoms', 'SymptomsController')->parameters([
        'symptoms' => 'master_preference'
    ]);

    Route::resource('custom/masterfields', 'CustomMasterFieldsController')->parameters([
        'masterfields' => 'custom_master_field'
    ]);
    Route::resource('faq', 'FeedController')->parameters([
        'faq' => 'feed'
    ]);

    Route::resource('tip', 'TipController')->parameters([
        'tip' => 'feed'
    ]);
    Route::resource('blogs', 'BlogsController')->parameters([
        'blogs' => 'feed'
    ]);

    Route::resource('ask_question', 'AskQuestionController')->parameters([
        'ask_question' => 'feed'
    ]);
    Route::resource('subscription', 'PlanController')->parameters([
        'subscription' => 'plan'
    ]);
    Route::resource('categories/{category_id}/additional-details', 'AdditionalDetailsController')->parameters([
        'additional-details' => 'additional_detail'
    ]);
    Route::resource('categories/{category_id}/symptoms', 'CategorySymptomsController')->parameters([
        'symptoms' => 'symptoms'
    ]);
    Route::get('topics', 'AdminController@getTopics');
    Route::get('support_questions', 'SupportQuestionController@getaskSupportQuestion');
    Route::get('support_questions/view/{id}', 'SupportQuestionController@viewAskSupportQuestion');
    Route::get('support_questions/reply/{id}', 'SupportQuestionController@replyQuestion');
    Route::post('support_questions/reply/{id}', 'SupportQuestionController@postReplyQuestion');
    Route::post('delete_filter_option', 'FilterController@deleteFilterOption');
    Route::post('delete_master_option', 'MasterPreferenceController@deleteMasterOption');
    Route::post('delete_symptoms_option', 'SymptomsController@deleteMasterOption');
    Route::group(array('prefix' => 'categories/{category_id}/service'), function () {
        Route::get(
            'create',
            'ServiceTypeController@showCategoryServiceForm'
        )->name('get-service-category');
        Route::post(
            'create',
            'ServiceTypeController@createCategoryToService'
        )->name('post-service-category');
        Route::get(
            '{id}/edit',
            'ServiceTypeController@editCategoryToService'
        )->name('show-service-category');
        Route::put(
            '{id}/edit',
            'ServiceTypeController@putCategoryToService'
        )->name('update-service-category');
        Route::post(
            'delete',
            'ServiceTypeController@deleteEmergencySlot'
        )->name('delete-emergency-timeslot');
    });
    Route::get('user/update', 'AdminController@getUpdateUser')->name('update_user');
    Route::post('user/update','AdminController@postUpdateUser')->name('post_update_user');
    Route::get('change/password','AdminController@getchangePassword')->name('admin_password');
    Route::post('change/password','AdminController@postchangePassword')->name('post_admin_password');
    Route::get('reviews','AdminController@getReviews')->name('reviews.index');
    //Clinic Routes
    Route::get('clinic/create_request', 'ClinicController@create')->name('create_request');
    Route::post('clinic/add_request', 'ClinicController@store')->name('clinic/add_request');
    Route::get('clinic/{id}/edit_request', 'ClinicController@edit')->name('edit_request');
    Route::get('clinic', 'ClinicController@index')->name('clinic');
    Route::post('clinic/{id}/update_request', 'ClinicController@update')->name('update_request');
    Route::post('clinic/delete_request/{id}', 'ClinicController@delete')->name('delete_request');
    Route::get('clinic/{id}/doctors', 'ClinicController@doctorsAll')->name('doctors');
    Route::post('clinic/add_doctors/{id}', 'ClinicController@addDoctorsToClinic')->name('add_doctors');
    Route::get('clinic/get_doctors/{id}', 'ClinicController@getDoctorsFromClinic')->name('get_doctors');
    Route::get('clinic/bookings/{id}', 'ClinicController@doctorBookings')->name('bookings');
    Route::post('clinic/remove_doctor', 'ClinicController@deleteDoctor')->name('remove_doctor');
    // Route::get('clinic/bookings/{id}', 'ClinicController@doctorBookings')->name('bookings');
    Route::get('clinic/bookings/', 'ClinicController@clinicBookings')->name('clinicbookings');
    Route::post('clinic/add-radius', 'ClinicController@addRadius');

});
Route::group(['namespace' => 'SuperAdmin', 'prefix' => 'admin', 'middleware' => 'superadmin'], function () {
    Route::resource('app-modules', 'CustomModuleController')->parameters([
        'app-modules' => 'app_modules'
    ]);
    Route::post('check-domain', 'CustomModuleController@checkDomain')->name('check-domain');
});
Route::get('/public/media/{img}', 'RoutingController@imageResize')->name('image-resize');
Route::get('/test-notification', 'API\DataController@getNotification')->name('image-resize');
Route::get('/{slug}', array('as' => 'page.show', 'uses' => 'Admin\PagesController@showPageBySlug'));


/* Web User Auth (Vendor And User) */
Route::post('service_provider/plan', 'Auth\RegisterController@postUpgradePlan');
Route::group(array('namespace' => 'Web', 'middleware' => 'webauth'), function () {
    Route::post('subscription-topic', 'PaymentController@postSubscriptionTopic');
    Route::get('web/profile', 'ServiceProviderController@getProfile')->middleware(['check_service_provider']);
    /* care_connect_live */
    Route::post('online-toggle', 'UserController@onlineToggle');
    Route::get('user/requests', 'UserController@getDoctorPage');
    Route::get('user/patient', 'UserController@getPatientPage');
    Route::get('web/ask-question', 'AskQuestionController@getAskAQuestion');
    Route::get('subject/topics/{subject_id?}', 'CourseController@getTopicList')->name('subject.topics');
    Route::post('addtopic', 'CourseController@addTopic')->name('subject.topics.add');
    Route::get('user/experts/{id?}/{service?}', 'CustomerController@viewExperts')->name('user.experts');
    Route::get('experts/listing/{course_id?}', 'CustomerController@courseExpertlisting')->name('experts.listing');
    Route::get('expert/listing/{emsat_id?}', 'CustomerController@emsatExpertlisting')->name('expert.listing');
    Route::post('user/search', 'CustomerController@viewExperts')->name('user.search');
    Route::get(
        'category/{category_id}',
        'UserController@get_category'
    )->name('category-page');
    Route::post('service_provider/add_availbility', 'ServiceProviderController@addAvailbility');
    Route::get(
        'user/doctor_details/{doctor_id}/{service_id}',
        'UserController@getDoctorData'
    )->name('doctor-details');

    Route::get('profile', 'UserController@getUserProfile');

    Route::get('user/doctor', 'UserController@getDoctorPage');
    Route::get(
        'user/expert_details/{doctor_id}/{service_id}',
        'UserController@getDoctorData'
    )->name('expert-details');

    Route::get(
        'experts_details/{expert_id}',
        'UserController@getDoctorData'
    )->name('tutor-single-page');
    Route::get(
        'user/getSchedule',
        'CustomerController@getSchedule'
    )->name('user.getSchedule');
    Route::get(
        'user/getSlots',
        'CustomerController@getSlots'
    )->name('user.getSlots');
    Route::get(
        'user/profile',
        'UserController@account'
    )->name('get-profile');
    Route::get(
        'service_provider/profile/{doctor_id}',
        'ServiceProviderController@getServiceProviderProfile'
    )->name('service-provider-profile');
    Route::get(
        'service_provider/editprofile/{doctor_id}',
        'ServiceProviderController@EditServiceProviderProfile'
    )->name('edit-service-provider-profile');
    Route::post(
        'service_provider/profile/update',
        'ServiceProviderController@UpdateServiceProviderProfile'
    )->name('update-service-provider-profile');
    Route::post(
        'update/phone',
        'UserController@UpdatePhone'
    )->name('update-phone');
    Route::post(
        'verify/phone',
        'UserController@verifyPhone'
    )->name('verifyPhone');
    Route::post(
        'resend/otp',
        'UserController@resendOtp'
    )->name('resendOtp');
    Route::post(
        'user/confirm_request',
        'CustomerController@confirmRequest'
    )->name('user.confirm');
    Route::get('user/test', 'ChatController@test');

    Route::get(
        'user/chat',
        'ChatController@getCustomerChat'
    )->name('customer.chat');

    Route::get(
        'user/chat/iedu',
        'ChatController@getCustomerChatIedu'
    )->name('customer.chat.iedu');

    Route::get(
        'chat/search',
        'ChatController@getChatSearch'
    )->name('chat.search');

    Route::get(
        'expert/chat',
        'ChatController@getCustomerChat'
    )->name('expert.chat');

    Route::post('user/create_request', 'CustomerController@createRequest');

    Route::post('user/check_coupon', 'CustomerController@checkCoupon');
    Route::get(
        'service_provider/get_manage_availibilty',
        'ServiceProviderController@getManageAvailibilty'
    )->middleware(['check_service_provider']);

   

    Route::get(
        'service_provider/get_manage_preferences',
        'ServiceProviderController@getManagePreferences'
    )->middleware(['check_service_provider']);

    Route::get(
        'service_provider/get_update_category',
        'ServiceProviderController@getUpdateCategory'
    )->middleware(['check_service_provider']);

    Route::post('user/checkPhoneExistOrNot', 'UserController@checkPhoneExistOrNot')->name('check-PhoneExistOrNot');
    Route::get(
        'edit/profile/',
        'UserController@updateProfileView'
    )->name('edit-profile');
    Route::get('user/notifications', 'NotificationController@getNotification')
        ->name('usernotifcation');
    Route::get('user/notifications_ajax', 'NotificationController@getNotificationAjax')
        ->name('usernotifcationajax');
 Route::get('web/my-questions','AskQuestionController@myQuestions')->name('web_my_questions');
 Route::get('web/get-notification-data','CustomerController@getNotificationData')->name('get_notification_data');
    Route::get('expert/notifications', 'NotificationController@getNotification')
        ->name('expert.notifcation');

    Route::post('cancel-request', 'CustomerController@postCancelRequest')->name('cancel-request');

    Route::post('accept-request', 'ServiceProviderController@postAcceptRequest')->name('accept-request');

    Route::post('start-request', 'CallerController@startRequest')->name('start-request');

    Route::post('call-status', 'CallerController@postCallStausChange');

    Route::post('complete-chat', 'PaymentController@postCompleteChat');

    Route::get('service/{request_id}/{service_type}', 'CallerController@getjistitest');

    Route::get('user/appointments', 'CustomerController@getRequestByCustomer');

    Route::get('user/waiting-room/{request_id}', 'CustomerController@getwaitingroom');

    Route::get('service_provider/revenue', 'ServiceProviderController@getRevenue')->name('service-provider-revenue');

    Route::get('service_provider/prescription', 'ServiceProviderController@getPrescription')->name('service-provider-prescription');

    Route::post('pre_screptions', 'ServiceProviderController@postAddPreScriptions');
    Route::get('delete-prescription-image/{id}', 'ServiceProviderController@deletePrescriptionImage');
    Route::post('prescription-medicine/add', 'ServiceProviderController@PrescriptionMedicineAdd');
    Route::post('medicine/add', 'ServiceProviderController@PrescriptionMedicineAdd');
    Route::get('prescription-medicine/delete/{id}', 'ServiceProviderController@PrescriptionMedicineDelete');
    Route::post('prescription-medicine/edit', 'ServiceProviderController@PrescriptionMedicineEdit');
    Route::get('prescription-medicine/getedit/{id}', 'ServiceProviderController@MedicineGetEdit');
    Route::get('prescription-medicine/medicineedit/{med_id}/{pre_id}', 'ServiceProviderController@PrescriptionMedicineGetEdit');

    Route::post('add-review', 'CustomerController@postAddReview');

    Route::get('user/wallet', 'CustomerController@getWallet')->name('user.wallet');
    Route::post('user/wallet_order_id', 'CustomerController@postWalletOrderId');
    Route::post('user/wallet', 'CustomerController@postWallet');
    Route::post('service_provider/add-bank', 'PaymentController@postAddBankAccount');
    Route::get('service_provider/bank-accounts', 'ServiceProviderController@getBankAccountsListing');
    Route::post('service_provider/payouts', 'PaymentController@payoutWalletToBankAccount');
    Route::get('service_provider/wallet', 'ServiceProviderController@getWalletBalance')->name('sp.wallet');
    Route::get('user/change/password', 'UserController@getchangePassword')->name('get-change-password');
    Route::post('/service_provider/setFilters', 'ServiceProviderController@setFilters')->name('service_provider.setFilters');
    /* end care_connect_live */

    Route::get(
        'service_provider/manage_availibilty',
        'ServiceProviderController@getManageAvailPage'
    )->middleware(['check_service_provider']);
    Route::get(
        'user/home',
        'UserController@index'
    );
    Route::get(
        'user/category/{category_id}',
        'UserController@get_category'
    )->name('home-category-page');

    Route::get(
        'service_provider/plan',
        'ServiceProviderController@getPlanPage'
    )->name('sp-plan');


    Route::get(
        'doctor_detail/{doctor_id}',
        'UserController@doctor_detail'
    )->name('doctor-single-page');


    Route::post(
        'service_provider/manage_availibilty',
        'ServiceProviderController@postManageAvailibilty'
    )->middleware(['check_service_provider']);

    Route::post('change/password', 'UserController@changePassword')->name('change-password');
    Route::post('service_provider/makeonline', 'UserController@postServiceProviderOnline')->name('change-password');

    Route::post(
        'change/userpassword',
        'UserController@changeCustomerPassword'
    )->name('change-userpassword');
    Route::post(
        'update/profile-user',
        'UserController@updateProfileuser'
    )->name('update-user-profile');


    Route::post(
        'update/profile',
        'UserController@updateProfile'
    )->name('update-profile');

    Route::post('add-review', 'CustomerController@postAddReview')->name('add-review');

    Route::post(
        'get/state',
        'UserController@getState'
    )->name('get-state_data');

    Route::post(
        'upload/userImage',
        'UserController@Useruploadimage'
    )->name('UserImage');

    Route::post(
        'upload/ServiceuserImage',
        'ServiceProviderController@Serviceuploadimage'
    )->name('ServiceUserImage');

    Route::get(
        'user/account',
        'UserController@account'
    )->name('get-state')->middleware(['check_customer']);

    Route::get(
        'service_provider/menu',
        'ServiceProviderController@menu'
    )->name('menu')->middleware(['check_service_provider']);

    Route::get(
        'service_provider/get_patient_list',
        'ServiceProviderController@getPatientList'
    )->name('get_patient_list')->middleware(['check_service_provider']);

    Route::get('service_provider/Appointment', 'ServiceProviderController@Appointment')->name('SPAppointment');
    Route::get('service_provider/patient/list', 'ServiceProviderController@getPatientListPage')->name('PatientList');
    Route::get('service_provider/reports', 'ServiceProviderController@getReports')->name('reports');

    Route::get(
        'service_provider/Reviews',
        'ServiceProviderController@getReviews'
    )->name('Reviews');

    Route::get(
        'service_provider/TermsConditions',
        'ServiceProviderController@getTermsConditions'
    )->name('TermsConditions');

    Route::get(
        'service_provider/Chat',
        'ServiceProviderController@Chat'
    )->name('SPChat');

    Route::post(
        'service_provider/category_update',
        'ServiceProviderController@serviceProviderCategoryUpdate'
    )->name('category_update')->middleware(['check_service_provider']);


    Route::get('ServiceRequestPage/{id}', 'UserController@ServiceRequestPage')->name('User.SPRequest');

    Route::get('ServiceproviderDetail/{id}/user_id/{user_id}', 'UserController@ServiceproviderDetail')->name('User.ServiceproviderDetail');

    Route::post('request_connect_now', 'UserController@SpRequestConnectNow')->name('RequestConnectNow');

    Route::post('/user/getSlotsByMultipleDates', 'UserController@postSlotsByMultipleDates');

    Route::post('/user/SpScheduleBooking', 'UserController@SpScheduleBooking')->name('user.SpScheduleBooking');


    Route::get('/service_provider/Booking/{id}/status/{status}', 'ServiceProviderController@serviceProviderBookingStatus')->name('RequestCallStatus')->middleware(['check_service_provider']);

    Route::post('/user/saveuserInsuranceInfo', 'UserController@saveuserInsuranceInfo')->name('user.saveuserInsuranceInfo');

    Route::post('/user/getUserDoctorList', 'UserController@getUserDoctorList')->name('user.getUserDoctorList');


    Route::post('/Sp/UserverifyEligibility', 'ServiceProviderController@UserverifyEligibility')->name('SP.UserverifyEligibility')->middleware(['check_service_provider']);

    Route::get('/user/AppointmentHistory', 'UserController@AppointmentHistory')->name('user.AppointmentHistory');

    Route::post('/user/ServiceProviderReview', 'UserController@ServiceProviderReview')->name('user.ServiceProviderReview');

    Route::get('/Sp/ServiceProviderFilter', 'ServiceProviderController@ServiceProviderFilter')->name('SPFilter')->middleware(['check_service_provider']);

    Route::get('/Sp/ServiceProviderCategoryFilter/{id}', 'ServiceProviderController@ServiceProviderCategoryFilter')->name('SPCategoryFilter')->middleware(['check_service_provider']);

    Route::post('/Sp/ServiceProviderCategoryFilterDemo', 'ServiceProviderController@getSPList')->name('SP.getDoctorFilterList');

    Route::get('/Sp/ChatHistoryPage', 'ServiceProviderController@ChatHistoryPage')->name('SP.ChatHistoryPage')->middleware(['check_service_provider']);

    Route::get('/Sp/manage_availibilty_new', 'ServiceProviderController@manage_availibilty_new')->name('SP.manage_availibilty_new')->middleware(['check_service_provider']);


    Route::post('/Sp/getSlotsByMultipleDates', 'ServiceProviderController@ServicePSlotsByMultipleDates')->name('SP.ServicePSlotsByMultipleDates')->middleware(['check_service_provider']);

    Route::get('/Sp/add_manage_availibilty_new', 'ServiceProviderController@add_manage_availibilty_new')->name('SP.add_manage_availibilty_new')->middleware(['check_service_provider']);


    Route::post('/Sp/postMannualSubscribeService', 'ServiceProviderController@postMannualSubscribeService')->name('SP.postMannualSubscribeService')->middleware(['check_service_provider']);

    Route::get('/user/counselor', 'UserController@Counselorcategory')->name('user.counselor');

    Route::get('/sp/advertisment', 'ServiceProviderController@ServiceProviderAdvertisment')->name('sp.advertising')->middleware(['check_service_provider']);

    Route::post('/sp/addBanner', 'ServiceProviderController@ServiceProvideraddBanner')->name('sp.addBanner')->middleware(['check_service_provider']);

    Route::any('/sp/EditManageAvailability', 'ServiceProviderController@EditManageAvailability')->name('sp.EditManageAvailability')->middleware(['check_service_provider']);

    Route::any('/sp/SPCounselor/{id}', 'ServiceProviderController@SPCounselorPage')->name('sp.SPCounselor')->middleware(['check_service_provider']);
});
// Route::get('admin/uploads', function() {
//     $files = Storage::disk('spaces')->files('uploads');
//     return view('upload', compact('files'));
// });

// Route::post('admin/uploads', function() {
//   $avatar = request()->file('file');
//   $extension = $avatar->getClientOriginalExtension();
//   $filename = md5(time()).'_'.$avatar->getClientOriginalName();

//   $normal = Image::make($avatar)->encode($extension);

//   Storage::disk('spaces')->put('uploads/'.$filename, (string)$normal, 'public');
//   // print_r($filename);die;
//     return redirect()->back();
// });
