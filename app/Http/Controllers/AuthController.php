<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\MeResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Registration
     *
     * Create a new User
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $validatedUser = $request->validated();

        $user = User::query()->create(
            [
                'name' => $validatedUser['name'],
                'email' => $validatedUser['email'],
                'password' => bcrypt($validatedUser['password']),
            ]
        );

        // User sanctum token
        $token = $user->createToken('myapptoken')->plainTextToken;
        $user->remember_token = $token;


        $response = [
            'token' => $token,
            'user' => $user,
        ];

        return new JsonResponse(['payload' => $response], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $fields = $request->validated();

        $user = User::query()->where('email', $fields['email'])->first();

//        if (!$user->email_verified_at) {
//            throw new HttpException(403, 'User email is not verified');
//        }

        // Check if user is found or not
        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], 404, ['Accept' => 'application/json']);
        }

        if (!Hash::check($fields['password'], $user->password)) {
            return new JsonResponse(['message' => 'Bad credentials'], 401, ['Accept' => 'application/json']);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $user->save();

        $response = [
            'message' => "Successful login",
            'token' => $token,
        ];

        return new JsonResponse(
            MeResource::make($user)
                ->additional(
                    array_merge(
                        $response,
                        [
                            'token' => $token,
                        ]
                    )
                )
        );
    }
}
