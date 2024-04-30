<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources as Resources;
use App\Models as Models;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProfileController extends Controller
{
    public function profile(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::guard('sanctum')->user();
        if ($user->student) {
            return response()->json([
                'success' => true,
                'message' => __('Profile student'),
                'data' => [
                    'student' => Resources\Profile\StudentResource::make($user->student),
                ],
            ]);
        }
        if ($user->teacher) {
            return response()->json([
                'success' => true,
                'message' => __('Profile teacher'),
                'data' => [
                    'teacher' => Resources\Profile\TeacherResource::make($user->teacher),
                ],
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => __('Profile not found'),
        ]);
    }
}
