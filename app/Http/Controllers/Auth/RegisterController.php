<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Interfaces\RegisterInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function __construct(protected RegisterInterface $service){}

    /**
     * Registration page
     *
     * @return View|Application|Factory
     */
    public function index(): View|Application|Factory
    {
        return view('auth.register');
    }

    /**
     * Authentication request
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        try{

            $this->service->register($request, true);

            return redirect()->route('home');

        }catch (\Exception $exception){

            // logging

            return back()->withErrors([
                'email' => "Something went wrong, try again later.",
            ])->onlyInput('email');
        }
    }
}
