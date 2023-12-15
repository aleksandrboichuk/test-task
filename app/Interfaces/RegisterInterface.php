<?php

namespace App\Interfaces;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

interface RegisterInterface
{
    /**
     * Registration action
     *
     * @param RegisterRequest $request
     * @param bool $login
     * @return bool
     */
    public function register(RegisterRequest $request, bool $login = false): bool;
}
