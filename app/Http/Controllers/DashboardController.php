<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        $studentsCount = DB::table('students')->where('type', '=', 'Regular')->count();

//        dd($studentsCount);

        $rooms = Room::with('tipoEnsino', 'serie','students')->where('type', 'Regular')
            ->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc')
            ->orderBy('name', 'asc')
            ->get();


        return view('dashboard', compact('studentsCount', 'rooms'));
    }
}
