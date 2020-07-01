<?php

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
Route::get('/test', 'AccountReportController@test');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

//Route::get('login', 'Auth\LoginController@showLoginForm');
Route::get('/teacherHasNoPermission', 'Auth\LoginController@logout')->name('logout');
Auth::routes();

Route::get('/home', 'HomeController@index');

/*
 * for all user password reset.....
 */
Route::get('/changePassword', 'HomeController@changePassword');
Route::post('/updatePassword', 'HomeController@updatePassword');


/*
 * Schools Service Type..........
 */
Route::group(['middleware' => 'auth','prefix' => 'service-type'], function(){
    Route::get('/', 'ServiceTypeController@index');
    Route::get('status/{service_type_id}/{status}', 'ServiceTypeController@status');
});
/*
 * School Classes Service Type..........
 */

/*
 * Schools Routes..........
 */
Route::resource('schools', 'SchoolController');
Route::get('schools/{id}/delete', 'SchoolController@destroy');
Route::get('/school_users', 'SchoolController@schoolUsers');
Route::get('/schoolProfile', 'SchoolController@profile');
Route::get('/editSchoolProfile', 'SchoolController@editProfile');
Route::get('/schools/school/MobileCheck', 'SchoolController@mobileCheck');
/*
 * School Classes Routes..........
 */
Route::resource('classes', 'SchoolClassController');

Route::get('classes/school/classCheck', 'SchoolClassController@checkClassUnique');

/*
 * Subjects Routes........
 */

Route::group(['middleware' => 'auth','prefix' => 'subjects'], function(){
    Route::get('create', 'SubjectController@create');
    Route::post('store','SubjectController@store');
    Route::get('/', 'SubjectController@index');
    Route::get('show/{master_clas_id}/{group_class_id}', 'SubjectController@show');
    Route::get('edit/{id}','SubjectController@edit');
    Route::post('update/{id}','SubjectController@update');
    Route::get('delete/{id}','SubjectController@destroy');
});



/*
 * Ca Subjects Routes........
 */

Route::group(['middleware' => 'auth','prefix' => 'ca-subjects'], function(){
    Route::get('create', 'CaSubjectController@create');
    Route::post('store','CaSubjectController@store');
    Route::get('/', 'CaSubjectController@index');
    Route::get('show/{master_clas_id}/{group_class_id}', 'CaSubjectController@show');
    Route::get('edit/{id}','CaSubjectController@edit');
    Route::post('update/{id}','CaSubjectController@update');
    Route::get('delete/{id}','CaSubjectController@destroy');
});


/*
 * Ca Results Routes........
 */

Route::group(['middleware' => 'auth','prefix' => 'ca-result'], function(){
    Route::get('create', 'CaResultController@create');
    Route::get('search/make', 'CaResultController@create');
    Route::get('get/student_roll', 'CaResultController@student_roll');
    Route::get('get/subject', 'CaResultController@get_subject');
    Route::post('store', 'CaResultController@store');
    Route::get('list', 'CaResultController@index');
    Route::get('getsubject', 'CaResultController@getClassSubjects');
    Route::get('edit', 'CaResultController@edit');
    Route::post('update', 'CaResultController@update');
    Route::get('delete/{id}','CaResultController@destroy');
});



/*
 * | routing for unit controll...........
 */

/*
 * Students Routes..........
 */
Route::resource('students', 'StudentController');
Route::patch('students/restore/{id}', 'StudentController@restore');
Route::get('/studentProfile', 'StudentController@profile');
Route::get('/editStudentProfile', 'StudentController@editProfile');
Route::get('/students/student/MobileCheck', 'StudentController@mobileCheck');
Route::get('/students/roll/check', 'StudentController@rollCheck');
Route::get('/students_list', 'StudentController@index');
Route::get('/students_control/{school_id}', 'StudentController@student_controll_by_root');
Route::get('/old_students_list', 'StudentController@old_students_list');
Route::get('/students/{master_class_id}/{group}/{section}/{shift}/{session}/{student_type}', 'StudentController@ClassStudentsList');
Route::get('/student_list_controll/{master_class_id}/{group}/{section}/{shift}/{session}/{school_id}', 'StudentController@student_list_controll');
Route::post('/student_list_controll/active/{master_class_id}/{group}/{section}/{shift}/{session}/{school_id}', 'StudentController@student_id_card_active');
Route::post('/students/print', 'StudentController@students_print');
Route::get('/student/delete/{id}', 'StudentController@delete_student_parmanetly');


/*
 * Teachers designation rotes.........
 */
Route::resource('designations', 'DesignationController');

/*
 * Teacher Routes |............
 */
Route::resource('staff', 'StaffController');
Route::get('staff-old', 'StaffController@old_staff');
Route::get('/teacherProfile', 'StaffController@profile');
Route::get('/editTeacherProfile', 'StaffController@editProfile');
Route::get('/teachers/teacher/MobileCheck', 'StaffController@mobileCheck');
Route::get('staff-regine', 'StaffController@staff_regine');
Route::post('staff-regine/store', 'StaffController@staff_regine_store');


/*
 * Subjects assigned to teacher............
 */

Route::group(['middleware' => 'auth','prefix' => 'subjectTeachers'], function(){
    Route::get('/', 'SubjectTeacherController@index');
    Route::get('show/{master_class_id}/{shift}/{section}/{group_class_id}', 'SubjectTeacherController@show');
    Route::get('create', 'SubjectTeacherController@create');
    Route::post('store', 'SubjectTeacherController@store');
    Route::get('edit/{id}', 'SubjectTeacherController@edit');
    Route::post('update/{id}', 'SubjectTeacherController@update');
    Route::get('getsubject', 'SubjectTeacherController@getClassSubjects');
    Route::get('delete/{id}', 'SubjectTeacherController@destroy');
});



/*
 *  Exam Management in here..............
 */
Route::resource('examTypes', 'ExamTypeController');

/*
 *  Exam Management in here..............
 */
Route::resource('schoolExams', 'SchoolExamController');



/*
 * Result Management Routes here................
 */
Route::group(['middleware' => 'auth','prefix' => 'single-result'], function(){
    Route::get('create', 'SingleResultController@create');
    Route::get('search/make', 'SingleResultController@create');
    Route::get('get/student_roll', 'SingleResultController@student_roll');
    Route::get('get/subject', 'SingleResultController@get_subject');
    Route::post('store', 'SingleResultController@store');
    Route::get('list', 'SingleResultController@index');
    Route::get('getsubject', 'SingleResultController@getClassSubjects');
    Route::get('edit', 'SingleResultController@edit');
    Route::post('update', 'SingleResultController@update');
});


Route::group(['middleware' => 'auth','prefix' => 'result'], function(){
    Route::get('/', 'ResultController@index');
    Route::get('search', 'ResultController@getResult');
    Route::get('class', 'ResultController@searchClassResult');
    Route::get('get-class-result', 'ResultController@getClassResult');
    Route::get('tebulation-create', 'ResultController@tebulationCreate');
    Route::get('get-tebulation-sheet', 'ResultController@getTebulationSheet');
    Route::get('create', 'ResultController@create');
    Route::get('edit', 'ResultController@searchForEdit');
    Route::get('search-edit', 'ResultController@edit');
    Route::get('search/make', 'ResultController@create');
    Route::get('get/student_roll', 'ResultController@student_roll');
    Route::post('store', 'ResultController@store');
    Route::get('to_publish', 'ResultController@toPublish');
    Route::post('publish', 'ResultController@publish');
    Route::get('edit/{id}', 'ResultController@edit');
    Route::post('update/{id}', 'ResultController@update');
    Route::get('delete/{id}', 'ResultController@destroy');
});


