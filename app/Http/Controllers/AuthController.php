<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterUserRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'full_name' => $request['full_name'],
            'org_id' => $request['org_id'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        return $this->successResponse(['token' => $user->createToken('API Token')->plainTextToken], 'User created successfully', Response::HTTP_CREATED);

    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->all())) {
            return $this->errorResponse(null, 'Credentials not match', Response::HTTP_UNAUTHORIZED);
        }

        return $this->successResponse(['token' => auth()->user()->createToken('API Token')->plainTextToken], 'Login successful', Response::HTTP_OK);

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->successResponse(null, 'Logout successful', Response::HTTP_OK);

    }
}
