<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->identifier || !$request->identifier) {
            return response('not found', 419)->json([
                'success' => false,
                'message' => __('auth.login.failed'),
            ]);
        }
        $user = User::where('identifier', $request->identifier)->first();//s22017245
        if ($user && !Hash::check($request->password, $user->password)) {
            return response('not found', 400)->json([
                'success' => false,
                'message' => __('auth.login.failed'),
            ]);
        }
        $student = Student::query()->where('user_identifier', $request->identifier)->first();
        if ($student) {
            $token = $user->createToken($user->identifier)->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => __('auth.login.success.student'),
                'data' => [
                    'token' => $token,
                    'student' => $student,
                    ]
            ]);
        }
        $teacher = Teacher::query()->where('user_identifier', $request->identifier)->first();
        if ($teacher) {
            $token = $user->createToken($user->identifier)->plainTextToken;
            return response()->json([
                'success' => true,
                'message' => __('auth.login.success.teacher'),
                'data' => [
                    'token' => $token,
                    'teacher' => $teacher,]
            ]);
        }

        return response('not found', 404)->json([
            'success' => false,
            'message' => __('auth.login.failed'),
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();
            $user->tokens()->delete();

            return response()->json([
                'success' => true,
                'message' => __('auth.logout.success')
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => __('auth.logout.repeat')
        ], ResponseAlias::HTTP_ALREADY_REPORTED);
    }
}
