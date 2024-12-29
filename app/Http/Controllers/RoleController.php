<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request) {
        $role_users = User::where('role', $request->role)->get();
        return successResponse("Action completed", $role_users);
    }
    
    public function assignRoleToUser(RoleRequest $request, $user_id) {
        $user = User::findOrFail($user_id);
        $user->role = $request->role;
        $user->save();

        return successResponse("User role added successfully");
    }
}
