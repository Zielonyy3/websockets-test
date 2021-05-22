<?php

namespace App\Http\Controllers\Api;

use App\Events\NewPost;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PostsApiController extends Controller
{
    private PostRepositoryContract $postRepository;

    public function __construct(PostRepositoryContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(int $number): JsonResponse
    {
        return response()->json($this->postRepository->last($number));
    }


    public function store(PostStoreRequest $request): JsonResponse
    {
        $post = $this->postRepository->create($request->data()->toArray());
        broadcast(new NewPost($post))->toOthers();
        return response()->json($post);
    }
}
