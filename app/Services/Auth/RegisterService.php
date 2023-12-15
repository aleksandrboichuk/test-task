<?php

namespace app\Services\Auth;

use App\Http\Requests\RegisterRequest;
use App\Interfaces\RegisterInterface;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterService implements RegisterInterface
{

    public function __construct(
        protected User $model,
        protected UserInterface $userService
    ){}

    /**
     * @inheritDoc
     */
    public function register(RegisterRequest $request, bool $login = false): bool
    {
        if(!$user = $this->userService->store($request)){
            return false;
        }

        if ($login && Auth::loginUsingId($user->id)) {
            $request->session()->regenerate();
        }

        return false;
    }
}