Route::group(['middleware' => 'auth','prefix' => 'elective'], function(){
    Route::get('setting', 'ElectiveSettingController@create');
    Route::post('store', 'ElectiveSettingController@store');
    Route::get('edit/{id}', 'ElectiveSettingController@edit');
    Route::post('update/{id}', 'ElectiveSettingController@update');
    Route::get('delete/{id}', 'ElectiveSettingController@destroy');
});


/*
 * Progess Cart Management Routes here................
 */

Route::group(['middleware' => 'auth','prefix' => 'progress'], function(){
    Route::get('/create', 'ProgressCardController@create');
    Route::get('/card-show', 'ProgressCardController@cart_show');
    Route::get('/class-card-create', 'ProgressCardController@class_card_create');
    Route::get('/class-card-show', 'ProgressCardController@get_class_progress_card');
});

/*
 * | for class routine ..........
 */
Route::resource('/classRoutines', 'ClassRoutineController');
Route::get('/classRoutine/add', 'ClassRoutineController@create');
Route::get('classRoutines/status/{id}/{status}', 'ClassRoutineController@statusControl');
Route::get('classRoutines/edit/{id}', 'ClassRoutineController@edit');
Route::post('classRoutines/update', 'ClassRoutineController@update');
Route::get('classRoutines/delete/{id}', 'ClassRoutineController@destroy');


/*
 * | for exam routine ...............
 */
Route::resource('/examRoutines', 'ExamRoutineController');
Route::get('/examRoutine/add', 'ExamRoutineController@create');
Route::get('/examRoutine/edit/{id}', 'ExamRoutineController@edit');
Route::post('/examRoutine/update', 'ExamRoutineController@update');
Route::get('/examRoutine/status/{id}/{status}','ExamRoutineController@statusControl');
Route::get('/examRoutine/delete/{id}', 'ExamRoutineController@destroy');

 /*
 * | For class promotion...........
 */
Route::group(['middleware' => 'auth','prefix' => 'promotion'],function(){
    Route::get('/', 'PromotionController@index');
    Route::get('/menual', 'PromotionController@menual');
    Route::get('/menual/search', 'PromotionController@menual');
    Route::patch('/menual', 'PromotionController@menual_migration');
});

/*
 * | For Notice...........
 */
Route::resource('/notice', 'NoticeController');
Route::get('/notice/status/{id}/{status}', 'NoticeController@status');
Route::get('/notice/view/{id}', 'NoticeController@show');
Route::get('/notice/edit/{id}', 'NoticeController@edit');
Route::post('/notice/update', 'NoticeController@update');
Route::get('/notice/delete/{id}', 'NoticeController@destroy');


/*
 * | routing for class controll...........
 */
Route::group(['middleware' => 'auth','prefix' => 'class'], function(){
    Route::get('','ClassController@index');
    Route::get('create','ClassController@create');
    Route::post('store','ClassController@store');
    Route::get('edit/{id}','ClassController@edit');
    Route::post('update','ClassController@update');
    Route::get('delete/{id}','ClassController@destroy');
});

/*
 * | routing for unit controll...........
 */

Route::group(['middleware' => 'auth','prefix' => 'unit'], function(){
    Route::get('','UnitController@index');
    Route::get('create','UnitController@create');
    Route::post('store','UnitController@store');
    Route::get('edit/{id}','UnitController@edit');
    Route::post('update','UnitController@update');
    Route::get('delete/{id}','UnitController@destroy');
});

/*
 * | routing for unit controll...........
 */

Route::group(['middleware' => 'auth','prefix' => 'group'], function(){
    Route::get('','GroupClassController@index');
    Route::get('create','GroupClassController@create');
    Route::post('store','GroupClassController@store');
    Route::get('edit/{id}','GroupClassController@edit');
    Route::post('update','GroupClassController@update');
    Route::get('delete/{id}','GroupClassController@destroy');
});

/*
 * | routing for unit controll...........
 */


/*
 * | routing for accounts controll...........
 */

//  Account Report Routes
Route::group(['middleware' => 'auth','prefix' => 'Account'], function(){
    Route::get('/Dashboard','AccountReportController@account_dashboard')->name('account_dashboard');
    Route::get('/Report','AccountReportController@account_report')->name('account_report');
    Route::post('/DateWise/Fund','AccountReportController@date_wise_fund_report')->name('date_wise_fund_report');
    Route::post('/DateWise/FeeCollection','AccountReportController@date_wise_fee_collection_report')->name('date_wise_fee_collection_report');
    Route::post('/DateWise/Income','AccountReportController@date_wise_income_report')->name('date_wise_income_report');
    Route::post('/DateWise/Expense','AccountReportController@date_wise_expense_report')->name('date_wise_expense_report');
    Route::post('/ClassWise/FeeCollection','AccountReportController@class_wise_fee_collection_report')->name('class_wise_fee_collection_report');
    Route::post('/DateWise/BankReport','AccountReportController@date_wise_bank_report')->name('date_wise_bank_report');
});


//  Fund Routes
Route::group(['middleware' => 'auth','prefix' => 'fund'], function(){
    Route::get('/create','FundController@fund_create')->name('fund_create');
    Route::post('/store','FundController@fund_store')->name('fund_store');
    Route::get('/edit/{id}','FundController@fund_edit')->name('fund_edit');
    Route::post('/update','FundController@fund_update')->name('fund_update');
    Route::delete('/delete','FundController@fund_delete')->name('fund_delete');
});

//  Fee Category Routes
Route::group(['middleware' => 'auth','prefix' => 'fee_category'], function(){
    Route::get('/create','FeeCategoryController@fee_category_add')->name('fee_category_add');
    Route::post('/store','FeeCategoryController@fee_category_store')->name('fee_category_store');
    Route::get('/edit/{id}','FeeCategoryController@fee_category_edit')->name('fee_category_edit');
    Route::post('/update','FeeCategoryController@fee_category_update')->name('fee_category_update');
    Route::delete('/delete','FeeCategoryController@fee_category_delete')->name('fee_category_delete');
});

//  Fee Sub Category Routes
Route::group(['middleware' => 'auth','prefix' => 'FeeSubCategory'], function(){
  Route::get('/create','FeeSubCategoryController@fee_sub_category_add')->name('fee_sub_category_add');
  Route::post('/store','FeeSubCategoryController@fee_sub_category_store')->name('fee_sub_category_store');
  Route::get('/edit/{id}','FeeSubCategoryController@fee_sub_category_edit')->name('fee_sub_category_edit');
  Route::post('/update','FeeSubCategoryController@fee_sub_category_update')->name('fee_sub_category_update');
  Route::delete('/delete','FeeSubCategoryController@fee_sub_category_delete')->name('fee_sub_category_delete');
});

//  Others Income Routes
Route::group(['middleware' => 'auth','prefix' => 'Income'], function(){
    Route::get('/create','IncomeController@income_add')->name('income_add');
    Route::get('/store','IncomeController@income_add');
    Route::post('/store','IncomeController@income_store')->name('income_store');
    Route::get('/manage','IncomeController@income_manage')->name('income_manage');
    Route::get('/view/{id}','IncomeController@income_view')->name('income_view');
    Route::get('/edit/{id}','IncomeController@income_edit')->name('income_edit');
    Route::post('/update','IncomeController@income_update')->name('income_update');
    Route::delete('/delete','IncomeController@income_delete')->name('income_delete');
});

