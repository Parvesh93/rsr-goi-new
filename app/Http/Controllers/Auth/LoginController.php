<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Http\Request;

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
    
    // protected function redirectTo()
    // {
    // return '/admin/dashboard';
    // }
    


  protected function authenticated(Request $request, $user)
  {
    if ($user->is_admin === 1) {
        return redirect('/admin/dashboard');
    } elseif ($user->is_admin === 0) {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/home');
    }
  }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }


    public function logout(){

        Auth::guard('web')->logout();

        return redirect()->route('login')->with('success', __('auth_logged_out'));
    }
}
