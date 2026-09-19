<?php


use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\AdmitCardController;
use App\Http\Controllers\Admin\AdmitCardSettingController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\ApplicationSettingController;
use App\Http\Controllers\Admin\AssignmentController as AdminAssignmentController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\BookCategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BookRequestController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\CertificateTemplateController;
use App\Http\Controllers\Admin\ClassRoomController;
use App\Http\Controllers\Admin\ClassRoutineController as AdminClassRoutineController;
use App\Http\Controllers\Admin\ComplainController;
use App\Http\Controllers\Admin\ComplainSourceController;
use App\Http\Controllers\Admin\ComplainTypeController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\ContentTypeController;
use App\Http\Controllers\Admin\CourseCompleteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\EmailNotifyController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\EnquiryReferenceController;
use App\Http\Controllers\Admin\EnquirySourceController;
use App\Http\Controllers\Admin\EnrollSubjectController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\ExamAttendanceController;
use App\Http\Controllers\Admin\ExamMarkingController;
use App\Http\Controllers\Admin\ExamRoutineController as AdminExamRoutineController;
use App\Http\Controllers\Admin\ExamTypeController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\CollegeDepartmentController;
use App\Http\Controllers\Admin\FacultyController;
use App\Http\Controllers\Admin\FeesCategoryController;
use App\Http\Controllers\Admin\FeesDiscountController;
use App\Http\Controllers\Admin\FeesFineController;
use App\Http\Controllers\Admin\FeesMasterController;
use App\Http\Controllers\Admin\FeesStudentController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\HostelController as AdminHostelController;
use App\Http\Controllers\Admin\HostelRoomController;
use App\Http\Controllers\Admin\HostelRoomTypeController;
use App\Http\Controllers\Admin\HostelStaffController;
use App\Http\Controllers\Admin\HostelStudentController;
use App\Http\Controllers\Admin\IncomeCategoryController;
use App\Http\Controllers\Admin\IncomeController;
use App\Http\Controllers\Admin\IssueReturnController;
use App\Http\Controllers\Admin\ItemCategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ItemIssueController;
use App\Http\Controllers\Admin\ItemStockController;
use App\Http\Controllers\Admin\ItemStoreController;
use App\Http\Controllers\Admin\ItemSupplierController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LeaveController as AdminLeaveController;
use App\Http\Controllers\Admin\LeaveManagementController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\LibraryIdCardSettingController;
use App\Http\Controllers\Admin\LibraryStaffController;
use App\Http\Controllers\Admin\LibraryStudentController;
use App\Http\Controllers\Admin\MailSettingController;
use App\Http\Controllers\Admin\MarksheetController;
use App\Http\Controllers\Admin\MarksheetSettingController;
use App\Http\Controllers\Admin\MeetingScheduleController;
use App\Http\Controllers\Admin\MeetingTypeController;
use App\Http\Controllers\Admin\NoticeCategoryController;
use App\Http\Controllers\Admin\NoticeController as AdminNoticeController;
use App\Http\Controllers\Admin\OutcomeCalculationController;
use App\Http\Controllers\Admin\OutSideUserController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\PaySlipSettingController;
use App\Http\Controllers\Admin\PhoneLogController;
use App\Http\Controllers\Admin\PostalExchangeController;
use App\Http\Controllers\Admin\PostalExchangeTypeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\ReceiptSettingController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ResultContributionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoutineSettingController;
use App\Http\Controllers\Admin\ScheduleSettingController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SettingSecondController;
use App\Http\Controllers\Admin\DepartmentConditionController;
use App\Http\Controllers\Admin\SMSNotifyController;
use App\Http\Controllers\Admin\SMSSettingController;
use App\Http\Controllers\Admin\StaffAttendanceController;
use App\Http\Controllers\Admin\StaffHourlyAttendanceController;
use App\Http\Controllers\Admin\StaffNoteController;
use App\Http\Controllers\Admin\StatusTypeController;
use App\Http\Controllers\Admin\StudentAlumniController;
use App\Http\Controllers\Admin\StudentAttendanceController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SharanController;
use App\Http\Controllers\Admin\BilashController;
use App\Http\Controllers\Admin\KanchanController;
use App\Http\Controllers\Admin\OldStudentController;
use App\Http\Controllers\Admin\DegreeClcController;
use App\Http\Controllers\Admin\NursingClcController;
use App\Http\Controllers\Admin\EducationClcController;
use App\Http\Controllers\Admin\EngineeringClcController;
use App\Http\Controllers\Admin\InterClcController;
use App\Http\Controllers\Admin\ProvisionalController;
use App\Http\Controllers\Admin\InterProvisionalController;
use App\Http\Controllers\Admin\NursingProvisionalController;
use App\Http\Controllers\Admin\DegreeProvisionalController;
use App\Http\Controllers\Admin\EducationProvisionalController;
use App\Http\Controllers\Admin\EngineeringProvisionalController;
use App\Http\Controllers\Admin\StudentGroupEnrollController;
use App\Http\Controllers\Admin\StudentIdCardController;
use App\Http\Controllers\Admin\StudentIdCardSettingController;
use App\Http\Controllers\Admin\StudentLeaveManagementController;
use App\Http\Controllers\Admin\StudentNoteController;
use App\Http\Controllers\Admin\StudentSingleEnrollController;
use App\Http\Controllers\Admin\StudentTransferInController;
use App\Http\Controllers\Admin\StudentTransferOutController;
use App\Http\Controllers\Admin\SubjectAddDropController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SubjectMarkingController;
use App\Http\Controllers\Admin\TaxSettingController;
use App\Http\Controllers\Admin\TranslateController;
use App\Http\Controllers\Admin\TransportRouteController;
use App\Http\Controllers\Admin\TransportStaffController;
use App\Http\Controllers\Admin\TransportStudentController;
use App\Http\Controllers\Admin\TransportVehicleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StaffIdCardController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\VisitorTokenSettingController;
use App\Http\Controllers\Admin\VisitPurposeController;
use App\Http\Controllers\Admin\Web\AboutController as WebAboutController;
use App\Http\Controllers\Admin\Web\AboutUsController;
use App\Http\Controllers\Admin\Web\AcademicController;
use App\Http\Controllers\Admin\Web\AdmissionController;
use App\Http\Controllers\Admin\Web\CallToActionController;
use App\Http\Controllers\Admin\Web\CampusController;
use App\Http\Controllers\Admin\Web\ContactUsController;
use App\Http\Controllers\Admin\Web\CourseController as WebCourseController;
use App\Http\Controllers\Admin\Web\InterCourseController;
use App\Http\Controllers\Admin\Web\KanchanCourseController;
use App\Http\Controllers\Admin\Web\BilashCourseController;
use App\Http\Controllers\Admin\Web\BedCourseController;
use App\Http\Controllers\Admin\Web\RbsCourseController;
use App\Http\Controllers\Admin\Web\EngineeringCourseController;
use App\Http\Controllers\Admin\Web\PharmacyCourseController;
use App\Http\Controllers\Admin\Web\NursingCourseController;
use App\Http\Controllers\Admin\Web\FaqController as WebFaqController;
use App\Http\Controllers\Admin\Web\FeatureController;
use App\Http\Controllers\Admin\Web\GalleryController as WebGalleryController;
use App\Http\Controllers\Admin\Web\LabController;
use App\Http\Controllers\Admin\Web\NewsController as WebNewsController;
use App\Http\Controllers\Admin\Web\PageController as WebPageController;
use App\Http\Controllers\Admin\Web\PlacementController;
use App\Http\Controllers\Admin\Web\SliderController;
use App\Http\Controllers\Admin\Web\SocialSettingController;
use App\Http\Controllers\Admin\Web\SocialSettingSecondController;
use App\Http\Controllers\Admin\Web\TestimonialController;
use App\Http\Controllers\Admin\Web\TopbarSettingController;
use App\Http\Controllers\Admin\Web\TopbarSettingSecondController;
use App\Http\Controllers\Admin\Web\WebEventController;
use App\Http\Controllers\Admin\WorkShiftTypeController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Payment\PaypalController;
use App\Http\Controllers\Payment\RazorpayController;
use App\Http\Controllers\PurchaseVerificationController;
use App\Http\Controllers\Student\AssignmentController;
use App\Http\Controllers\Student\AttendanceController;
use App\Http\Controllers\Student\Auth\ForgotPasswordController;
use App\Http\Controllers\Student\Auth\LoginController;
use App\Http\Controllers\Student\Auth\RegisterController;
use App\Http\Controllers\Student\Auth\ResetPasswordController;
use App\Http\Controllers\Student\ClassRoutineController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\DownloadCenterController;
use App\Http\Controllers\Student\EventController as StudentEventController;
use App\Http\Controllers\Student\ExamRoutineController;
use App\Http\Controllers\Student\FeesController;
use App\Http\Controllers\Student\LeaveController;
use App\Http\Controllers\Student\LibraryController;
use App\Http\Controllers\Student\NoticeController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\TranscriptController;

