<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard\Administrations;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class UsersController extends Controller
{
    public function index(): View
    {
        return view('dashboard.administrations.users.index');
    }
}
