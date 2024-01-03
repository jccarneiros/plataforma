<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\Dashboard\UserController;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PainelStudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index($code): \Illuminate\Contracts\Support\Renderable
    {
        $student = DB::table('users')->where('code', '=', auth()->user()->code)->first();

        return view('students.painel', compact('student'));
    }
}
