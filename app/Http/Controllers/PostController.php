<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    function index()
    {
        return view('posts.index');
    }

    function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'text' => 'required|string|max:80',
            ]);
            $validated['user_id'] = Auth::id();
            $post = Post::create($validated);

            return response()->json([
                'message' => 'Post created successfully!',
                'post' => $post,
                'redirect' => route('posts.index'),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    function getData()
    {

        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $posts = Post::withCount('likes')->orderby('created_at', 'desc')->get();

            $posts->each(function ($post) use ($user) {
                $post->isLiked = $user ? $post->likes()->where('user_id', $user->id)->exists() : false;
                $post->isOwner = $post->user_id === $user->id;
            });

            return response()->json([
                'status' => 'Success',
                'message' => 'Successfully!',
                'body' => $posts,
                'redirect' => route('posts.index'),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'text' => 'required|string|max:80',
            ]);

            $post = Post::findOrFail($id);
            $user = Auth::user();
            if ($post->user_id !== $user->id) {
                return response()->json(['message' => 'Forbidden: You cannot update this post'], 403);
            }

            $post->update($validated);
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully!',
                'body' => $post,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
            ], 400);
        }
    }

    function delete($id)
    {

        $user = Auth::user();
        $post = Post::findOrFail($id);
        if ($post->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden: You cannot delete this post'], 403);
        }

        $post->delete();
        return response()->json([
            'message' => 'Successfully!',
        ], 201);
    }
}
