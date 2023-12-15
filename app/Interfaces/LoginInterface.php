<?php

namespace App\Interfaces;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

interface LoginInterface
{
    /**
     * Login action
     *
     * @param LoginRequest $request
     * @return bool
     */
    public function login(LoginRequest $request): bool;
}
