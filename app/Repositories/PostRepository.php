<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;
use Illuminate\Database\Eloquent\Collection;

class PostRepository extends BaseRepository implements PostRepositoryContract
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->orderByDesc('updated_at')->get();
    }
}