//  Expense Routes
Route::group(['middleware' => 'auth','prefix' => 'Expense'], function(){
    Route::get('/Add','ExpenseController@expense_add')->name('expense_add');
    Route::get('/store','ExpenseController@expense_add');
    Route::post('/store','ExpenseController@expense_store')->name('expense_store');
    Route::get('/manage','ExpenseController@expense_manage')->name('expense_manage');
    Route::get('/edit/{id}','ExpenseController@expense_edit')->name('expense_edit');
    Route::get('/view/{id}','ExpenseController@expense_view')->name('expense_view');
    Route::post('/update','ExpenseController@expense_update')->name('expense_update');
    Route::delete('/delete','ExpenseController@expense_delete')->name('expense_delete');
});

//  Fee Setup Routes
Route::group(['middleware' => 'auth','prefix' => 'FeeSetup'], function(){
    Route::get('/create','FeeSetupController@fee_setup_add')->name('fee_setup_add');
    Route::post('/store','FeeSetupController@fee_setup_store')->name('fee_setup_store');
    Route::get('/edit/{id}','FeeSetupController@fee_setup_edit')->name('fee_setup_edit');
    Route::post('/update','FeeSetupController@fee_setup_update')->name('fee_setup_update');
    Route::delete('/delete','FeeSetupController@fee_setup_delete')->name('fee_setup_delete');
});

//  Fee Collection Routes
Route::group(['middleware' => 'auth','prefix' => 'FeeCollection'], function(){
    Route::get('/create','FeeCollectionController@fee_collection_add')->name('fee_collection_add');
    Route::post('/studentID','FeeCollectionController@get_st_id')->name('get_st_id');
    Route::post('/CategoryAmount','FeeCollectionController@get_fee_cat_amount')->name('get_fee_cat_amount');
    Route::post('/student','FeeCollectionController@fee_student_search')->name('fee_student_search');
    Route::post('/store','FeeCollectionController@fee_collection_store')->name('fee_collection_store');
    Route::get('/manage','FeeCollectionController@fee_collection_manage')->name('fee_collection_manage');
    Route::get('/View/{id}','FeeCollectionController@fee_collection_view')->name('fee_collection_view');
    Route::delete('/delete','FeeCollectionController@fee_collection_delete')->name('fee_collection_delete');
    Route::get('/due_sms','FeeCollectionController@due_sms')->name('due_sms');
    Route::post('/send_due_sms','FeeCollectionController@send_due_sms')->name('send_due_sms');

});

//  Account Setting Routes
Route::group(['middleware' => 'auth','prefix' => 'AccountSetting'], function(){
    Route::get('/Add','AccountSettingController@account_setting_add')->name('account_setting_add');
    Route::post('/Store','AccountSettingController@account_setting_store')->name('account_setting_store');
    Route::post('/update','AccountSettingController@account_setting_update')->name('account_setting_update');
});

//  Bank Routes
Route::group(['middleware' => 'auth','prefix' => 'Bank'], function(){
    Route::get('/create','BankController@bank_add')->name('bank_add');
    Route::post('/store','BankController@bank_store')->name('bank_store');
    Route::get('/edit/{id}','BankController@bank_edit')->name('bank_edit');
    Route::post('/update','BankController@bank_update')->name('bank_update');
    Route::delete('/delete','BankController@bank_delete')->name('bank_delete');
});

//  Bank Account Type Routes
Route::group(['middleware' => 'auth','prefix' => 'BankAccountType'], function(){
    Route::get('/create','BankAccountTypeController@bank_aacount_type_add')->name('bank_aacount_type_add');
    Route::post('/store','BankAccountTypeController@bank_aacount_type_store')->name('bank_aacount_type_store');
    Route::get('/edit/{id}','BankAccountTypeController@bank_aacount_type_edit')->name('bank_aacount_type_edit');
    Route::post('/update','BankAccountTypeController@bank_aacount_type_update')->name('bank_aacount_type_update');
    Route::delete('/delete','BankAccountTypeController@bank_aacount_type_delete')->name('bank_aacount_type_delete');
});

//  Bank Deposit Routes
Route::group(['middleware' => 'auth','prefix' => 'BankDeposit'], function(){
    Route::get('/create','BankDepositController@bank_deposit_add')->name('bank_deposit_add');
    Route::post('/store','BankDepositController@bank_deposit_store')->name('bank_deposit_store');
    Route::get('/edit/{id}','BankDepositController@bank_deposit_edit')->name('bank_deposit_edit');
    Route::post('/update','BankDepositController@bank_deposit_update')->name('bank_deposit_update');
    Route::delete('/delete','BankDepositController@bank_deposit_delete')->name('bank_deposit_delete');
    Route::get('/Provident','BankDepositController@bank_provident_fund_list')->name('bank_provident_fund_list');
});

//  Bank Withdraw Routes
Route::group(['middleware' => 'auth','prefix' => 'BankWithdraw'], function(){
    Route::get('/create','BankWithdrawController@bank_withdraw_add')->name('bank_withdraw_add');
    Route::post('/store','BankWithdrawController@bank_withdraw_store')->name('bank_withdraw_store');
    Route::get('/edit/{id}','BankWithdrawController@bank_withdraw_edit')->name('bank_withdraw_edit');
    Route::post('/update','BankWithdrawController@bank_withdraw_update')->name('bank_withdraw_update');
    Route::delete('/delete','BankWithdrawController@bank_withdraw_delete')->name('bank_withdraw_delete');
});

//  Asset Routes
Route::group(['middleware' => 'auth','prefix' => 'Asset'], function(){
    Route::get('/create','AssetController@asset_add')->name('asset_add');
    Route::post('/store','AssetController@asset_store')->name('asset_store');
    Route::get('/edit/{id}','AssetController@asset_edit')->name('asset_edit');
    Route::post('/update','AssetController@asset_update')->name('asset_update');
    Route::delete('/delete','AssetController@asset_delete')->name('asset_delete');
});

//  Fine Setup Routes
Route::group(['middleware' => 'auth','prefix' => 'FineSetup'], function(){
    Route::get('/create','FineSetupController@fine_setup_add')->name('fine_setup_add');
    Route::post('/store','FineSetupController@fine_setup_store')->name('fine_setup_store');
    Route::get('/edit/{id}','FineSetupController@fine_setup_edit')->name('fine_setup_edit');
    Route::post('/update','FineSetupController@fine_setup_update')->name('fine_setup_update');
    Route::delete('/delete','FineSetupController@fine_setup_delete')->name('fine_setup_delete');
});

//  Fine Collection Routes
Route::group(['middleware' => 'auth','prefix' => 'FineCollection'], function(){
    Route::get('/create','FineCollectionController@fine_collection_add')->name('fine_collection_add');
    Route::post('/Search/Student','FineCollectionController@fine_student_search')->name('fine_student_search');
    Route::post('/store','FineCollectionController@fine_collection_store')->name('fine_collection_store');
    Route::get('/Manage','FineCollectionController@fine_collection_manage')->name('fine_collection_manage');
    Route::get('/PrintView/{id}','FineCollectionController@fine_collection_view')->name('fine_collection_view');
    Route::delete('/delete','FineCollectionController@fine_collection_delete')->name('fine_collection_delete');
    Route::get('/sms','FineCollectionController@fine_sms')->name('fine_sms');
    Route::post('/send_sms','FineCollectionController@send_fine_sms')->name('send_fine_sms');
});

