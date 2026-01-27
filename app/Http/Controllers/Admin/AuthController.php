<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ((bool) config('admin.disabled', false)) {
            return response()->json(['message' => 'Admin is disabled'], 403);
        }

        $allowedEmails = (array) config('admin.allowed_emails', []);

        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['nullable', 'string', 'max:255'],
        ]);

        if (empty($allowedEmails) || ! in_array(strtolower($validated['email']), array_map('strtolower', $allowedEmails), true)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        /** @var User|null $user */
        $user = User::query()->where('email', $validated['email'])->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $tokenName = $validated['device_name'] ?? 'mobile';
        $token = $user->createToken($tokenName);

        return response()->json([
            'token' => $token->plainTextToken,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()?->currentAccessToken()?->delete();

        return response()->json(['status' => 'ok']);
    }
}
