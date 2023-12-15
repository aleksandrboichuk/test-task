<?php

namespace app\Services\Auth;

use App\Http\Requests\LoginRequest;
use App\Interfaces\LoginInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginService implements LoginInterface
{
    /**
     * @inheritDoc
     */
    public function login(LoginRequest $request): bool
    {
        if (Auth::attempt($request->validated())) {

            $request->session()->regenerate();

            return true;
        }

        return false;
    }
}