//   Salary Fund Routes
Route::group(['middleware' => 'auth','prefix' => 'SaleryFund'], function(){
    Route::get('/Add','SalaryFundController@salary_fund_add')->name('salary_fund_add');
    Route::post('/store','SalaryFundController@salary_fund_store')->name('salary_fund_store');
    Route::get('/edit/{id}','SalaryFundController@salary_fund_edit')->name('salary_fund_edit');
    Route::post('/update','SalaryFundController@salary_fund_update')->name('salary_fund_update');
    Route::delete('/delete','SalaryFundController@salary_fund_delete')->name('salary_fund_delete');
});

//   Provident Fund Routes
Route::group(['middleware' => 'auth','prefix' => 'ProvidentFund'], function(){
    Route::get('/Add','ProvidentFundController@provident_fund_add')->name('provident_fund_add');
    Route::post('/store','ProvidentFundController@provident_fund_store')->name('provident_fund_store');
    Route::get('/edit/{id}','ProvidentFundController@provident_fund_edit')->name('provident_fund_edit');
    Route::post('/update','ProvidentFundController@provident_fund_update')->name('provident_fund_update');
    Route::delete('/delete','ProvidentFundController@provident_fund_delete')->name('provident_fund_delete');
});

//   Basic Salary Setup Routes
Route::group(['middleware' => 'auth','prefix' => 'SalarySetup'], function(){
    Route::get('/Add','SalarySetupController@salary_setup_add')->name('salary_setup_add');
    Route::post('/store','SalarySetupController@salary_setup_store')->name('salary_setup_store');
    Route::get('/edit/{id}','SalarySetupController@salary_setup_edit')->name('salary_setup_edit');
    Route::post('/update','SalarySetupController@salary_setup_update')->name('salary_setup_update');
    Route::delete('/delete','SalarySetupController@salary_setup_delete')->name('salary_setup_delete');
});

//   Advanced Salary Routes
Route::group(['middleware' => 'auth','prefix' => 'AdvancedPaid'], function(){
    Route::get('/Add','AdvancedPaidController@advanced_paid_add')->name('advanced_paid_add');
    Route::post('/store','AdvancedPaidController@advanced_paid_store')->name('advanced_paid_store');
    // Route::get('/edit/{id}','AdvancedPaidController@advanced_paid_edit')->name('advanced_paid_edit');
    // Route::post('/update','AdvancedPaidController@advanced_paid_update')->name('advanced_paid_update');
    Route::delete('/delete','AdvancedPaidController@advanced_paid_delete')->name('advanced_paid_delete');
});

//   Salary Sheet Routes
Route::group(['middleware' => 'auth','prefix' => 'SalarySheet'], function(){
    Route::get('/Add','SalarySheetController@salary_sheet_add')->name('salary_sheet_add');
    Route::post('/store','SalarySheetController@salary_sheet_store')->name('salary_sheet_store');
    Route::get('Search','SalarySheetController@salary_sheet_search')->name('salary_sheet_search');
    Route::post('/List','SalarySheetController@salary_sheet_list')->name('salary_sheet_list');
    Route::delete('/delete','SalarySheetController@salary_sheet_delete')->name('salary_sheet_delete');
});



/*
 * | routing for Customer Care controll...........
 */

 // Visitor Routes
 Route::group(['middleware' => 'auth','prefix' => 'advice', 'as' => 'advice.'], function(){
     Route::get('/add','CareController@advice_add')->name('add');
     Route::get('/list','CareController@advice_list')->name('list');
     Route::get('/root_advice','CareController@root_advice')->name('root_advice');
     Route::post('/edit','CareController@advice_edit')->name('edit');
     Route::post('/move01','CareController@move01')->name('move01');
     Route::get('/list/website','CareController@website_advice')->name('list.website');
 });

// Problem Routes
 Route::group(['middleware' => 'auth','prefix' => 'problem', 'as' => 'problem.'], function(){
     Route::get('/add','CareController@add')->name('add');
     Route::post('/store','CareController@store')->name('store');
     Route::get('/list','CareController@list')->name('list');
     Route::get('/root_problem','CareController@root_problem')->name('root_problem');
     Route::post('/edit','CareController@edit')->name('edit');
     Route::put('/update','CareController@update')->name('update');
     Route::delete('/delete','CareController@delete')->name('delete');
     Route::get('/list/website','CareController@website_problem')->name('list.website');
 });

// Visitor Type Routes
 Route::group(['middleware' => 'auth','prefix' => 'visitorType', 'as' => 'visitorType.'], function(){
     Route::get('/add','VisitorTypeController@add')->name('add');
     Route::post('/store','VisitorTypeController@store')->name('store');
     Route::get('/list','VisitorTypeController@list')->name('list');
     Route::post('/edit','VisitorTypeController@edit')->name('edit');
     Route::put('/update','VisitorTypeController@update')->name('update');
     Route::delete('/delete','VisitorTypeController@delete')->name('delete');
 });
// Visitor Routes
 Route::group(['middleware' => 'auth','prefix' => 'visitor', 'as' => 'visitor.'], function(){
     Route::get('/add','VisitorController@add')->name('add');
     Route::post('/store','VisitorController@store')->name('store');
     Route::get('/list','VisitorController@list')->name('list');
     Route::post('/edit','VisitorController@edit')->name('edit');
     Route::put('/update','VisitorController@update')->name('update');
     Route::delete('/delete','VisitorController@delete')->name('delete');
 });

// Complaint Routes
 Route::group(['middleware' => 'auth','prefix' => 'complaint', 'as' => 'complaint.'], function(){
     Route::get('/add','ComplaintController@add')->name('add');
     Route::post('/store','ComplaintController@store')->name('store');
     Route::get('/list','ComplaintController@list')->name('list');
     Route::post('/edit','ComplaintController@edit')->name('edit');
     Route::put('/update','ComplaintController@update')->name('update');
     Route::delete('/delete','ComplaintController@delete')->name('delete');
 });

 // SMS Login Info Routes
  Route::group(['middleware' => 'auth','prefix' => 'smsLimit', 'as' => 'smsLimit.'], function(){
      Route::get('/sms_setup','SmsLimitController@sms_setup')->name('sms_setup');
      Route::post('/search','SmsLimitController@search')->name('search');
      Route::post('/store','SmsLimitController@store')->name('store');
  });

 // Message Length Routes
  Route::group(['middleware' => 'auth','prefix' => 'messageLength', 'as' => 'messageLength.'], function(){
      Route::get('/add','MessageLengthController@add')->name('add');
      Route::post('/store','MessageLengthController@store')->name('store');
      Route::get('/list','MessageLengthController@list')->name('list');
      Route::get('/edit/{id}','MessageLengthController@edit')->name('edit');
      Route::post('/update/{id}','MessageLengthController@update')->name('update');
  });

 // Root User SMS Routes
  Route::group(['middleware' => 'auth','prefix' => 'rootSms', 'as' => 'rootSms.'], function(){
      Route::get('/add','RootSmsController@add')->name('add');
      Route::post('/msg_count','RootSmsController@msg_count')->name('msg_count');
      Route::post('/send','RootSmsController@send')->name('send');
      Route::get('/multi_school','RootSmsController@multi_school')->name('multi_school');
      Route::post('/multi_school_send','RootSmsController@multi_school_send')->name('multi_school_send');
      Route::get('/daily_sms_report','RootSmsController@daily_sms_report')->name('daily_sms_report');
  });
 Route::get('/get_data','LoginInfoController@get_data')->name('get_data');
 // Login Info Routes
 Route::group(['middleware' => 'auth','prefix' => 'loginInfo'], function(){
     Route::get('/student_login_info','LoginInfoController@student_login_info')->name('student_login_info');
     Route::post('/student_login_info_print','LoginInfoController@student_login_info_print')->name('student_login_info_print');
     Route::get('/employee_login_info','LoginInfoController@employee_login_info')->name('employee_login_info');
     Route::post('/employee_login_info_print','LoginInfoController@employee_login_info_print')->name('employee_login_info_print');
     Route::get('/committee_login_info','LoginInfoController@committee_login_info')->name('committee_login_info');
     Route::post('/committee_login_info_print','LoginInfoController@committee_login_info_print')->name('committee_login_info_print');

 });

 // Password Reset
 Route::group(['middleware' => 'auth','prefix' => 'password'], function(){
     Route::get('/student_password','PasswordGenerateController@student_password')->name('student_password');
     Route::post('/student_password_reset','PasswordGenerateController@student_password_reset')->name('student_password_reset');
     Route::post('/student_password_generate','PasswordGenerateController@student_password_generate')->name('student_password_generate');
     Route::get('/employee_password','PasswordGenerateController@employee_password')->name('employee_password');
     Route::post('/employee_password_reset','PasswordGenerateController@employee_password_reset')->name('employee_password_reset');
     Route::post('/employee_password_generate','PasswordGenerateController@employee_password_generate')->name('employee_password_generate');
     Route::get('/committee_password','PasswordGenerateController@committee_password')->name('committee_password');
     Route::post('/committee_password_reset','PasswordGenerateController@committee_password_reset')->name('committee_password_reset');
     Route::post('/committee_password_generate','PasswordGenerateController@committee_password_generate')->name('committee_password_generate');
 });

