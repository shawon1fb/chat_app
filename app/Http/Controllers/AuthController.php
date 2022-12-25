<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use SebastianBergmann\Environment\Console;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln("Hello from Terminal");
        $user = User::where('email', $request->email)->first();

        $out->writeln(json_encode($user,JSON_PRETTY_PRINT));
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return [
            'user' => $user,
            'token' => $user->createToken($request->email)->plainTextToken,
        ];
    }

}
