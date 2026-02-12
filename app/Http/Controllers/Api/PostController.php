<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index(Request $request)
    {
        $posts = Post::paginate($request->get('per_page', 15));

        return new PostCollection($posts);
    }

    /**
     * Store a newly created post.
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());
        
        return new PostResource($post);
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $post->update($validated);

        return new PostResource($post);
    }

    /**
     * Remove the specified post.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}