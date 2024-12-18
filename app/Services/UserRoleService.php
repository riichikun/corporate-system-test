<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class UserRoleService extends BaseService
{
    public function addRole(int $userId, int $roleId)
    {
        $userModel = $this->model::find($userId);
        $userRoles = $userModel->roles();
        if ($userRoles->count() !== null || $userRoles->get($roleId)) {
            $userRoles->attach($roleId);
        }
    }
}