use App\Http\Controllers\TransportController;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\AcademicController as WebAcademicController;
use App\Http\Controllers\Web\AdmissionController as WebAdmissionController;
use App\Http\Controllers\Web\ApplicationController as WebApplicationController;
use App\Http\Controllers\Web\CampusController as WebCampusController;
use App\Http\Controllers\Web\CourseController;
use App\Http\Controllers\Web\EnquiryController as WebEnquiryController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\FaqController;
use App\Http\Controllers\Web\GalleryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LabController as WebLabController;
use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\UndergraduatepageController;
use App\Http\Controllers\Web\PharmacyController;
use App\Http\Controllers\Web\DiplomaPageController;
use App\Http\Controllers\Web\DegreePageController;
use App\Http\Controllers\Web\EducationPageController;
use App\Http\Controllers\Web\EngineeringController;
use App\Http\Controllers\Web\BedPageController;
use App\Http\Controllers\Web\InterCourseController as WebInterCourseController;
use App\Http\Controllers\Web\BilashCourseController as WebBilashCourseController;
use App\Http\Controllers\Web\KanchanCourseController as WebKanchanCourseController;
use App\Http\Controllers\Web\BedCourseController as WebBedCourseController;
use App\Http\Controllers\Web\PharmacyCourseController as WebPharmacyCourseController;
use App\Http\Controllers\Web\NursingCourseController as WebNursingCourseController;
use App\Http\Controllers\Web\RbsCourseController as WebRbsCourseController;
use App\Http\Controllers\Web\EngineeringCourseController as WebEngineeringCourseController;
use App\Http\Controllers\Web\PlacementController as WebPlacementController;

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


use Illuminate\Support\Facades\Cache;

Route::get('/clear-shared-cache', function () {
    Cache::flush(); // Clears all cache (or use Cache::forget('key') for specific keys)
    return 'Shared view data cache cleared!';
});

Route::get('/clear-mail-cache', function () {
    Cache::forget('mail_settings');
    Cache::forget('mail_settings_table_exists');
    return 'Mail settings cache cleared!';
});


Route::get('/clear-language-cache', function () {
    Cache::forget('active_language');
    return 'Language cache cleared!';
});


Route::post('/upload-image', [AboutController::class, 'UploadImage'])->name('upload-image');

// Web Routes
Route::middleware(['XSS'])->namespace('Web')->group(function () {

    // Home Route
    // Route::get('/', 'HomeController@index')->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('home');

    //About Route
    Route::get('/about', [AboutController::class, 'index'])->name('about_us');
    Route::get('/about/{slug}', [AboutController::class, 'show'])->name('about.single');
    // Course Route
    Route::get('/course', [CourseController::class, 'index'])->name('course');
    Route::get('/ram-sharan-roy-college/{slug}', [CourseController::class, 'show'])->name('course.single');

    Route::get('/ram-sharan-roy-inter-college', [WebInterCourseController::class, 'index'])->name('inter');
    Route::get('/ram-sharan-roy-inter-college/{slug}', [WebInterCourseController::class, 'show'])->name('inter.single');

    Route::get('/ram-bilash-singh-ram-dayal-boy-college', [WebBilashCourseController::class, 'index'])->name('bilash');
    Route::get('/ram-bilash-singh-ram-dayal-boy-college/{slug}', [WebBilashCourseController::class, 'show'])->name('bilash.single');

    Route::get('/kanchan-kumari-karmveer-shiv-dayal-roy-college', [WebKanchanCourseController::class, 'index'])->name('kanchan');
    Route::get('/kanchan-kumari-karmveer-shiv-dayal-roy-college/{slug}', [WebKanchanCourseController::class, 'show'])->name('kanchan.single');

    Route::get('/bed', [WebBedCourseController::class, 'index'])->name('bed');
    Route::get('/ram-sharan-roy-college-bed/{slug}', [WebBedCourseController::class, 'show'])->name('bed1.single');

    Route::get('/ram-sharan-roy-college-nursing', [WebNursingCourseController::class, 'index'])->name('nursing');
    Route::get('/ram-sharan-roy-college-nursing/{slug}', [WebNursingCourseController::class, 'show'])->name('nursing.single');

    Route::get('/ram-sharan-roy-college-of-pharmacy', [WebPharmacyCourseController::class, 'index'])->name('pharmacy');
    Route::get('/ram-sharan-roy-college-of-pharmacy/{slug}', [WebPharmacyCourseController::class, 'show'])->name('pharmacy.single');

    Route::get('/rbsrdr-college-nursing', [WebRbsCourseController::class, 'index'])->name('rbs');
    Route::get('/rbsrdr-college-nursing/{slug}', [WebRbsCourseController::class, 'show'])->name('rbs.single');

    Route::get('/ram-sharan-roy-college-of-technology', [WebEngineeringCourseController::class, 'index'])->name('rsr');
    Route::get('/ram-sharan-roy-college-of-technology/{slug}', [WebEngineeringCourseController::class, 'show'])->name('rsr.single');

    //Admission Route
    Route::get('/admission', [WebAdmissionController::class, 'index'])->name('admission');
    Route::get('/admission/{slug}', [WebAdmissionController::class, 'show'])->name('admission.single');

    //Placement Route
    Route::get('/placement', [WebPlacementController::class, 'index'])->name('placement');
    Route::get('/placement/{slug}', [WebPlacementController::class, 'show'])->name('placement.single');
    //Academic Route
    Route::get('/academic', [WebAcademicController::class, 'index'])->name('academic');
    Route::get('/academic/{slug}', [WebAcademicController::class, 'show'])->name('academic.single');

    //Campus Route
    Route::get('/campus', [WebCampusController::class, 'index'])->name('campus');
    Route::get('/campus/{slug}', [WebCampusController::class, 'show'])->name('campus.single');

    //Lab Route
    Route::get('/lab', [WebLabController::class, 'index'])->name('lab');
    Route::get('/lab/{slug}', [WebLabController::class, 'show'])->name('lab.single');


    // Event Route
    Route::get('/event', [EventController::class, 'index'])->name('event');
    Route::get('/event/{id}/{slug}', [EventController::class, 'show'])->name('event.single');
    // Faq Route
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    // Gallery Route
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
    // News Route
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/news/{id}/{slug}', [NewsController::class, 'show'])->name('news.single');
    // Page Route
    Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.single');
    Route::get('/undergraduate/{slug}', [UndergraduatepageController::class, 'show'])->name('undergraduate.single');
    Route::get('/pharmacy1/{slug}', [PharmacyController::class, 'show'])->name('pharmacy1.single');
    Route::get('/diploma/{slug}', [DiplomaPageController::class, 'show'])->name('diploma.single');
    Route::get('/degree/{slug}', [DegreePageController::class, 'show'])->name('degree.single');
    Route::get('/education/{slug}', [EducationPageController::class, 'show'])->name('education.single');
    Route::get('/engineering/{slug}', [EngineeringController::class, 'show'])->name('engineering.single');
    Route::get('/bed/{slug}', [BedPageController::class, 'show'])->name('bed.single');

    // Application Route
    Route::get('application', [WebApplicationController::class, 'index'])->name('application.index');
    Route::post('application', [WebApplicationController::class, 'store'])->name('application.store');

    Route::get('application/print/{id}', [WebApplicationController::class, 'printApplication'])->name('application.print');
    Route::get('student-application/{id}', [WebApplicationController::class, 'cardApplication'])->name('student.application.card');
    Route::get('student-download/{id}', [WebApplicationController::class, 'downloadApplication'])->name('student.application.download');

    Route::get('application/about', [WebApplicationController::class, 'aboutApplication'])->name('application.about');
    Route::get('application/contact', [WebApplicationController::class, 'contactApplication'])->name('application.contact');
    Route::get('application/campus', [WebApplicationController::class, 'campusApplication'])->name('application.campus');

    Route::get('application/admission', [WebApplicationController::class, 'admissionApplication'])->name('application.admission');
    Route::get('application/placement', [WebApplicationController::class, 'placementApplication'])->name('application.placement');
    Route::get('application/academic', [WebApplicationController::class, 'academicApplication'])->name('application.academic');
    Route::get('application/lab', [WebApplicationController::class, 'labApplication'])->name('application.lab');

    Route::get('/download/information', [WebApplicationController::class, 'Download'])->name('download.infomation');
    
    Route::get('student-reset', [WebApplicationController::class, 'reset'])->name('student.reset');


    //Enquiry Controller

    Route::post('enquiry', [WebEnquiryController::class, 'Enquiry'])->name('application.enquiry');


    // SetCookie Route
    Route::get('/set-cookie', [HomeController::class, 'setCookie'])->name('setCookie');
});



