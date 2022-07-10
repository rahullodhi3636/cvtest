<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = '/quick_sale';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectTo()
    {
        $role = Auth::user()->department;
        switch ($role) {
            case '1':
                return '/quick_sale';
                break;
            case '2':
                return 'recent_checkin';
                break;
            case '3':
                return '/quick_sale';
                break;
            case '4':
                return '/admin/checkin';
                break;
            default:
                return '/quick_sale';
                break;
        }
    }
}
