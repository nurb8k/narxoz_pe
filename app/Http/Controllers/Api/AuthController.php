<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources as Resources;
use App\Models as Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = Models\User::where('identifier', $request->identifier)->first();//s22017245
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => __('Неверное имя пользователя или пароль. Пожалуйста, попробуйте снова'),
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        $student = Models\Student::query()->where('user_identifier', $request->identifier)->first();
        if ($student) {
            $token = $user->createToken($user->identifier)->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => __('Login success student'),
                'data' => [
                    'token' => $token,
                    'user' => Resources\Profile\StudentResource::make($student),
                ],
            ]);
        }
        $teacher = Models\Teacher::query()->where('user_identifier', $request->identifier)->first();
        if ($teacher) {
            $token = $user->createToken($user->identifier)->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => __('Login success teacher'),
                'data' => [
                    'token' => $token,
                    'user' => Resources\Profile\TeacherResource::make($teacher),
                ]
            ]);
        }

        return response('not found', 404)->json([
            'success' => false,
            'message' => __('Неверное имя пользователя или пароль. Пожалуйста, попробуйте снова'),
        ]);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => __('You successfully logged out.')
        ], ResponseAlias::HTTP_OK);
    }

}