// Ajax Filter Routes
Route::middleware(['XSS'])->group(function () {

    // Filter Routes
    Route::post('filter-district', [AddressController::class, 'filterDistrict'])->name('filter-district');
    Route::post('filter-batch', [FilterController::class, 'filterBatch'])->name('filter-batch');
    Route::post('filter-program', [FilterController::class, 'filterProgram'])->name('filter-program');
    Route::post('filter-college', [FilterController::class, 'filterCollege'])->name('filter-college');
    Route::post('filter-student_id', [FilterController::class, 'filterStudentId'])->name('filter-student_id');

    Route::post('filter-department-faculty', [FilterController::class, 'filterDepartmentFaculty'])->name('filter-department-faculty');



    Route::post('filter-sessionOnCollege', [FilterController::class, 'filterSessionOnCollege'])->name('filter-sessionOnCollege');

    Route::post('filter-batchbaseoncollge', [FilterController::class, 'filterBatchOnCollege'])->name('filter-batchbaseoncollge');
    Route::post('filter-programbaseoncollge', [FilterController::class, 'filterProgramOnCollege'])->name('filter-programbaseoncollge');

    Route::post('filter-teacher', [FilterController::class, 'filterTeacher'])->name('filter-teacher');

    Route::post('filter-content', [FilterController::class, 'filterPage'])->name('filter-content');

    Route::post('filter-session', [FilterController::class, 'filterSession'])->name('filter-session');
    Route::post('filter-college-department', [FilterController::class, 'filterCollegeDepartment'])->name('filter-college-department');
    Route::post('filter-semester', [FilterController::class, 'filterSemester'])->name('filter-semester');
    Route::post('filter-section', [FilterController::class, 'filterSection'])->name('filter-section');
    Route::post('filter-subject', [FilterController::class, 'filterSubject'])->name('filter-subject');
    Route::post('filter-enroll-subject', [FilterController::class, 'filterEnrollSubject'])->name('filter-enroll-subject');
    Route::post('filter-student-subject', [FilterController::class, 'filterStudentSubject'])->name('filter-student-subject');
    Route::post('filter-techer-subject', [FilterController::class, 'filterTecherSubject'])->name('filter-techer-subject');
    Route::post('filter-item', [InventoryController::class, 'filterItem'])->name('filter-item');
    Route::post('filter-quantity', [InventoryController::class, 'filterQuantity'])->name('filter-quantity');
    Route::post('filter-department', [InventoryController::class, 'filterDepartment'])->name('filter-department');
    Route::post('filter-room', [HostelController::class, 'filterRoom'])->name('filter-room');
    Route::post('filter-vehicle', [TransportController::class, 'filterVehicle'])->name('filter-vehicle');
});


// Set Lang Version
Route::get('locale/language/{locale}', function ($locale) {

    \Session::put('locale', $locale);

    \App::setLocale($locale);

    return redirect()->back();
})->name('version');


// Auth Routes
Route::middleware(['XSS', 'guest:web'])->prefix('admin')->group(function () {
    Auth::routes();
    Auth::routes(['logout' => false]);
});

Route::middleware(['XSS'])->prefix('admin')->group(function () {
    // Auth::routes();
    Auth::routes(['logout' => true]);
});

// Verify Purchase
Route::middleware(['XSS',])->group(function () {

    Route::get('verify-purchase', [PurchaseVerificationController::class, 'index'])->name('verify');
    Route::post('verify-purchase', [PurchaseVerificationController::class, 'verify'])->name('verify-purchase');
});

// Route::get('verify-purchase', [PurchaseVerificationController::class,'index'])->name('verify');



// Payment Routes
Route::middleware(['XSS'])->name('payment.')->namespace('Payment')->prefix('payment')->group(function () {

    // Paypal Routes
    // Route::get('paypal', 'PaypalController@index')->name('paypal.index');
    Route::post('paypal/process', [PaypalController::class, 'process'])->name('paypal.process');
    Route::get('paypal/success', 'PaypalController@paymentSuccess')->name('paypal.success');
    Route::get('paypal/cancel', 'PaypalController@paymentCancel')->name('paypal.cancel');

    // Stripe Routes
    // Route::get('stripe', 'StripeController@index')->name('stripe.index');
    Route::post('stripe/process', 'StripeController@process')->name('stripe.process');

    // Razorpay Routes
    // Route::get('razorpay', 'RazorpayController@index')->name('razorpay.index');
    Route::post('razorpay/process', [RazorpayController::class, 'process'])->name('razorpay.process');

    // Paystack Routes
    // Route::get('paystack', 'PaystackController@index')->name('paystack.index');
    Route::post('paystack/process', 'PaystackController@redirectToGateway')->name('paystack.process');
    Route::get('paystack/callback', 'PaystackController@handleGatewayCallback')->name('paystack.callback');

    // Flutterwave Routes
    // Route::get('flutterwave', 'FlutterwaveController@index')->name('flutterwave.index');
    Route::post('flutterwave/process', 'FlutterwaveController@process')->name('flutterwave.process');
    Route::get('flutterwave/callback', 'FlutterwaveController@callback')->name('flutterwave.callback');

    // Skrill Routes
    // Route::get('skrill', 'SkrillController@index')->name('skrill.index');
    Route::get('skrill/process', 'SkrillController@makePayment')->name('skrill.process');
    Route::get('skrill/completed', 'SkrillController@paymentCompleted')->name('skrill.completed');
    Route::get('skrill/cancelled', 'SkrillController@paymentCancelled')->name('skrill.cancelled');
});


