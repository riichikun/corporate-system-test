<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\UserRoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserRoleController extends Controller
{
    public function create(Request $request, int $userId, int $roleId, UserRoleService $service)
    {
        if (array_intersect(['Admin', 'Super Admin'], $request->get('roles'))) {
            $service->addRole($userId, $roleId);            
        }
        return view('layouts.users', [
            'roles' => $request->get('roles'),
            'users' => $service->all(),
        ]);
    }
}
