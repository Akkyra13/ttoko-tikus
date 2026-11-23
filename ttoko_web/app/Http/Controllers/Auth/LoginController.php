<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $req)
    {
        $d = $req->validate([
            'username' => 'required',
            'password' => 'required',
            ]);

        $user = new User;

        if ($user->checkPasswordUsername($d['username'], $d['password'])) {
            $user = $user->getWhereUsername($d['username']);
            $req->session()->regenerate();
            session(['username' => $user->username]);
            session(['iduser' => $user->iduser]);
            session(['idrole' => $user->role_id]);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(
            [
            'username' => 'kredensial tidak cocok',
            ]
        );
    }

    public function logout(Request $req)
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/login');
    }
}