// Admin Routes
Route::middleware(['auth:web', 'XSS'])->name('admin.')->namespace('Admin')->prefix('admin')->group(function () {

    // Dashboard Route
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('dashboard/pending', [DashboardController::class, 'pendingStudent'])->name('pending.check.st');

    Route::get('dashboard/active/student', [DashboardController::class, 'activeStudent'])->name('active.test.act');






    // Student Routes
    // Route::resource('admission/application', ApplicationController::class


    // Route::resource('admission/student', StudentController::class);
    Route::get('admission/student-card/{id}', [StudentController::class, 'card'])->name('student.card');
    Route::get('admission/student-status/{id}', [StudentController::class, 'status'])->name('student.status');
    Route::post('admission/student-send-password/{id}', [StudentController::class, 'sendPassword'])->name('student.send-password');
    Route::get('admission/student-print-password/{id}', [StudentController::class, 'printPassword'])->name('student.print-password');
    Route::post('admission/student-password-change', [StudentController::class, 'passwordChange'])->name('student-password-change');
    Route::get('admission/student-import', [StudentController::class, 'import'])->name('student.import');
    Route::post('admission/student-import-store', [StudentController::class, 'importStore'])->name('student.import.store');
    Route::get('admission/student-password-multiprint', [StudentController::class, 'multiPrintPassword'])->name('student.password-multiprint');

    Route::get('admission/download-application/{id}', [StudentController::class, 'downloadApplication'])->name('student.download');
    //CLC Routes
    Route::get('clc/old-student/{id}', [OldStudentController::class, 'clc'])->name('old-student.clc');

    Route::get('clc/degree-clc/{id}', [DegreeClcController::class, 'clc'])->name('degree-clc.clc');
    
    Route::post('clc/degree-clc-bulk', [DegreeClcController::class, 'bulkClc'])
    ->name('degree-clc.bulk-clc');

    Route::get('clc/education-clc/{id}', [EducationClcController::class, 'clc'])->name('education-clc.clc');
    Route::get('clc/engineering-clc/{id}', [EngineeringClcController::class, 'clc'])->name('engineering-clc.clc');
    Route::get('clc/nursing-clc/{id}', [NursingClcController::class, 'clc'])->name('nursing-clc.clc');
    Route::get('clc/inter-clc/{id}', [InterClcController::class, 'clc'])->name('inter-clc.clc');

    Route::get('provisional/student/{id}', [ProvisionalController::class, 'provisional'])->name('provisional.provisional');
    Route::get('provisional/inter-provisional/{id}', [InterProvisionalController::class, 'provisional'])->name('inter-provisional.provisional');
    Route::get('provisional/nursing-provisional/{id}', [NursingProvisionalController::class, 'provisional'])->name('nursing-provisional.provisional');
    Route::get('provisional/education-provisional/{id}', [EducationProvisionalController::class, 'provisional'])->name('education-provisional.provisional');
    Route::get('provisional/engineering-provisional/{id}', [EngineeringProvisionalController::class, 'provisional'])->name('engineering-provisional.provisional');
    Route::get('provisional/degree-provisional/{id}', [DegreeProvisionalController::class, 'provisional'])->name('degree-provisional.provisional');

    Route::get('clc/sharan-student/{id}', [SharanController::class, 'print'])->name('sharan.clc');
    Route::get('clc/bilash-student/{id}', [BilashController::class, 'clc'])->name('bilash.clc');
    Route::get('clc/kanchan-student/{id}', [KanchanController::class, 'clc'])->name('kanchan.clc');
    // Route::get('admission/certificate', [StudentController::class, 'certificate'])->name('student.certificate');


    Route::get('account/datafees', [StudentController::class, 'feesStudent'])->name('collection.datafees');
    Route::get('admission/cancel-student', [StudentController::class, 'cancelStudent'])->name('student.cancel');
    Route::get('account/fees-collection', [StudentController::class, 'feesCollection'])->name('income.feesCollection');
    Route::get('account/fees-collection-edit/{id}', [StudentController::class, 'editFeesCollection'])->name('edit.income.feesCollection');
    Route::put('account/fees-collection-update/{id}', [StudentController::class, 'updateFeesCollection'])->name('update.income.feesCollection');
    Route::get('account/fees-receipt-print/{id}', [StudentController::class, 'feesReceipt'])->name('fees-receipt.print');
    Route::get('account/fees-receipt-multiprint', [StudentController::class, 'feesMultiPrint'])->name('fees-receipt.multiprint');
    Route::get('fees/special/student', [StudentController::class, 'specialStudent'])->name('special.student');
    Route::get('student-cls/print/{id}', [StudentController::class, 'studentCls'])->name('student.cls');



    Route::get('admission/certificate', [StudentIdCardController::class, 'certificate'])->name('student.certificate');
    Route::get('admission/id-card-print/{id}', [StudentIdCardController::class, 'print'])->name('id-card.print');
    Route::get('admission/id-card-multiprint', [StudentIdCardController::class, 'multiPrint'])->name('id-card.multiprint');
    // Route::resource('admission/id-card-setting', 'StudentIdCardSettingController');



    // Student Attendance Routes
    // Route::resource('student-attendance', StudentAttendanceController::class);
    Route::get('student-attendance-report', [StudentAttendanceController::class, 'report'])->name('student-attendance.report');
    Route::get('student-attendance-import', [StudentAttendanceController::class, 'import'])->name('student-attendance.import');
    Route::post('student-attendance-import-store', [StudentAttendanceController::class, 'importStore'])->name('student-attendance.import.store');

    // Student Leave Manage
    // Route::resource('student-leave-manage', StudentLeaveManagementController::class);
    Route::post('student-leave-manage-status/{id}', [StudentLeaveManagementController::class, 'status'])->name('student-leave-manage.status');





    Route::get('academic/session-current/{id}', [SessionController::class, 'current'])->name('session.current');



    Route::get('academic/subject-import', [SubjectController::class, 'import'])->name('subject.import');
    Route::post('academic/subject-import-store', [SubjectController::class, 'importStore'])->name('subject.import.store');
    // Route::resource('academic/enroll-subject', 'EnrollSubjectController');



    // Routine Routes

    // Route::resource('routine/class-routine', AdminClassRoutineController::class);
    Route::get('routine/class-routine-teacher', [AdminClassRoutineController::class, 'teacher'])->name('class-routine.teacher');
    Route::post('routine/class-routine/print', [AdminClassRoutineController::class, 'print'])->name('class-routine.print');
    // Route::resource('routine/exam-routine', AdminExamRoutineController::class);
    Route::post('routine/exam-routine/print', [AdminExamRoutineController::class, 'print'])->name('exam-routine.print');
    Route::get('routine/routine-setting/class', [RoutineSettingController::class, 'class'])->name('routine-setting.class');
    Route::get('routine/routine-setting/exam', [RoutineSettingController::class, 'exam'])->name('routine-setting.exam');
    Route::post('routine/routine-setting/store', [RoutineSettingController::class, 'store'])->name('routine-setting.store');



    // Exam Routes
    // Route::resource('exam/exam-attendance', ExamAttendanceController::class);
    Route::get('exam/exam-attendance-import', [ExamAttendanceController::class, 'import'])->name('exam-attendance.import');
    Route::post('exam/exam-attendance-import-store', [ExamAttendanceController::class, 'importStore'])->name('exam-attendance.import.store');
    // Route::resource('exam/exam-marking', ExamMarkingController::class);
    Route::get('exam/exam-result', [ExamMarkingController::class, 'result'])->name('exam-result');


    Route::get('exam/subject-result', [SubjectMarkingController::class, 'result'])->name('subject-result');


    Route::get('exam/admit-card-print/{id}', [AdmitCardController::class, 'print'])->name('admit-card.print');
    Route::get('exam/admit-card-multiprint', [AdmitCardController::class, 'multiPrint'])->name('admit-card.multiprint');
    Route::get('exam/admit-card-download/{id}', [AdmitCardController::class, 'download'])->name('admit-card.download');
    // Route::resource('exam/admit-setting', AdmitCardSettingController::class);



    // Assignment Routes
    // Route::resource('download/assignment', AdminAssignmentController::class);
    Route::post('download/assignment-marking', [AdminAssignmentController::class, 'marking'])->name('assignment.marking');
    Route::get('download/assignment-export/{id}', [AdminAssignmentController::class, 'export'])->name('assignment.export');
    Route::post('download/assignment-import', [AdminAssignmentController::class, 'import'])->name('assignment.import');




    // Fees Collection Student
    Route::get('fees-student', [FeesStudentController::class, 'index'])->name('fees-student.index');
    Route::post('fees-student-pay', [FeesStudentController::class, 'pay'])->name('fees-student.pay');
    Route::post('fees-student-unpay/{id}', [FeesStudentController::class, 'unpay'])->name('fees-student.unpay');
    Route::post('fees-student-cancel/{id}', [FeesStudentController::class, 'cancel'])->name('fees-student.cancel');
    Route::get('fees-student-report', [FeesStudentController::class, 'report'])->name('fees-student.report');
    Route::get('fees-student-print/{id}', [FeesStudentController::class, 'print'])->name('fees-student.print');
    Route::get('fees-student-multiprint', [FeesStudentController::class, 'multiPrint'])->name('fees-student.multiprint');

    // Quick Collection Student
    Route::get('fees-student-quick-received', [FeesStudentController::class, 'quickReceived'])->name('fees-student.quick.received');
    Route::post('fees-student-quick-received', [FeesStudentController::class, 'quickReceivedStore'])->name('fees-student.quick.received.store');
    Route::get('fees-student-quick-assign', [FeesStudentController::class, 'quickAssign'])->name('fees-student.quick.assign');
    Route::post('fees-student-quick-assign', [FeesStudentController::class, 'quickAssignStore'])->name('fees-student.quick.assign.store');

    Route::get('fees/student/quick-show', [FeesStudentController::class, 'quickShow'])->name('fees-student.quick.show');
    Route::delete('fees-student-destroy/{id}', [FeesStudentController::class, 'destroy'])->name('fees-student.destroy');




    // Staff Routes
    // Route::resource('staff/user', UserController::class);
    Route::get('staff/user-status/{id}', [UserController::class, 'status'])->name('user.status');
    Route::post('staff/user-send-password/{id}', [UserController::class, 'sendPassword'])->name('user.send-password');
    Route::get('staff/user-print-password/{id}', [UserController::class, 'printPassword'])->name('user.print-password');
    Route::post('staff/user-password-change', [UserController::class, 'passwordChange'])->name('user-password-change');
    Route::get('staff/user-import', [UserController::class, 'import'])->name('user.import');
    Route::post('staff/user-import-store', [UserController::class, 'importStore'])->name('user.import.store');
    Route::get('active/staff', [UserController::class, 'activeStaff'])->name('active.staff');

    Route::get('staff-id-card', [StaffIdCardController::class, 'index'])->name('staff-id-card.index');
    Route::get('staff/id-card-print/{id}', [StaffIdCardController::class, 'print'])->name('staff-id-card.print');

    // Payroll Routes
    // Route::resource('staff/payroll', PayrollController::class);
    Route::get('staff/payroll-generate/{id}/{month}/{year}', [PayrollController::class, 'generate'])->name('payroll.generate');
    Route::post('staff/payroll-pay/{id}', [PayrollController::class, 'pay'])->name('payroll.pay');
    Route::post('staff/payroll-unpay/{id}', [PayrollController::class, 'unpay'])->name('payroll.unpay');
    Route::get('staff/payroll-report', [PayrollController::class, 'report'])->name('payroll.report');
    Route::get('staff/payroll-print/{id}', [PayrollController::class, 'print'])->name('payroll.print');
    // Route::resource('staff/pay-slip-setting', PaySlipSettingController::class);





    Route::get('attendance/staff-daily-report', [StaffAttendanceController::class, 'report'])->name('staff-daily-attendance.report');

    Route::get('attendance/staff-hourly-report', [StaffHourlyAttendanceController::class, 'report'])->name('staff-hourly-attendance.report');
    Route::get('attendance/staff-hourly-report/{id}', [StaffHourlyAttendanceController::class, 'reportDetails'])->name('staff-hourly-attendance.report.details');



    // Staff Leave Routes
    // Route::resource('leave/staff-leave', AdminLeaveController::class);
    // Route::resource('leave/leave-type', LeaveTypeController::class);
    // Route::resource('leave/leave-manage', LeaveManagementController::class);
    Route::post('leave/leave-manage-status/{id}', [LeaveManagementController::class, 'status'])->name('leave-manage.status');



    // Income Expense Routes
    // Route::resource('account/income', 'IncomeController');
    // Route::resource('account/income-category', 'IncomeCategoryController');
    // Route::resource('account/expense', 'ExpenseController');
    // Route::resource('account/expense-category', 'ExpenseCategoryController');
    // Route::resource('account/outcome', 'OutcomeCalculationController');



    // Communicate Routes
    // Route::resource('communicate/email-notify', EmailNotifyController::class);
    // Route::resource('communicate/sms-notify', SMSNotifyController::class);
    // Route::resource('communicate/event', AdminEventController::class);
    Route::get('communicate/event-calendar', [AdminEventController::class, 'calendar'])->name('event.calendar');
    // Route::resource('communicate/notice', AdminNoticeController::class);
    // Route::resource('communicate/notice-category', NoticeCategoryController::class);



    // Library Routes
    // Route::resource('library/book-list', BookController::class);
    Route::get('library/book-list-token-print/{id}', [BookController::class, 'tokenPrint'])->name('book-list.token.print');
    Route::get('library/book-list-multitoken-print', [BookController::class, 'multitokenPrint'])->name('book-list.multitoken.print');
    Route::get('library/book-list-import', [BookController::class, 'import'])->name('book-list.import');
    Route::post('library/book-list-import-store', [BookController::class, 'importStore'])->name('book-list.import.store');

    Route::get('acitive/book', [BookController::class, 'activeBook'])->name('active.book');
    // Route::resource('library/book-request', BookRequestController::class);
    // Route::resource('library/book-category', BookCategoryController::class);
    // Route::resource('library/issue-return', IssueReturnController::class);
    Route::post('library/issue-return-penalty/{id}', [IssueReturnController::class, 'penalty'])->name('issue-return.penalty');

    // Library Member Routes
    // Route::resource('member/library-student', LibraryStudentController::class);
    // Route::resource('member/library-staff', LibraryStaffController::class);
    // Route::resource('member/library-outsider', OutSideUserController::class);
    // Route::resource('library-card-setting', LibraryIdCardSettingController::class);
    Route::post('member/library-outsider-status/{id}', [OutSideUserController::class, 'status'])->name('library-outsider.status');
    Route::get('member/library-student-card/{id}', [LibraryStudentController::class, 'libraryCard'])->name('library-student.card');
    Route::get('member/library-staff-card/{id}', [LibraryStaffController::class, 'libraryCard'])->name('library-staff.card');
    Route::get('member/library-outsider-card/{id}', [OutSideUserController::class, 'libraryCard'])->name('library-outsider.card');




    // Inventory Routes
    // Route::resource('inventory/item-list', ItemController::class);
    // Route::resource('inventory/item-issue', ItemIssueController::class);
    // Route::resource('inventory/item-stock', ItemStockController::class);
    // Route::resource('inventory/item-store', ItemStoreController::class);
    // Route::resource('inventory/item-supplier', ItemSupplierController::class);
    // Route::resource('inventory/item-category', ItemCategoryController::class);
    Route::post('inventory/item-issue-penalty/{id}', [ItemIssueController::class, 'penalty'])->name('item-issue.penalty');




    // Hostel Routes
    // Route::resource('hostel/hostel', 'HostelController');
    // Route::resource('hostel/hostel-room', 'HostelRoomController');
    // Route::resource('hostel/room-type', 'HostelRoomTypeController');
    // Route::resource('hostel-student', 'HostelStudentController');
    // Route::resource('hostel-staff', 'HostelStaffController');



    // Transport Routes
    // Route::resource('transport-route', 'TransportRouteController');
    // Route::resource('transport-vehicle', 'TransportVehicleController');
    // Route::resource('transport-student', 'TransportStudentController');
    // Route::resource('transport-staff', 'TransportStaffController');



    // Visitor Routes
    // Route::resource('frontdesk/visitor', VisitorController::class);
    // Route::resource('frontdesk/visit-purpose', VisitPurposeController::class);
    // Route::resource('frontdesk/visitor-token-setting', VisitorTokenSettingController::class);
    Route::get('frontdesk/visitor-out/{id}', [VisitorController::class, 'outTime'])->name('visitor.out');
    Route::get('frontdesk/visitor-token-print/{id}', [VisitorController::class, 'tokenPrint'])->name('visitor.token.print');
    Route::get('active/visitor', [VisitorController::class, 'activeVisitor'])->name('active.visitor');

    // Phone Log Routes
    // Route::resource('frontdesk/phone-log', 'PhoneLogController');

    Route::get('active/phonelog', [PhoneLogController::class, 'activePhone'])->name('active.phone');
    // Enquiry Routes
    // Route::resource('frontdesk/enquiry', EnquiryController::class);
    // Route::resource('frontdesk/enquiry-source', EnquirySourceController::class);
    // Route::resource('frontdesk/enquiry-reference', EnquiryReferenceController::class);
    Route::post('frontdesk/enquiry-status/{id}', [EnquiryController::class, 'status'])->name('enquiry.status');
    Route::get('active/enquiry', [EnquiryController::class, 'activeEnquiry'])->name('active.enquiry');


    // Complain Routes
    // Route::resource('frontdesk/complain', ComplainController::class);
    // Route::resource('frontdesk/complain-type', ComplainTypeController::class);
    // Route::resource('frontdesk/complain-source', ComplainSourceController::class);
    Route::post('frontdesk/complain-status/{id}', [ComplainController::class, 'status'])->name('complain.status');


    // Postal Exchange Routes
    Route::resource('frontdesk/postal-exchange', PostalExchangeController::class);
    Route::resource('frontdesk/postal-type', PostalExchangeTypeController::class);

    Route::post('frontdesk/postal-exchange-status/{id}', [PostalExchangeController::class, 'status'])->name('postal-exchange.status');
    Route::get('active/postal', [PostalExchangeController::class, 'activePostal'])->name('active.postal');


    // Meeting Schedule  Routes
    // Route::resource('frontdesk/meeting', MeetingScheduleController::class);
    // Route::resource('frontdesk/meeting-type', MeetingTypeController::class);
    Route::post('frontdesk/meeting-status/{id}', [MeetingScheduleController::class, 'status'])->name('meeting.status');





    // Marksheet Routes
    // Route::resource('transcript/marksheet', MarksheetController::class);
    // Route::resource('transcript/marksheet-setting', MarksheetSettingController::class);

    Route::get('transcript/marksheet-print/{id}', [MarksheetController::class, 'print'])->name('marksheet.print');
    Route::get('transcript/marksheet-download/{id}', [MarksheetController::class, 'download'])->name('marksheet.download');
    Route::get('transcript/marksheet-semester', [MarksheetController::class, 'semester'])->name('marksheet.semester');
    Route::get('transcript/marksheet-semester-print/{id}/{session}', [MarksheetController::class, 'semesterPrint'])->name('marksheet.semester.print');
    Route::get('transcript/marksheet-semester-download/{id}/{session}', [MarksheetController::class, 'semesterDownload'])->name('marksheet.semester.download');
    Route::get('transcript/marksheet-semester-multiprint', [MarksheetController::class, 'multiPrint'])->name('marksheet.semester.multiprint');


    // Certificate Routes
    // Route::resource('transcript/certificate', CertificateController::class);
    // Route::resource('transcript/certificate-template', CertificateTemplateController::class);

    Route::get('transcript/certificate-print/{id}', [CertificateController::class, 'print'])->name('certificate.print');
    Route::get('transcript/certificate-download/{id}', [CertificateController::class, 'download'])->name('certificate.download');
    Route::get('transcript/certificate-multiprint', [CertificateController::class, 'multiPrint'])->name('certificate.multiprint');




    // Report Routes
    Route::get('report/student', [ReportController::class, 'student'])->name('report.student');
    Route::get('report/subject', [ReportController::class, 'subject'])->name('report.subject');
    Route::get('report/student-attendance', [ReportController::class, 'studentAttendance'])->name('report.student-attendance');
    Route::get('report/subject-attendance', [ReportController::class, 'subjectAttendance'])->name('report.subject-attendance');
    Route::get('report/fees', [ReportController::class, 'fees'])->name('report.fees');
    Route::get('report/student-fees', [ReportController::class, 'studentFees'])->name('report.student-fees');
    Route::get('report/payroll', [ReportController::class, 'payroll'])->name('report.payroll');
    Route::get('report/leave', [ReportController::class, 'leave'])->name('report.leave');
    Route::get('report/income', [ReportController::class, 'income'])->name('report.income');
    Route::get('report/expense', [ReportController::class, 'expense'])->name('report.expense');
    Route::get('report/library', [ReportController::class, 'library'])->name('report.library');
    Route::get('report/book-return', [ReportController::class, 'bookReturn'])->name('report.book-return');
    Route::get('report/inventory', [ReportController::class, 'inventory'])->name('report.inventory');
    Route::get('report/hostel', [ReportController::class, 'hostel'])->name('report.hostel');
    Route::get('report/transport', [ReportController::class, 'transport'])->name('report.transport');



    // Setting Routes For First College
    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('setting/siteinfo', [SettingController::class, 'siteInfo'])->name('setting.siteinfo');

    // Setting Route For Second College
    Route::get('setting/second', [SettingSecondController::class, 'index'])->name('setting.second.index');
    Route::post('setting/second/siteinfo', [SettingSecondController::class, 'siteInfo'])->name('setting.second.siteinfo');

    //Department Condition Routes
    Route::get('department/condition', [DepartmentConditionController::class, 'index'])->name('department.condition.index');

    Route::post('department/condition/departmentinfo', [DepartmentConditionController::class, 'departmentInfo'])->name('department.condition.departmentinfo');
    Route::get('department/program-condition', [DepartmentConditionController::class, 'programCondition'])->name('department.condition.program-condition');
    Route::post('department/program-condition/info', [DepartmentConditionController::class, 'programConditionInfo'])->name('department.condition.program-condition-info');
    // Address Routes
    // Route::resource('setting/province', 'ProvinceController');
    // Route::resource('setting/district', 'DistrictController');

    // Language Routes
    // Route::resource('setting/language', LanguageController::class);
    Route::get('setting/language-default/{id}', [LanguageController::class, 'default'])->name('language.default');

    // Translations Routes
    Route::get('translations', [TranslateController::class, 'index'])->name('translations.index');
    Route::post('translations/create', [TranslateController::class, 'store'])->name('translations.create');
    Route::post('translations/update', [TranslateController::class, 'transUpdate'])->name('translation.update.json');
    Route::post('translations/updateKey', [TranslateController::class, 'transUpdateKey'])->name('translation.update.json.key');
    Route::delete('translations/destroy/{key}', [TranslateController::class, 'destroy'])->name('translations.destroy');

    // Roles And Permission Routes
    // Route::resource('setting/role', RoleController::class);

    // Env Setting Routes
    // Route::resource('setting/mail-setting', MailSettingController::class);
    // Route::resource('setting/sms-setting', SMSSettingController::class);
    // Route::resource('setting/payment-setting', PaymentSettingController::class);

    // Sechedule Setting
    // Route::resource('setting/schedule-setting', ScheduleSettingController::class);

    // Application Setting
    // Route::resource('setting/application-setting', ApplicationSettingController::class);

    // Field Setting Routes
    Route::get('setting/field-user', [FieldController::class, 'user'])->name('field.user');
    Route::get('setting/field-student', [FieldController::class, 'student'])->name('field.student');
    Route::get('setting/field-application', [FieldController::class, 'application'])->name('field.application');
    Route::get('setting/student-panel', [FieldController::class, 'panel'])->name('student.panel');
    Route::post('setting/field-store', [FieldController::class, 'store'])->name('field.store');



    // Profile Routes
    // Route::resource('profile',ProfileController::class);

    Route::get('profile/account', [ProfileController::class, 'account'])->name('profile.account');
    Route::post('profile/changemail', [ProfileController::class, 'changeMail'])->name('profile.changemail');
    Route::post('profile/changepass', [ProfileController::class, 'changePass'])->name('profile.changepass');



    // Front Web Routes
    // Route::prefix('web')->namespace('Web')->group(function () {

    //     Route::resource('slider', 'SliderController');
    //     Route::resource('feature', 'FeatureController');
    //     Route::resource('about-us', 'AboutUsController');
    //     Route::resource('course', 'CourseController');
    //     Route::resource('web-event', 'WebEventController');
    //     Route::resource('news', 'NewsController');
    //     Route::resource('gallery', 'GalleryController');
    //     Route::resource('faq', 'FaqController');
    //     Route::resource('testimonial', 'TestimonialController');
    //     Route::resource('page', 'PageController');
    //     Route::resource('call-to-action', 'CallToActionController');
    //     Route::resource('social-setting', 'SocialSettingController');
    //     Route::resource('topbar-setting', 'TopbarSettingController');
    // });
});

