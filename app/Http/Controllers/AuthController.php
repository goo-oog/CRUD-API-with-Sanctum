<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:3|confirmed'
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'Error',
                'message' => $validator->messages()->first()
            ];
        }
        $user = User::create([
            'name' => $request->post('name'),
            'password' => password_hash($request->post('password'), PASSWORD_BCRYPT),
            'email' => $request->post('email')
        ]);
        $token = $user->createToken('API Token')->plainTextToken;
        return Response::json([
            'status' => 'Success',
            'message' => 'Registration was successful',
            'data' => [
                'token' => substr($token, strpos($token, '|') + 1)
            ]
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return [
                'status' => 'Error',
                'message' => $validator->messages()->first()
            ];
        }
        if (!Auth::attempt($request->all())) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Credentials do not match',
            ], 401);
        }

        $token = Auth::user()->createToken('API Token')->plainTextToken;

        return Response::json([
            'status' => 'Success',
            'message' => 'Login successful',
            'data' => [
                'token' => substr($token, strpos($token, '|') + 1)
            ]
        ]);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return [
            'status' => 'Success',
            'message' => 'All tokens revoked for user ' . $user->name
        ];
    }

    public function me()
    {
        return Auth::user();
    }
}