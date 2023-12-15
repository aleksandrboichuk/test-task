<?php

namespace App\Interfaces;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface UserInterface
{
    /**
     * All entries with pagination
     *
     * @param int $perPage
     * @param array $relations
     * @return mixed
     */
    public function all(int $perPage = 10, array $relations = []): LengthAwarePaginator;

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest|RegisterRequest $request
     * @return Model|Builder
     */
    public function store(UserStoreRequest|RegisterRequest $request):  Model|Builder;

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param string $id
     * @return bool|int|null
     */
    public function update(UserUpdateRequest $request, string $id): bool|int|null;

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return bool|null
     */
    public function destroy(string $id): bool|null;
}