// SMS Login Info Routes
 Route::group(['middleware' => 'auth','prefix' => 'loginInfo', 'as' => 'loginInfo.'], function(){
     Route::get('/student','LoginInfoController@student')->name('student');
     Route::post('/get_classes','LoginInfoController@get_classes')->name('get_classes');
     Route::post('/st_search','LoginInfoController@st_search')->name('st_search');
     Route::post('/st_sms','LoginInfoController@st_sms')->name('st_sms');
     Route::get('/employee','LoginInfoController@employee')->name('employee');
     Route::post('/em_search','LoginInfoController@em_search')->name('em_search');
     Route::post('/em_sms','LoginInfoController@em_sms')->name('em_sms');
     Route::post('/st_sms','LoginInfoController@st_sms')->name('st_sms');
     Route::get('/committee','LoginInfoController@committee')->name('committee');
     Route::post('/comm_search','LoginInfoController@comm_search')->name('comm_search');
     Route::post('/comm_sms','LoginInfoController@comm_sms')->name('comm_sms');
 });

// Birthday Text Routes
 Route::group(['middleware' => 'auth','prefix' => 'birthdayText', 'as' => 'birthdayText.'], function(){
     Route::get('/add','BirthdayTextController@add')->name('add');
     Route::post('/store','BirthdayTextController@store')->name('store');
     Route::get('/list','BirthdayTextController@list')->name('list');
     Route::get('/edit/{id}','BirthdayTextController@edit')->name('edit');
     Route::post('/update/{id}','BirthdayTextController@update')->name('update');
     Route::get('/delete/{id}','BirthdayTextController@delete')->name('delete');
 });

// Attendance Text Routes
 Route::group(['middleware' => 'auth','prefix' => 'attendanceText', 'as' => 'attendanceText.'], function(){
     Route::get('/add','AttendanceTextController@add')->name('add');
     Route::post('/store','AttendanceTextController@store')->name('store');
     Route::get('/list','AttendanceTextController@list')->name('list');
     Route::get('/edit/{id}','AttendanceTextController@edit')->name('edit');
     Route::post('/update/{id}','AttendanceTextController@update')->name('update');
     Route::get('/delete/{id}','AttendanceTextController@delete')->name('delete');
 });

// Attendance Time Routes
 Route::group(['middleware' => 'auth','prefix' => 'attendanceTime', 'as' => 'attendanceTime.'], function(){
     Route::get('/add','AttendanceTimeController@add')->name('add');
     Route::post('/store','AttendanceTimeController@store')->name('store');
     Route::get('/list','AttendanceTimeController@list')->name('list');
     Route::get('/edit/{id}','AttendanceTimeController@edit')->name('edit');
     Route::post('/update/{id}','AttendanceTimeController@update')->name('update');
     Route::get('/delete/{id}','AttendanceTimeController@delete')->name('delete');
 });

// Attendance Option Routes
 Route::group(['middleware' => 'auth','prefix' => 'attendanceOption', 'as' => 'attendanceOption.'], function(){
     Route::post('/store','AttendanceOptionController@store')->name('store');
     Route::get('/list','AttendanceOptionController@list')->name('list');
 });



Route::group(['middleware' => 'auth','prefix' => 'sms'], function(){
    Route::get('','SmsController@index');
    Route::get('search','SmsController@index');
    Route::get('present-student','SmsController@present_student');
    Route::post('store','SmsController@store');
    Route::post('store-present-student','SmsController@store_present_student');
    Route::get('create','SmsController@create');
    Route::get('contentCreate','SmsController@contentCreate');
    Route::post('contentStore','SmsController@contentStore');
    Route::post('send','SmsController@send');
    Route::get('number-collection','SmsController@number_collection');
    Route::get('result','SmsController@result');
    Route::get('result/search','SmsController@result');
    Route::post('result-send','SmsController@result_send');
});

Route::group(['middleware' => 'auth','prefix' => 'studentCard'], function(){
    Route::get('','StudentCardController@index');
    Route::get('school','StudentCardController@index');
    Route::get('search','StudentCardController@create');
    Route::get('print-list','StudentCardController@student_cart_list_print');
    Route::get('print/{master_class_id}/{group}/{section}/{shift}/{session}/{school_id}', 'StudentCardController@print_lists');
});

Route::group(['middleware' => 'auth','prefix' => 'stafCard'], function(){
    Route::get('','StaffCardController@index');
    Route::get('search','StaffCardController@create');
});

/*
    Commitee Routes
*/
Route::resource('commitee', 'CommiteeController');
Route::get('/commitee_old', 'CommiteeController@old_commitee');
Route::get('/commiteeProfile', 'CommiteeController@profile');
Route::get('/editCommiteeProfile', 'CommiteeController@editprofile');
/*
    //Commitee Routes
*/

Route::group(['middleware' => 'auth','prefix' => 'advertisement'], function(){
    Route::get('','AdvertisementController@create');
    Route::post('store','AdvertisementController@store');
    Route::post('update/{id}','AdvertisementController@update');
});
Route::group(['middleware' => 'auth','prefix' => 'holiday'], function(){
    Route::get('','HolidayController@index');
    Route::get('show/{month}/{year}','HolidayController@show');
    Route::get('create','HolidayController@create');
    Route::get('search','HolidayController@create');
    Route::post('store','HolidayController@store');
    Route::get('edit/{month}/{year}','HolidayController@edit');
    Route::post('update/{month}/{year}','HolidayController@update');
    Route::get('delete/{month}/{year}','HolidayController@destroy');
});


Route::group(['middleware' => 'auth','prefix' => 'holiday-cancel'], function(){
    Route::get('','CancelHolidayController@index');
    Route::get('show/{month}/{year}','CancelHolidayController@show');
    Route::get('create','CancelHolidayController@create');
    Route::get('search','CancelHolidayController@create');
    Route::post('store','CancelHolidayController@store');
    Route::get('edit/{month}/{year}','CancelHolidayController@edit');
    Route::post('update/{month}/{year}','CancelHolidayController@update');
    Route::get('delete/{id}/{month}/{year}','CancelHolidayController@destroy');
});


