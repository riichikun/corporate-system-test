<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request, UserService $service): View
    {
        return view('layouts.users', [
            'roles' => $request->get('roles'),
            'users' => $service->all(),
        ]);
    }

    public function show(Request $request, UserService $service): View
    {
        return view('layouts.user', [
            'roles' => $request->get('roles'),
            $service->all(),
        ]);
    }
}
