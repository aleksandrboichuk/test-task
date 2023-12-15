<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Interfaces\LoginInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(protected LoginInterface $service){}

    /**
     * Login page
     *
     * @return View|Application|Factory
     */
    public function index(): View|Application|Factory
    {
        return view('auth.login');
    }

    /**
     * Authentication request
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function authenticate(LoginRequest $request): RedirectResponse
    {
        return $this->service->login($request)
            ? redirect()->route('home')
            : back()->withErrors([
                'email' => "Email or password is incorrect",
            ])->onlyInput('email');
    }

    /**
     * Logout request
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