Route::group(['middleware' => 'auth','prefix' => 'attendence'], function(){
    Route::get('student','AttendenceController@students');
    Route::get('view/{class_id}/{group}/{shift}/{section}','AttendenceController@view');
    Route::get('details/{student_id}','AttendenceController@show');
    Route::post('print','AttendenceController@print_view');
    Route::get('create','AttendenceController@create');
    Route::post('store','AttendenceController@storeOrUpdate');
});

Route::group(['middleware' => 'auth','prefix' => 'attendence-report'], function(){
    Route::get('create','AttendanceReportController@create');
    Route::get('search','AttendanceReportController@create');
});

Route::group(['middleware' => 'auth','prefix' => 'atten_employee'], function(){
    Route::get('','AttenEmployeeController@employees');
    Route::get('view/{group_id}','AttenEmployeeController@view');
    Route::get('details/{staff_id}','AttenEmployeeController@show');
    Route::post('print','AttenEmployeeController@print_view');
});

Route::group(['middleware' => 'auth','prefix' => 'menual'], function(){
    Route::get('student-entry','MenualAttendenceController@studentEntry');
    Route::post('student-entry-store','MenualAttendenceController@studentStore');
    Route::get('staff-entry','MenualAttendenceController@staffEntry');
    Route::post('staff-entry-store','MenualAttendenceController@staffStore');
});

Route::group(['middleware' => 'auth','prefix' => 'leave_application'], function(){
    Route::get('/','LeaveApplicationController@user_application')->name('');
    Route::get('/pending_list','LeaveApplicationController@index')->name('');
    Route::get('/accept_list','LeaveApplicationController@accept_list')->name('');
    Route::get('/cancle_list','LeaveApplicationController@cancle_list')->name('');
    Route::get('/view/{id}','LeaveApplicationController@show')->name('.view');
    Route::get('/create','LeaveApplicationController@create')->name('.create');
    Route::post('/create','LeaveApplicationController@store')->name('.create');
    Route::get('/accept/{id}','LeaveApplicationController@accept')->name('.accept');
    Route::get('/cancle/{id}','LeaveApplicationController@cancle')->name('.cancle');
});

Route::group(['middleware' => 'auth','prefix' => 'leave'], function(){
    Route::get('create','LeaveController@create');
    Route::get('search','LeaveController@create');
    Route::post('entry','LeaveController@store');
});


Route::group(['middleware' => 'auth','prefix' => 'attendance-list'], function(){
    Route::get('create','AttendanceListController@create');
    Route::get('index','AttendanceListController@index');
    Route::get('create-monthly','AttendanceListController@create_monthly');
    Route::get('view','AttendanceListController@view');
});

Route::group(['middleware' => 'auth','prefix' => 'result-list'], function(){
    Route::get('index','ResultListController@index');
    Route::get('search','ResultListController@index');
    Route::post('print','ResultListController@print_view');
});

Route::group(['middleware' => 'auth','prefix' => 'admit-card'], function(){
    Route::get('create','AdmitCardController@create');
    Route::get('show','AdmitCardController@show');
});

Route::group(['middleware' => 'auth','prefix' => 'exam-seat-plan'], function(){
    Route::get('create','ExamSeatPlanController@create');
    Route::get('show','ExamSeatPlanController@show');
});

Route::group(['middleware' => 'auth','prefix' => 'testimonial'], function(){
    Route::get('/','TestimonialController@index');
    Route::get('search_student','TestimonialController@search_student');
    Route::get('view/{id}','TestimonialController@view');
    Route::get('edit/{id}','TestimonialController@edit');
    Route::post('edit/{id}','TestimonialController@update');
    Route::get('create','TestimonialController@create');
    Route::post('store','TestimonialController@storePrint');
});

Route::group(['middleware' => 'auth','prefix' => 'transfer_certificate'], function(){
    Route::get('/','TransferCertificateController@index');
    Route::get('search_student','TransferCertificateController@search_student');
    Route::get('view/{id}','TransferCertificateController@view');
    Route::get('edit/{id}','TransferCertificateController@edit');
    Route::post('edit/{id}','TransferCertificateController@update');
    Route::get('create','TransferCertificateController@create');
    Route::post('store','TransferCertificateController@storePrint');
});

Route::group(['middleware' => 'auth','prefix' => 'important-settings'], function(){
    Route::get('/','ImportantSettingController@index');
    Route::post('/','ImportantSettingController@store');
});

Route::group(['middleware' => 'auth','prefix' => 'qbank'], function(){
    Route::view('/','questions.master');
    Route::get('create','QuestionBankController@create');
    Route::get('store','QuestionBankController@store');
});


//web mangement route
    //settings
Route::group(['middleware' => 'auth','prefix' => 'school_settings', 'as' => 'school_settings'], function(){
    Route::get('/', 'WmSchoolController@index')->name('');
    Route::put('/', 'WmSchoolController@update')->name('update');
    Route::get('/reset_color', 'WmSchoolController@reset_color')->name('reset_color');
});


//  date language admin
Route::group(['middleware' => 'auth','prefix' => 'admin_date_language', 'as'=>'admin_date_language'], function(){
    Route::get('/','DateLanguageController@index')->name('');
    Route::get('/create','DateLanguageController@create')->name('.create');
    Route::post('/create','DateLanguageController@store')->name('.create');
    Route::get('/edit/{id}','DateLanguageController@edit')->name('.edit');
    Route::put('/edit/{id}','DateLanguageController@update')->name('.edit');
    Route::delete('/delete/{id}','DateLanguageController@destroy')->name('.delete');
});

//  date language
Route::group(['middleware' => 'auth','prefix' => 'date_language', 'as'=>'date_language'], function(){
    Route::get('/','WmDateLanguageController@index')->name('');
    Route::get('/create','WmDateLanguageController@create')->name('.create');
    Route::post('/create','WmDateLanguageController@store')->name('.create');
    Route::get('/edit/{id}','WmDateLanguageController@edit')->name('.edit');
    Route::put('/edit/{id}','WmDateLanguageController@update')->name('.edit');
    Route::delete('/delete/{id}','WmDateLanguageController@destroy')->name('.delete');
});
//  slider
Route::group(['middleware' => 'auth','prefix' => 'slider', 'as'=>'slider'], function(){
    Route::get('/','WmSliderController@index')->name('');
    Route::get('/create','WmSliderController@create')->name('.create');
    Route::post('/create','WmSliderController@store')->name('.create');
    Route::get('/edit/{id}','WmSliderController@edit')->name('.edit');
    Route::put('/edit/{id}','WmSliderController@update')->name('.edit');
    Route::delete('/delete/{id}','WmSliderController@destroy')->name('.delete');
});

//  speech
Route::group(['middleware' => 'auth','prefix' => 'speech', 'as'=>'speech'], function(){
    Route::get('/','WmSpeechController@index')->name('');
    Route::get('/view/{id}','WmSpeechController@show')->name('.view');
    Route::get('/create','WmSpeechController@create')->name('.create');
    Route::post('/create','WmSpeechController@store')->name('.create');
    Route::get('/edit/{id}','WmSpeechController@edit')->name('.edit');
    Route::put('/edit/{id}','WmSpeechController@update')->name('.edit');
    Route::delete('/delete/{id}','WmSpeechController@destroy')->name('.delete');
});
//  general text
Route::group(['middleware' => 'auth','prefix' => 'general_text', 'as'=>'general_text'], function(){
    Route::get('/','WmGeneralTextController@index')->name('');
    Route::get('/view/{id}','WmGeneralTextController@show')->name('.view');
    Route::get('/create','WmGeneralTextController@create')->name('.create');
    Route::post('/create','WmGeneralTextController@store')->name('.create');
    Route::get('/edit/{id}','WmGeneralTextController@edit')->name('.edit');
    Route::put('/edit/{id}','WmGeneralTextController@update')->name('.edit');
    Route::delete('/delete/{id}','WmGeneralTextController@destroy')->name('.delete');
});

