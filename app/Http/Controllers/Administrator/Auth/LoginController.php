<?php

namespace App\Http\Controllers\Administrator\Auth;

use App\Http\Controllers\Administrator\Controller;
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

    protected $loginFormPath;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('admin.dashboard');
        $this->loginFormPath = 'v1.admin.layout.login';
    }

    public function dashboard()
    {
	    if(
            auth()->user()->isSuperAdmin() ){
            return redirect()->route('admin.product.index');
        }
	    return redirect()->route('admin.profile', auth()->user()->id);

    }

    public function index()
    {

	    return redirect(route('admin.login'));
    }


}
