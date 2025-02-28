<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   public function register(Request $request) {
    $fields = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed',
        'role' => 'required|in:user,expert',
    ]);


    $user = User::create([
        'name' => $fields['name'],
        'email' => $fields['email'],
        'password' => Hash::make($fields['password']),
        'role' => $fields['role'],
    ]);


    $user->sendEmailVerificationNotification();


    return response()->json([
        'message' => 'Registration successful! Please verify your email before logging in.'
    ], 201);
}

    
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if(!$user || !Hash::check($request->password, $user->password)) {
            return [
                'message' => 'The provided credentials are incorrect'
            ];
        }
    

        if (!$user->hasVerifiedEmail()) {
            return [
                'message' => 'Please verify your email address before logging in.'
            ];
        }
    

        $token = $user->createToken($user->name);
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }
    

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return [
            'message' => 'You are logged out'
        ];
    }

        public function verifyEmail(Request $request, $id, $hash){
        $user = User::findOrFail($id);

        
        if (!hash_equals((string) $hash, (string) sha1($user->email))) {
            throw new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException('Invalid email verification link');
        }


        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }

        return redirect()->route('verification.success');
    }    
}