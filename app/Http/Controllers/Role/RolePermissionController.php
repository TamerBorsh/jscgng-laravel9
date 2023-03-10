<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class RolePermissionController extends Controller
{
    public function update(Request $request, Role $role)
    {
        $permission = Permission::findOrFail($request->input('permission_id'));
        $message = '';
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            $message = 'تم ازالة الصلاحية';
        } else {
            $role->givePermissionTo($permission);
            $message = 'تم ربط الصلاحية';
        }
        return response()->json(['message' => $message], Response::HTTP_OK);
    }
}
