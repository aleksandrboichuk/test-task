<?php

namespace App\Services;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Interfaces\PostInterface;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PostService extends ModelService implements PostInterface
{
    public function __construct()
    {
        parent::__construct(new Post);
    }

    /**
     * @inheritDoc
     */
    public function all(int $perPage = 5, array $relations = []): LengthAwarePaginator
    {
        return $this->model->query()->with($relations)->paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function store(PostStoreRequest $request): Model|Builder
    {
        $data = array_merge([
            'created_by' => auth()->id()
        ], $request->validated());

        return $this->model->query()->create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(PostUpdateRequest $request, string $id): bool|int|null
    {
        return $this->find($id)?->update($request->validated());
    }

    /**
     * @inheritDoc
     */
    public function destroy(string $id): bool|null
    {
        return $this->find($id)?->delete();
    }
}