//  gallery category
Route::group(['middleware' => 'auth','prefix' => 'gallery_category', 'as'=>'gallery_category'], function(){
    Route::get('/','WmGalleryCategoryController@index')->name('');
    Route::get('/view/{id}','WmGalleryCategoryController@show')->name('.view');
    Route::get('/create','WmGalleryCategoryController@create')->name('.create');
    Route::post('/create','WmGalleryCategoryController@store')->name('.create');
    Route::get('/edit/{id}','WmGalleryCategoryController@edit')->name('.edit');
    Route::put('/edit/{id}','WmGalleryCategoryController@update')->name('.edit');
    Route::delete('/delete/{id}','WmGalleryCategoryController@destroy')->name('.delete');
});

//  image gallery
Route::group(['middleware' => 'auth','prefix' => 'image_gallery', 'as'=>'image_gallery'], function(){
    Route::get('/','WmGalleryController@index')->name('');
    Route::get('/view/{id}','WmGalleryController@show')->name('.view');
    Route::get('/create','WmGalleryController@create')->name('.create');
    Route::post('/create','WmGalleryController@store')->name('.create');
    Route::get('/edit/{id}','WmGalleryController@edit')->name('.edit');
    Route::put('/edit/{id}','WmGalleryController@update')->name('.edit');
    Route::delete('/delete/{id}','WmGalleryController@destroy')->name('.delete');
});
//video gallery
Route::group(['middleware' => 'auth','prefix' => 'video_gallery', 'as'=>'video_gallery'], function(){
    Route::get('/','WmGalleryController@video')->name('');
    Route::get('/view/{id}','WmGalleryController@showVideo')->name('.view');
    Route::get('/create','WmGalleryController@createVideo')->name('.create');
    Route::post('/create','WmGalleryController@storeVideo')->name('.create');
    Route::get('/edit/{id}','WmGalleryController@editVideo')->name('.edit');
    Route::put('/edit/{id}','WmGalleryController@updateVideo')->name('.edit');
    Route::delete('/delete/{id}','WmGalleryController@destroyVideo')->name('.delete');
});

//important link
Route::group(['middleware' => 'auth','prefix' => 'important_link', 'as'=>'important_link'], function(){
    Route::get('/','WmImportantLinkController@index')->name('');
    Route::get('/create','WmImportantLinkController@create')->name('.create');
    Route::post('/create','WmImportantLinkController@store')->name('.create');
    Route::get('/edit/{id}','WmImportantLinkController@edit')->name('.edit');
    Route::put('/edit/{id}','WmImportantLinkController@update')->name('.edit');
    Route::delete('/delete/{id}','WmImportantLinkController@destroy')->name('.delete');
});


//  important links category
Route::group(['middleware' => 'auth','prefix' => 'important_links_category', 'as'=>'important_links_category'], function(){
    Route::get('/','WmImportantLinksCategoryController@index')->name('');
    Route::get('/create','WmImportantLinksCategoryController@create')->name('.create');
    Route::post('/create','WmImportantLinksCategoryController@store')->name('.create');
    Route::get('/edit/{id}','WmImportantLinksCategoryController@edit')->name('.edit');
    Route::put('/edit/{id}','WmImportantLinksCategoryController@update')->name('.edit');
    Route::delete('/delete/{id}','WmImportantLinksCategoryController@destroy')->name('.delete');
});


//  important links category root
Route::group(['middleware' => 'auth','prefix' => 'important_links_category_root', 'as'=>'important_links_category_root'], function(){
    Route::get('/','WmImportantLinksCategoryRootController@index')->name('');
    Route::get('/create','WmImportantLinksCategoryRootController@create')->name('.create');
    Route::post('/create','WmImportantLinksCategoryRootController@store')->name('.create');
    Route::get('/edit/{id}','WmImportantLinksCategoryRootController@edit')->name('.edit');
    Route::put('/edit/{id}','WmImportantLinksCategoryRootController@update')->name('.edit');
    Route::delete('/delete/{id}','WmImportantLinksCategoryRootController@destroy')->name('.delete');
});

//important link root
Route::group(['middleware' => 'auth','prefix' => 'important_link_root', 'as'=>'important_link_root'], function(){
    Route::get('/','WmImportantLinksRootController@index')->name('');
    Route::get('/create','WmImportantLinksRootController@create')->name('.create');
    Route::post('/create','WmImportantLinksRootController@store')->name('.create');
    Route::get('/edit/{id}','WmImportantLinksRootController@edit')->name('.edit');
    Route::put('/edit/{id}','WmImportantLinksRootController@update')->name('.edit');
    Route::delete('/delete/{id}','WmImportantLinksRootController@destroy')->name('.delete');
});

//important file
Route::group(['middleware' => 'auth','prefix' => 'important_file', 'as'=>'important_file'], function(){
    Route::get('/','ImportantFileController@index')->name('');
    Route::post('/create','ImportantFileController@store')->name('.create');
    Route::delete('/delete/{id}','ImportantFileController@destroy')->name('.delete');
});

//important form admin
Route::group(['middleware' => 'auth','prefix' => 'important_form', 'as'=>'important_form'], function(){
    Route::get('/','ImportantFileController@important_form')->name('');
});


//question mcq
Route::group(['middleware' => 'auth','prefix' => 'mcq/question', 'as'=>'mcq.question'], function(){
    Route::get('/','QuestionController@index')->name('');
    Route::get('/subjectwise/{subject_id}','QuestionController@subjectwiseQuestion')->name('.subjectwise');
    Route::get('/student','QuestionController@mcqStudent')->name('.student');
    Route::get('/create','QuestionController@create')->name('.create');
    Route::post('/create','QuestionController@store')->name('.create');
    Route::get('/edit/{id}','QuestionController@edit')->name('.edit');
    Route::put('/edit/{id}','QuestionController@update')->name('.edit');
    Route::delete('/delete/{id}','QuestionController@destroy')->name('.delete');

    Route::get('/all','QuestionController@allMcqQuestion')->name('.all');
    Route::get('/all/subjectwise/{subject_id}','QuestionController@subjectwiseAllMcqQuestion')->name('.all.subjectwise');
});

//question written
Route::group(['middleware' => 'auth','prefix' => 'written/question', 'as'=>'written.question'], function(){
    Route::get('/','QuestionController@indexWritten')->name('');
    Route::get('/subjectwise/{subject_id}','QuestionController@subjectwiseWrittenQuestion')->name('subjectwise');
    Route::get('/student','QuestionController@writtenStudent')->name('.student');
    Route::get('/create','QuestionController@createWritten')->name('.create');
    Route::post('/create','QuestionController@storeWritten')->name('.create');
    Route::get('/edit/{id}','QuestionController@editWritten')->name('.edit');
    Route::put('/edit/{id}','QuestionController@updateWritten')->name('.edit');
    Route::delete('/delete/{id}','QuestionController@destroyWritten')->name('.delete');

    Route::get('/all','QuestionController@allWrittenQuestion')->name('.all');
    Route::get('/all/subjectwise/{subject_id}','QuestionController@subjectwiseAllWrittenQuestion')->name('.all.subjectwise');
});


