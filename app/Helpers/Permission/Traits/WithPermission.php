<?php

namespace App\Helpers\Permission\Traits;

use Illuminate\Support\Facades\Auth;

trait WithPermission
{
    public function permission(string $permissionId)
    {
        $user = Auth::guard('admin')->user();
        $permissionNames = $user->getAllPermissions()->pluck('name')->toArray();

        if (!$user) {
            return $this->unauthorizedPermission('User not authenticated.');
        }

        if (empty($permissionNames)) {
            return $this->unauthorizedPermission('No permissions assigned to this user.');
        }

        // if (!in_array($permissionId, $permissionNames)) {
        //     abort(403, 'Unauthorized: missing permission "' . $permissionId . '"');
        // }

        if (!in_array($permissionId, $permissionNames)) {
            $this->redirect('/403');
            return false;
        }

        return true;
    }
}
