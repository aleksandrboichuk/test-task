<?php

namespace App\Interfaces;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface PostInterface
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
     * @param PostStoreRequest $request
     * @return Model|Builder
     */
    public function store(PostStoreRequest $request):  Model|Builder;

    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param string $id
     * @return bool|int|null
     */
    public function update(PostUpdateRequest $request, string $id): bool|int|null;

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return bool|null
     */
    public function destroy(string $id): bool|null;
}
