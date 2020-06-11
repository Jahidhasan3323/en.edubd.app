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
 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace'=>'Api'], function(){
    Route::get('school','SchoolController@index');
    Route::get('student','StudentController@index');
    Route::get('teacher','TeacherController@index');
    Route::get('staff','StaffController@index');
    Route::get('commitee','CommiteeController@index');
    Route::get('absent','AbsentNotifyController@send');
    Route::get('absent/staff','AbsentNotifyController@send_for_staff');
});
    

Route::group(['namespace'=>'Api','prefix'=>'notice'], function(){
    Route::get('','NoticeController@index');
});
Route::group(['namespace'=>'Api','prefix'=>'advertisement'], function(){
    Route::get('','AdvertisementController@index');
});



//starting v1 from here

Route::group(['namespace'=>'Api\V1','prefix'=>'v1/school'], function(){
    Route::get('serial','SchoolController@get_serial');
    Route::get('/','SchoolController@index');
    Route::get('student','SchoolController@students');
    Route::get('teacher','SchoolController@teachers');
    Route::get('staff','SchoolController@staff');
    Route::get('committee','SchoolController@commitee');
    Route::get('date_laguage','SchoolController@date_laguage');
    Route::get('notice','SchoolController@notice');
    Route::get('image_home','SchoolController@image_home');
    Route::get('important_link_header','SchoolController@important_link_header');
    Route::get('important_link','SchoolController@important_link');
    Route::get('important_file','SchoolController@important_file');
    Route::get('student_count','SchoolController@student_count');
    Route::get('slider','SchoolController@slider');
    Route::get('home_data','SchoolController@home_data');
    Route::get('wm_schools','SchoolController@wm_schools');
    Route::get('information_details','SchoolController@information_details');
    Route::get('notice_details','SchoolController@notice_details');
    Route::get('accademic_information','SchoolController@accademic_information');
    Route::get('admission_information','SchoolController@admission_information');
    Route::get('fee','SchoolController@fee');
    Route::get('dress','SchoolController@dress');
    Route::get('image_category','SchoolController@image_category');
    Route::get('video_category','SchoolController@video_category');
    Route::get('image','SchoolController@image');
    Route::get('video','SchoolController@video');
    Route::get('accademic_vacation','SchoolController@accademic_vacation');
    Route::get('accademic_vacation_list','SchoolController@accademic_vacation_list');
    Route::get('class','SchoolController@class');
    Route::get('student','SchoolController@student');
    Route::get('birthday','SchoolController@birthday');
    Route::post('suggetion','SchoolController@suggetion');
    Route::post('online_admission_application','SchoolController@online_admission_application');
    Route::get('online_admission_application_form','SchoolController@online_admission_application_form');
    Route::get('merit_list','SchoolController@merit_list');
    Route::get('waiting_list','SchoolController@waiting_list');
    Route::get('admission_notice','SchoolController@admission_notice');
    Route::post('admit_card','SchoolController@admit_card');
});




Route::group(['namespace'=>'Api','prefix'=>'notice'], function(){
    Route::get('v1','NoticeController@index');
});

Route::group(['namespace'=>'Api','prefix'=>'advertisement'], function(){
    Route::get('v1','AdvertisementController@index');
});