Route::middleware(['auth:web', 'XSS'])->name('admin.')->prefix('admin')
    ->group(function () {
        Route::resource('profile', ProfileController::class);
        // Student Routes
        Route::resource('admission/student', StudentController::class);
        //CLC Routes
        Route::resource('old-student', OldStudentController::class);
        Route::resource('degree-clc', DegreeClcController::class);
        Route::resource('nursing-clc', NursingClcController::class);
        Route::resource('education-clc', EducationClcController::class);
        Route::resource('engineering-clc', EngineeringClcController::class);
        Route::resource('inter-clc', InterClcController::class);


        //Provisional Routes

        Route::resource('provisional', ProvisionalController::class);

        Route::resource('inter-provisional', InterProvisionalController::class);
        Route::resource('degree-provisional', DegreeProvisionalController::class);
        Route::resource('nursing-provisional', NursingProvisionalController::class);
        Route::resource('education-provisional', EducationProvisionalController::class);
        Route::resource('engineering-provisional', EngineeringProvisionalController::class);

        Route::resource('admission/application', ApplicationController::class);

        //Student CLC Routes

        Route::resource('clc/sharan', SharanController::class);
        Route::resource('clc/bilash', BilashController::class);
        Route::resource('clc/kanchan', KanchanController::class);

        // Admission Routes
        Route::resource('admission/student-transfer-out', StudentTransferOutController::class);
        Route::resource('admission/student-transfer-in', StudentTransferInController::class);
        Route::resource('admission/status-type', StatusTypeController::class);
        Route::resource('admission/id-card', StudentIdCardController::class);

        Route::resource('admission/id-card-setting', StudentIdCardSettingController::class);

        Route::resource('student-attendance', StudentAttendanceController::class);
        Route::resource('student-leave-manage', StudentLeaveManagementController::class);


        // Student Enroll Routes
        Route::resource('student/student-note', StudentNoteController::class);
        Route::resource('student/single-enroll', StudentSingleEnrollController::class);
        Route::resource('student/group-enroll', StudentGroupEnrollController::class);
        Route::resource('student/subject-adddrop', SubjectAddDropController::class);
        Route::resource('student/course-complete', CourseCompleteController::class);
        Route::resource('student/student-alumni', StudentAlumniController::class);

        //Academic route
        Route::resource('academic/college-department', CollegeDepartmentController::class);
        Route::resource('academic/faculty', FacultyController::class);
        Route::resource('academic/program', ProgramController::class);
        Route::resource('academic/batch', BatchController::class);
        Route::resource('academic/session', SessionController::class);
        Route::resource('academic/semester', SemesterController::class);
        Route::resource('academic/section', SectionController::class);
        Route::resource('academic/room', ClassRoomController::class);
        Route::resource('academic/subject', SubjectController::class);
        Route::resource('academic/enroll-subject', EnrollSubjectController::class);

        // Routine Routes
        Route::resource('routine/class-routine', AdminClassRoutineController::class);

        Route::resource('routine/exam-routine', AdminExamRoutineController::class);

        // Exam Routes
        Route::resource('exam/exam-attendance', ExamAttendanceController::class);
        Route::resource('exam/subject-marking', SubjectMarkingController::class);
        Route::resource('exam/exam-marking', ExamMarkingController::class);
        Route::resource('exam/admit-setting', AdmitCardSettingController::class);
        Route::resource('exam/exam-type', ExamTypeController::class);
        Route::resource('exam/grade', GradeController::class);
        Route::resource('exam/result-contribution', ResultContributionController::class);
        Route::resource('exam/admit-card', AdmitCardController::class);

        // Assignment Routes
        Route::resource('download/assignment', AdminAssignmentController::class);

        // Content Routes
        Route::resource('download/content', ContentController::class);
        Route::resource('download/content-type', ContentTypeController::class);

        // Fees Routes
        Route::resource('fees-master', FeesMasterController::class);
        Route::resource('fees-discount', FeesDiscountController::class);
        Route::resource('fees-fine', FeesFineController::class);
        Route::resource('fees-category', FeesCategoryController::class);
        Route::resource('fees-receipt', ReceiptSettingController::class);

        // Staff Routes
        Route::resource('staff/user', UserController::class);

        // Human Resource Routes
        Route::resource('staff/designation', DesignationController::class);
        Route::resource('staff/department', DepartmentController::class);
        Route::resource('staff/work-shift-type', WorkShiftTypeController::class);
        Route::resource('staff/staff-note', StaffNoteController::class);
        Route::resource('staff/tax-setting', TaxSettingController::class);


        // Payroll Routes

        Route::resource('staff/payroll', PayrollController::class);
        Route::resource('staff/pay-slip-setting', PaySlipSettingController::class);

        // Staff Attendance Routes
        Route::resource('attendance/staff-daily-attendance', StaffAttendanceController::class);
        Route::resource('attendance/staff-hourly-attendance', StaffHourlyAttendanceController::class);

        // Staff Leave Routes
        Route::resource('leave/staff-leave', AdminLeaveController::class);
        Route::resource('leave/leave-type', LeaveTypeController::class);
        Route::resource('leave/leave-manage', LeaveManagementController::class);

        // Income Expense Routes
        Route::resource('account/income', IncomeController::class);
        Route::resource('account/income-category', IncomeCategoryController::class);
        Route::resource('account/expense', ExpenseController::class);
        Route::resource('account/expense-category', ExpenseCategoryController::class);
        Route::resource('account/outcome', OutcomeCalculationController::class);

        // Communicate Routes
        Route::resource('communicate/email-notify', EmailNotifyController::class);
        Route::resource('communicate/sms-notify', SMSNotifyController::class);
        Route::resource('communicate/event', AdminEventController::class);
        Route::resource('communicate/notice', AdminNoticeController::class);
        Route::resource('communicate/notice-category', NoticeCategoryController::class);

        // Library Routes
        Route::resource('library/book-list', BookController::class);
        Route::resource('library/book-request', BookRequestController::class);
        Route::resource('library/book-category', BookCategoryController::class);
        Route::resource('library/issue-return', IssueReturnController::class);

        // Library Member Routes
        Route::resource('member/library-student', LibraryStudentController::class);
        Route::resource('member/library-staff', LibraryStaffController::class);
        Route::resource('member/library-outsider', OutSideUserController::class);
        Route::resource('library-card-setting', LibraryIdCardSettingController::class);

        // Inventory Routes
        Route::resource('inventory/item-list', ItemController::class);
        Route::resource('inventory/item-issue', ItemIssueController::class);
        Route::resource('inventory/item-stock', ItemStockController::class);
        Route::resource('inventory/item-store', ItemStoreController::class);
        Route::resource('inventory/item-supplier', ItemSupplierController::class);
        Route::resource('inventory/item-category', ItemCategoryController::class);

        // Hostel Routes
        Route::resource('hostel/hostel', AdminHostelController::class);
        Route::resource('hostel/hostel-room', HostelRoomController::class);
        Route::resource('hostel/room-type', HostelRoomTypeController::class);
        Route::resource('hostel-student', HostelStudentController::class);
        Route::resource('hostel-staff', HostelStaffController::class);

        // Transport Routes
        Route::resource('transport-route', TransportRouteController::class);
        Route::resource('transport-vehicle', TransportVehicleController::class);
        Route::resource('transport-student', TransportStudentController::class);
        Route::resource('transport-staff', TransportStaffController::class);

        // Visitor Routes
        Route::resource('frontdesk/visitor', VisitorController::class);
        Route::resource('frontdesk/visit-purpose', VisitPurposeController::class);
        Route::resource('frontdesk/visitor-token-setting', VisitorTokenSettingController::class);
        // Phone Log Routes
        Route::resource('frontdesk/phone-log', PhoneLogController::class);

        // Enquiry Routes
        Route::resource('frontdesk/enquiry', EnquiryController::class);
        Route::resource('frontdesk/enquiry-source', EnquirySourceController::class);
        Route::resource('frontdesk/enquiry-reference', EnquiryReferenceController::class);

        // Complain Routes
        Route::resource('frontdesk/complain', ComplainController::class);
        Route::resource('frontdesk/complain-type', ComplainTypeController::class);
        Route::resource('frontdesk/complain-source', ComplainSourceController::class);

        // Postal Exchange Routes
        Route::resource('frontdesk/postal-exchange', PostalExchangeController::class);
        Route::resource('frontdesk/postal-type', PostalExchangeTypeController::class);

        // Meeting Schedule  Routes
        Route::resource('frontdesk/meeting', MeetingScheduleController::class);
        Route::resource('frontdesk/meeting-type', MeetingTypeController::class);

        // Marksheet Routes
        Route::resource('transcript/marksheet', MarksheetController::class);
        Route::resource('transcript/marksheet-setting', MarksheetSettingController::class);

        // Certificate Routes
        Route::resource('transcript/certificate', CertificateController::class);
        Route::resource('transcript/certificate-template', CertificateTemplateController::class);

        // Front Web Routes
        Route::prefix('web')->group(function () {

            Route::resource('slider', SliderController::class);
            Route::resource('feature', FeatureController::class);
            Route::resource('about-us', AboutUsController::class);
            Route::resource('about', WebAboutController::class);
            Route::resource('academic', AcademicController::class);
            Route::resource('placement', PlacementController::class);
            Route::resource('lab', LabController::class);
            Route::resource('campus', CampusController::class);

            Route::resource('admission', AdmissionController::class);
            Route::resource('contact-us', ContactUsController::class);
            Route::resource('course', WebCourseController::class);
            Route::resource('inter-course', InterCourseController::class);
            Route::resource('bilash-course', BilashCourseController::class);
            Route::resource('kanchan-course', KanchanCourseController::class);
            Route::resource('bed-course', BedCourseController::class);
            Route::resource('rbs-course', RbsCourseController::class);
            Route::resource('rsr-course', EngineeringCourseController::class);
            Route::resource('pharmacy-course', PharmacyCourseController::class);
            Route::resource('nursing-course', NursingCourseController::class);
            Route::resource('admission', AdmissionController::class);
            Route::resource('web-event', WebEventController::class);
            Route::resource('news', WebNewsController::class);
            Route::resource('gallery', WebGalleryController::class);
            Route::resource('faq', WebFaqController::class);
            Route::resource('testimonial', TestimonialController::class);
            Route::resource('page', WebPageController::class);
            Route::resource('call-to-action', CallToActionController::class);
            Route::resource('social-setting', SocialSettingController::class);

            Route::resource('topbar-setting', TopbarSettingController::class);
        });

        //Province Settings Route
        Route::resource('setting/province', ProvinceController::class);
        Route::resource('setting/district', DistrictController::class);

        // Language Routes
        Route::resource('setting/language', LanguageController::class);

        // Roles And Permission Routes
        Route::resource('setting/role', RoleController::class);

        // Env Setting Routes
        Route::resource('setting/mail-setting', MailSettingController::class);
        Route::resource('setting/sms-setting', SMSSettingController::class);
        Route::resource('setting/payment-setting', PaymentSettingController::class);


        // Sechedule Setting
        Route::resource('setting/schedule-setting', ScheduleSettingController::class);

        // Application Setting
        Route::resource('setting/application-setting', ApplicationSettingController::class);
    });





