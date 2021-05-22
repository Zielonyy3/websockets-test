<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostsController extends Controller
{
    private PostRepositoryContract $postRepository;

    public function __construct(PostRepositoryContract $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index(): View
    {
        $posts = $this->postRepository->all();
        return view('posts.index', compact('posts'));
    }

    public function store(PostStoreRequest $request): RedirectResponse
    {
        $this->postRepository->create($request->data()->toArray());
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $this->postRepository->delete($post);
        return redirect()->route('posts.index')->with('flash_message', 'Post usuniety');
    }

}
