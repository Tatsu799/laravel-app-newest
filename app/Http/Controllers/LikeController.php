<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    // いいねする
    public function like(Post $post, Request $request)
    {
        // $user = Auth::user();
        $user = $request->user(); //api?
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // ユーザーが既にいいねしていない場合だけいいねを追加
        if (!$post->likes()->where('user_id', $user->id)->exists()) {
            $post->likes()->create(['user_id' => $user->id]);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Successfully!',
            'body' => ['true'],
            'likes_count' => $post->likes()->count(),
        ]);
    }

    public function unlike(Post $post, Request $request)
    {
        // $user = Auth::user();
        $user = $request->user(); //api?
        // いいねを削除
        $post->likes()->where('user_id', $user->id)->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Successfully!',
            'body' => ['true'],
            'likes_count' => $post->likes()->count(), ////
        ]);
    }
}
