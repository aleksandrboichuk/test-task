<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserService extends ModelService implements UserInterface
{
    public function __construct()
    {
        parent::__construct(new User);
    }

    /**
     * @inheritDoc
     */
    public function all(int $perPage = 5, array $relations = []): LengthAwarePaginator
    {
        return $this->model->query()->with($relations)->orderByDesc('id')->paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function store(UserStoreRequest|RegisterRequest $request): Model|Builder
    {
        return $this->model->query()->create($request->validated());
    }

    /**
     * @inheritDoc
     */
    public function update(UserUpdateRequest $request, string $id): bool|int|null
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

    /**
     * Finding User by Email
     *
     * @param string $email
     * @return Model|Builder|null
     */
    public function findByEmail(string $email): Model|Builder|null
    {
        return $this->model->query()->where('email', $email)->first();
    }
}
