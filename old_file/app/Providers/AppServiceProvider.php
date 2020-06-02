<?php

namespace App\Providers;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\SchoolClassController;
use View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);
        view()->composer('auth.register', function ($view) {
            $view->with('groups', \App\Group::all());
        });
        view()->composer('backEnd.schools.info', function ($view) {
            $view->with('schools', SchoolController::getSchools());
        });
        view()->composer('backEnd.schools.users', function ($view) {
            $view->with('schools', SchoolController::getSchools());
        });

        view()->composer('backEnd.classes.add', function ($view) {
            $view->with('classes', SchoolClassController::getClasses());
        });
        View::composer(['backEnd.includes.navSide','backEnd.includes.navSideWebmanagement'], function ($view) {
            $photo = LoginController::getUserPhoto();
            $view->with('photo', $photo);
        });

        View::composer('backEnd.includes.navSide', function ($view) {
            $school_type_ids=Auth::schoolType();
            $school_type_ids=explode('|', $school_type_ids);
            $view->with('school_type_ids', $school_type_ids);
        });



        View::composer('*', function ($view) {
            $s = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December','Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', ',');
            $view->with('s', $s);
        });

        view()->composer('backEnd.includes.navSide', function ($view) {
            $view->with('imp_setting', \App\ImportantSetting::where('school_id',Auth::getSchool())->first());
        });

        View::composer('*', function ($view) {
            $r= array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', 'শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শক্রবার', 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপটেম্বর', 'অক্টোবর', 'নভেম্ভর', 'ডিসেম্বর','শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শক্রবার', 'জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপটেম্বর', 'অক্টোবর', 'নভেম্ভর', 'ডিসেম্বর', ',');
            $view->with('r', $r);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
