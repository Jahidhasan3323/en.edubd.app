<?php

namespace Illuminate\Support\Facades;
use App\School;
use App\Staff;
use App\Student;
use App\Commitee;

/**
 * @method static mixed guard(string|null $name = null)
 * @method static void shouldUse(string $name);
 * @method static bool check()
 * @method static bool guest()
 * @method static \Illuminate\Contracts\Auth\Authenticatable|null user()
 * @method static int|null id()
 * @method static bool validate(array $credentials = [])
 * @method static void setUser(\Illuminate\Contracts\Auth\Authenticatable $user)
 * @method static bool attempt(array $credentials = [], bool $remember = false)
 * @method static bool once(array $credentials = [])
 * @method static void login(\Illuminate\Contracts\Auth\Authenticatable $user, bool $remember = false)
 * @method static \Illuminate\Contracts\Auth\Authenticatable loginUsingId(mixed $id, bool $remember = false)
 * @method static bool onceUsingId(mixed $id)
 * @method static bool viaRemember()
 * @method static void logout()
 * @method static \Symfony\Component\HttpFoundation\Response|null onceBasic(string $field = 'email',array $extraConditions = [])
 * @method static bool|null logoutOtherDevices(string $password, string $attribute = 'password')
 * @method static \Illuminate\Contracts\Auth\UserProvider|null createUserProvider(string $provider = null)
 * @method static \Illuminate\Auth\AuthManager extend(string $driver, \Closure $callback)
 * @method static \Illuminate\Auth\AuthManager provider(string $name, \Closure $callback)
 *
 * @see \Illuminate\Auth\AuthManager
 * @see \Illuminate\Contracts\Auth\Factory
 * @see \Illuminate\Contracts\Auth\Guard
 * @see \Illuminate\Contracts\Auth\StatefulGuard
 */
class Auth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'auth';
    }

    /**
     * Register the typical authentication routes for an application.
     *
     * @param  array  $options
     * @return void
     */
    public static function routes(array $options = [])
    {
        static::$app->make('router')->auth($options);
    }

    /*
     | This is for check permissions.
     */
    public static function is($permissionName)
    {
        $userData = DB::table('users')->join('groups', function ($join) {
            $join->on('users.group_id', '=', 'groups.id')->where('users.id', '=', Auth::user()->id);
        })->first();
        
        if ($userData->permission === $permissionName) {
            return true;
        }else {
            return false;
        }
    }
    
    public static function schoolType()
    {
        if (Auth::is('admin')){
            $school = School::where('user_id', Auth::user()->id)->first();
            return $school->school_type_id;
        }

        if (Auth::is('teacher')){
            $staff = Staff::with('school')->where('user_id', Auth::user()->id)->first();
            return $staff->school->school_type_id;
        }

        if (Auth::is('student')){
            $student = Student::with('school')->where('user_id', Auth::user()->id)->first();
            return $student->school->school_type_id;
        }
    }
    public static function getSchool()
    {
        if (Auth::is('admin')){
            $school = School::where('user_id', Auth::user()->id)->first();
            return $school->id;
        }

        if (Auth::is('staff')){
            $staff = Staff::where('user_id', Auth::user()->id)->first();
            return $staff->school_id;
        }

        if (Auth::is('teacher')){
            $staff = Staff::where('user_id', Auth::user()->id)->first();
            return $staff->school_id;
        }

        if (Auth::is('student')){
            $student = Student::where('user_id', Auth::user()->id)->first();
            return $student->school_id;
        }
        if (Auth::is('commitee')){
            $commitee = Commitee::where('user_id', Auth::user()->id)->first();
            return $commitee->school_id;
        }
    }

    public static function calculateResult($marks, $fullMarks)
    {
        $gpaPoint = [];

        if ($marks > (79 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 5, 'grade' => 'A+');
        } elseif ($marks < (80 / 100) * $fullMarks && $marks > (69 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 4, 'grade' => 'A');

        } elseif ($marks < (70 / 100) * $fullMarks && $marks > (59 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 3.5, 'grade' => 'A-');

        } elseif ($marks < (60 / 100) * $fullMarks && $marks > (49 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 3, 'grade' => 'B');

        } elseif ($marks < (50 / 100) * $fullMarks && $marks > (39 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 2, 'grade' => 'C');

        } elseif ($marks < (40 / 100) * $fullMarks && $marks > (32 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 1, 'grade' => 'D');

        }else if($marks < (33 / 100) * $fullMarks){
            $gpaPoint = array('gpa' => 0, 'grade' => 'F');
        }

        return $gpaPoint;
    }

    public static function grade($gpa)
    {
        if ($gpa == 5){
            $grade = 'A+';
        } elseif ($gpa < 5 && $gpa >= 4){
            $grade = 'A';
        } elseif ($gpa < 4 && $gpa >= 3.5){
            $grade = 'A-';
        } elseif ($gpa < 3.5 && $gpa >= 3){
            $grade = 'B';
        } elseif ($gpa < 3 && $gpa >= 2){
            $grade = 'C';
        } elseif ($gpa < 2 && $gpa >= 1){
            $grade = 'D';
        }else{
            $grade = 'F';
        }
        return $grade;
    }
}
