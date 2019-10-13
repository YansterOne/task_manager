<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Responses\LoginResponse;
use Core\User\Exceptions\PasswordNotMatchException;
use Core\User\UserService;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $response = new LoginResponse();
        try {
            $this->userService->login($request, $response);
        } catch (PasswordNotMatchException $exception) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }
        return $response;
    }
}
