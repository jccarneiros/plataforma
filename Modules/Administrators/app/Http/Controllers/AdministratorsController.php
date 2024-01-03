<?php

namespace Modules\Administrators\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AdministratorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentsCount = DB::table('students')->where('type', '=', 'Regular')->count();

//        dd($studentsCount);

        $rooms = Room::with('tipoEnsino', 'serie','students')->where('type', 'Regular')
            ->orderBy('tipo_ensino_id', 'asc')
            ->orderBy('serie_id', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        $siteInfo = Configuration::first();

        return view('administrators::index', compact('studentsCount', 'rooms', 'siteInfo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrators::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('administrators::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('administrators::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
