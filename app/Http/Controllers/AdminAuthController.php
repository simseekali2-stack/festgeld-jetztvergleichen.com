<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Die angegebenen Anmeldedaten sind falsch.'
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token' => $user->createToken('admin-panel')->plainTextToken,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }

    public function me(Request $request)
    {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    }

    public function seed(Request $request)
    {
        // One-time emergency seed if user doesn't exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@festgeld.local'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password')
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Admin seeded (admin@festgeld.local / password)'
        ]);
    }
}
