<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request)
    {
        if (is_numeric($request->email)){
            if (Auth::attempt(['mobile' => $request->email, 'password' => $request->password], $request->has('remember'))) {
                return true;
            }
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->has('remember'))) {
            return true;
        }
    }

    /*
     * For admin panel nav img........
     */
    public static function getUserPhoto()
    {
        if (Auth::is('admin')){
            $photo = DB::table('schools')->select(array('logo'))->where('user_id', Auth::user()->id)->first();
            $photo = $photo->logo;
        }elseif (Auth::is('teacher')){
            $photo = DB::table('staff')->select(array('photo'))->where('user_id', Auth::user()->id)->first();
            $photo = $photo->photo;
        }elseif (Auth::is('student')) {
            $photo = DB::table('students')->select(array('photo'))->where('user_id', Auth::user()->id)->first();
            $photo = $photo->photo;
        } else{
            $photo = 'img/ehsan-logo.png';
        }

        return $photo;
    }

    public function showLoginForm()
    {
        return view('backEnd.login');
    }

}