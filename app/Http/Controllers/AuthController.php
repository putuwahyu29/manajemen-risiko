<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request): RedirectResponse
    {
        $jwt = $request->query('token');
        if ($jwt) {
            try{
                $key = config('majapahit.key');
                $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

                $user = User::updateOrCreate([
                    'email' => $decoded->email,
                ], [
                    'name' => $decoded->nama,
                ]);

                Auth::login($user);
                return redirect('/');
            } catch (\Exception $e) {
                return redirect('/');
            }
        }
        elseif (Auth::check()) {
            return redirect('/');
        }
        return redirect(config('majapahit.url'));
    }
}
