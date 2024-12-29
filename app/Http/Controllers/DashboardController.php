<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $profile = User::where('id', Auth::user()->id)->first();
        return successResponse("Profile fetched successfully", $profile);
    }
}
