<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json(['message' => 'Неверный email или пароль'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('access_token')->accessToken;

        return response()->json(['token' => $token]);
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->userRepository->create($request->all());

        $token = $user->createToken('Access Token')->accessToken;

        return response()->json(['token' => $token]);
    }
}
