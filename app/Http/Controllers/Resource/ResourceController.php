<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ResourceController extends Controller
{
    public function __construct(
        protected $service,
        protected string $entity
    ){}

    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory
    {
        return view("$this->entity.resource.index", ['items' => $this->service->all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Application|Factory
    {
        return view("$this->entity.resource.create");
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return View|Application|Factory
     */
    public function show(string $id): View|Application|Factory
    {
        $item = $this->service->find($id);

        $item ?: abort(404);

        return view("$this->entity.resource.show", compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return View|Application|Factory
     */
    public function edit(string $id): View|Application|Factory
    {
        $item = $this->service->find($id);

        $item ?: abort(404);

        return view("$this->entity.resource.edit", compact('item'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        try{

            if($this->service->destroy($id)){
                return redirect()->route("$this->entity.index");
            }

        }catch (\Exception $exception){
            // logging
        }

        return back()->withErrors(['system' => "Something went wrong, try again later."]);
    }
}
