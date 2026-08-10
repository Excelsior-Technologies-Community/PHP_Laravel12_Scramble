<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * Supports:
     * - Search by title/content
     * - Status filter
     * - Sorting
     * - Pagination
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',

            'status' => [
                'nullable',
                Rule::in(['active', 'inactive']),
            ],

            'sort' => [
                'nullable',
                Rule::in(['latest', 'oldest', 'title']),
            ],

            'per_page' => 'nullable|integer|min:1|max:100',
        ]);

        $query = Post::query();

        /*
        |--------------------------------------------------------------------------
        | Search by title/content
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        switch ($request->get('sort', 'oldest')) {

            case 'oldest':
                $query->oldest();
                break;

            case 'title':
                $query->orderBy('title', 'asc');
                break;

            case 'latest':
            default:
                $query->latest();
                break;
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $perPage = $request->integer('per_page', 5);

        $posts = $query->paginate($perPage);

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

            'status' => [
                'sometimes',
                Rule::in(['active', 'inactive']),
            ],
        ]);

        $post->update($validated);

        return new PostResource($post->fresh());
    }

    /**
     * Remove the specified post.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully'
        ]);
    }
}
