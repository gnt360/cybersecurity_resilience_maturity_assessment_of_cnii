<?php

namespace App\Http\Controllers\V1\Admin;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;

class UserController extends Controller
{
    public function profile()
    {
        return $this->successResponse( new UserResource(auth()->user()));
    }
}