//exam
Route::group(['middleware' => 'auth','prefix' => 'exam', 'as'=>'exam'], function(){
    Route::get('/mcq','ExamController@index')->name('.mcq');
    Route::get('/written','ExamController@written')->name('.written');
    Route::get('/mcq/student','ExamController@student_mcq')->name('.mcq.student');
    Route::get('/written/student','ExamController@student_written')->name('.written.student');
    Route::get('/show/{id}','ExamController@show')->name('.show');
    Route::get('/mcq/question/{id}','ExamController@mcq_question')->name('.mcq_question');
    Route::get('/written/question/{id}','ExamController@written_question')->name('.mcq_question');
    Route::get('/question/{id}','ExamController@exam_question_mcq')->name('.question');
    Route::get('/question/written/{id}','ExamController@exam_question_written')->name('.question.written');
    Route::post('/question/{id}','ExamController@exam_question_store')->name('.question');
    Route::get('/create','ExamController@create')->name('.create');
    Route::post('/create','ExamController@store')->name('.create');
    Route::get('/edit/{id}','ExamController@edit')->name('.edit');
    Route::post('/edit/{id}','ExamController@update')->name('.edit');
    Route::delete('/delete/{id}','ExamController@destroy')->name('.delete');
});

//exam
Route::group(['middleware' => 'auth','prefix' => 'online-exam/result', 'as'=>'online-exam.result'], function(){
    Route::get('/','OnlineExamResultController@index')->name('');
    Route::post('/create','OnlineExamResultController@store')->name('.create');
    Route::get('/creator/{id}','OnlineExamResultController@creatorResult')->name('.creator');
    Route::get('/pending/{id}/{exam_id}','OnlineExamResultController@pendingResult')->name('.pending');
    Route::get('/evaluate/{id}','OnlineExamResultController@evaluateResult')->name('.evaluate');
    Route::get('/edit/{id}','OnlineExamResultController@evaluateResultEdit')->name('.evaluate');
    Route::get('/view/{id}','OnlineExamResultController@evaluateResultView')->name('.evaluate');
});
Route::group(['middleware' => 'auth','prefix' => 'online-exam', 'as'=>'online-exam'], function(){
    Route::get('written','OnlineWrittenExamAnswerController@index')->name('.written');
    Route::post('written','OnlineWrittenExamAnswerController@store')->name('.written');
    Route::post('/evaluate','OnlineWrittenExamAnswerController@evaluateResult')->name('.evaluate');

});


//chat app
Route::group(['middleware' => 'auth'], function(){
    Route::get('/chat', function () {
        return view('backEnd/chatApp/index');
    });
    Route::get('/profile/image/','ChattingController@profile_image');
    Route::get('/contacts','ChattingController@contacts');
    Route::get('/contacts/search/{data}','ChattingController@contacts');
    Route::get('/convertation/{id}','ChattingController@index');
    Route::post('/message/send','ChattingController@store');
    Route::get('all/convertation/','ChattingController@allConvertation');
});

//social app
Route::group(['middleware' => 'auth','prefix' => 'post', 'as'=>'post'], function(){
    Route::get('/','PostController@index');
    Route::get('/profile/{db}','PostController@profile')->name('.profile');
    Route::get('creator/profile/{id}/{db}','PostController@creator_profile')->name('creator.profile');
    Route::get('/details/{id}','PostController@details')->name('.details');
    Route::post('/create','PostController@store')->name('.create');
    Route::get('/edit/{id}','PostController@edit')->name('.edit');
    Route::post('/edit/{id}','PostController@update')->name('.edit');
    Route::get('/view/{id}','PostController@show')->name('.view');
    Route::get('/delete/{id}','PostController@delete')->name('.delete');
    Route::get('/pending_list','PostController@pending_list')->name('.pending_list');
    Route::get('/accept_list','PostController@accept_list')->name('.accept_list');
    Route::get('/cancel_list','PostController@cancel_list')->name('.cancel_list');
    Route::get('/delete_list','PostController@delete_list')->name('.delete_list');
    Route::get('/accept/{id}','PostController@accept')->name('.accept');
    Route::get('/cancel/{id}','PostController@cancel')->name('.cancel');
});
    Route::get('/post/like','PostReactController@store')->name('post.like');
    Route::get('/post/love','PostReactController@loveStore')->name('post.like');

    Route::post('/add/comment','PostCommentController@store')->name('add.comment')->middleware('auth');



//online admission
Route::group(['middleware' => 'auth','prefix' => 'online_admission', 'as'=>'online_admission'], function(){
    Route::get('/','OnlineAdmissionController@index')->name('');
    Route::get('/create','OnlineAdmissionController@create')->name('.create');
    Route::post('/create','OnlineAdmissionController@store')->name('.create');
    Route::get('/edit/{id}','OnlineAdmissionController@edit')->name('.edit');
    Route::post('/edit/{id}','OnlineAdmissionController@update')->name('.edit');
    Route::get('/delete/{id}','OnlineAdmissionController@destroy')->name('.delete');
    Route::get('/application/{id}','OnlineAdmissionController@application')->name('.application');
    Route::get('/view/{id}','OnlineAdmissionController@view')->name('.view');
    Route::get('/add_merit/{id}','OnlineAdmissionController@add_merit')->name('.add_merit');
    Route::get('/add_waiting/{id}','OnlineAdmissionController@add_waiting')->name('.add_waiting');
    Route::get('/add_reject/{id}','OnlineAdmissionController@add_reject')->name('.add_reject');
    Route::get('/application/delete/{id}','OnlineAdmissionController@application_delete')->name('delete.application');

    Route::get('/merit_list/{id}/{status}','OnlineAdmissionController@application_activity_list')->name('.merit_list');
    Route::get('/waiting_list/{id}/{status}','OnlineAdmissionController@application_activity_list')->name('.waiting_list');
    Route::get('/reject_list/{id}/{status}','OnlineAdmissionController@application_activity_list')->name('.reject_list');
});

//online admission
Route::group(['prefix' => 'online_admission_application', 'as'=>'online_admission_application'], function(){
    Route::get('/','OnlineAdmissionApplicationController@index')->name('');
    Route::get('/create','OnlineAdmissionApplicationController@create')->name('.create');
    Route::post('/create','OnlineAdmissionApplicationController@store')->name('.create');
    Route::get('/edit/{id}','OnlineAdmissionApplicationController@edit')->name('.edit');
    Route::post('/edit/{id}','OnlineAdmissionApplicationController@update')->name('.edit');
    Route::get('/delete/{id}','OnlineAdmissionApplicationController@destroy')->name('.delete');
});


// Student add by Root user
Route::group(['prefix' => 'student', 'as'=>'student.'], function(){
    Route::get('/add','StudentController@student_add_root')->name('add');
    Route::get('/add_info','StudentController@student_add_info')->name('add_info');
    Route::post('/store','StudentController@student_store_root')->name('store');
});

//online admission
Route::group(['prefix' => 'online_class', 'as'=>'online_class'], function(){
    Route::get('/','OnlineClassController@index')->name('');
    Route::get('/create','OnlineClassController@create')->name('.create');
    Route::post('/create','OnlineClassController@store')->name('.create');
    Route::get('/edit/{id}','OnlineClassController@edit')->name('.edit');
    Route::post('/edit/{id}','OnlineClassController@update')->name('.edit');
    Route::get('/delete/{id}','OnlineClassController@destroy')->name('.delete');

    Route::get('/student','OnlineClassController@student_class')->name('.student');

});