// Student Login Routes

Route::middleware(['guest:student'])->prefix('student')->name('student.')->namespace('Student')->group(function () {

    Route::namespace('Auth')->group(function () {

        // Login Routes
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    });
});


Route::prefix('student')->name('student.')->namespace('Student')->group(function () {

    Route::namespace('Auth')->group(function () {

        // Login Routes
        // Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        // Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.store');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        // Register Routes
        Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.store');

        // Forgot Password Routes
        Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

        // Reset Password Routes
        Route::get('/password/reset/{token}/{email}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    });
});


// Student Dashboard Routes
Route::middleware(['auth:student', 'XSS'])->prefix('student')->name('student.')->namespace('Student')->group(function () {

    // Dashboard Route
    Route::get('/', [StudentDashboardController::class, 'index'])->name('dashboard.index');
    Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard.index');

    // Transcript Routes
    Route::get('transcript', [TranscriptController::class, 'index'])->name('transcript.index');

    // Assignment Routes
    Route::get('assignment', [AssignmentController::class, 'index'])->name('assignment.index');
    Route::get('assignment/{id}', [AssignmentController::class, 'show'])->name('assignment.show');
    Route::post('assignment/{id}/update', [AssignmentController::class, 'update'])->name('assignment.update');

    // Class Routine Routes
    Route::get('class-routine', [ClassRoutineController::class, 'index'])->name('class-routine.index');

    // Attendance Report
    Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');

    // Exam Routine Routes
    Route::get('exam-routine', [ExamRoutineController::class, 'index'])->name('exam-routine.index');

    // Fees Routes
    Route::get('fees', [FeesController::class, 'index'])->name('fees.index');
    Route::get('fees/pay/{id}', [FeesController::class, 'pay'])->name('fees.pay');
    Route::get('fees-student-quick-upload', [FeesController::class, 'quickReceived'])->name('fees-student.quick.upload');
    Route::post('fees-student-quick-store', [FeesController::class, 'quickReceivedStore'])->name('fees.quick.upload.store');

    // Library Routes
    Route::get('library', [LibraryController::class, 'index'])->name('library.index');

    // Calendar Routes
    Route::get('event-calendar', [StudentEventController::class, 'calendar'])->name('event.calendar');

    // Notice Routes
    Route::get('notice', [NoticeController::class, 'index'])->name('notice.index');
    Route::get('notice/{id}', [NoticeController::class, 'show'])->name('notice.show');

    // Leave Routes
    // Route::resource('leave', 'LeaveController');

    // Download Routes
    Route::get('download', [DownloadCenterController::class, 'index'])->name('download.index');
    Route::get('download/{id}', [DownloadCenterController::class, 'show'])->name('download.show');

    // Profile Routes
    // Route::resource('profile',StudentProfileController::class);
    Route::get('profile/account', [StudentProfileController::class, 'account'])->name('profile.account');
    // Route::post('profile/changemail', 'ProfileController@changeMail')->name('profile.changemail');
    // Route::post('profile/changepass', 'ProfileController@changePass')->name('profile.changepass');
});

// Student Dashboard Routes
Route::middleware(['auth:student', 'XSS'])->prefix('student')->name('student.')->group(function () {
    // Profile Routes
    Route::resource('profile', StudentProfileController::class);

    // Leave Routes
    Route::resource('leave', LeaveController::class);
});



// Auth::routes();

// Route::get('/test', [TestController::class, 'index'])->name('home');
