<?php

namespace App\Http\Controllers\Resource;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Interfaces\PostInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class PostController extends ResourceController
{
    public function __construct(PostInterface $service)
    {
        parent::__construct($service, 'post');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory
    {
        return view("$this->entity.resource.index", ['items' => $this->service->all(relations: ['author'])]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request): RedirectResponse
    {
        try{

            if($this->service->store($request)){
                return redirect()->route('post.index');
            }

        }catch (\Exception $exception){
            // logging
        }

        return back()->withErrors(['system' => "Something went wrong, try again later."]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(PostUpdateRequest $request, string $id): RedirectResponse
    {
        try{

            if($this->service->update($request, $id)){
                return redirect()->route('post.index');
            }

        }catch (\Exception $exception){
            // logging
        }

        return back()->withErrors(['system' => "Something went wrong, try again later."]);
    }
}
