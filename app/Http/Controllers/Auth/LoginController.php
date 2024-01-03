<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

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
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    private Request $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest')->except('logout');
        $this->request = $request;
    }

    public function check()
    {
        return view('auth.check');
    }

    public function checkEmail()
    {

        $user = DB::table('users')
            ->where('active', '=', 1)
            ->where('email', '=', $this->request->input('email'))->first();

        if ($user) {
            return view('auth.login', compact('user'));
        } else {

            alert()->warning('Atenção', 'Não encontramos este email em nosso registro!');

            return redirect()->route('check');
        }

    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'active' => 1])) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }
        alert()->warning('Atenção', 'As credenciais fornecidas não correspondem aos nossos registros!');

        return redirect()->back();
    }
}
