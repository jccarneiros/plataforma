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

class LoginStudentController extends Controller
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
    protected $redirectTo = RouteServiceProvider::STUDENT;

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

    public function checkStudent()
    {
        return view('auth.check-student');
    }

    public function checkRaStudent()
    {
        $student = DB::table('students')
            ->where('number_ra', '=', $this->request->input('number_ra'))->first();


        if ($student) {
            return view('auth.login-student', compact('student'));
        } else {

            alert()->warning('Atenção', 'Não encontramos este email em nosso registro!');

            return redirect()->route('check.student');
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

            return redirect()->intended('/' . Auth::user()->code . '/students');
        }
        alert()->warning('Atenção', 'As credenciais fornecidas não correspondem aos nossos registros!');

        return redirect()->back();
    }
}
