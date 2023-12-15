<?php

namespace App\Http\Controllers\Resource;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Interfaces\UserInterface;
use Illuminate\Http\RedirectResponse;

class UserController extends ResourceController
{
    public function __construct(UserInterface $service)
    {
        parent::__construct($service, 'user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        try{

            if($this->service->store($request)){
                return redirect()->route('user.index');
            }

        }catch (\Exception $exception){
            // logging
        }

        return back()->withErrors(['system' => "Something went wrong, try again later."]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request, string $id): RedirectResponse
    {
        try{

            if($this->service->update($request, $id)){
                return redirect()->route('user.index');
            }

        }catch (\Exception $exception){
            // logging
        }

        return back()->withErrors(['system' => "Something went wrong, try again later."]);
    }
}
