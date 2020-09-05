<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Response;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request, Hasher $hasher)
    {
        $this->validate($request, ['email' => 'required', 'password' => 'required']);

        $credentials = $request->only('email', 'password');

        /** @var User $user */
        $user = User::findByEmail($credentials['email']);

        if(! $user) {
            return Response::badRequest(
                'User_not_found',
                'User account not found'
            );
        }

        if (! $hasher->check($credentials['password'], $user->password)) {
            return Response::unauthorized();
        }

        return UserResource::make($user);
    }
}
