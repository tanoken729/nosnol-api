<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function getCommentInfo($user_id, $music_file_id)
    {
        // ユーザーのデータを取得する際にフォローテーブルをjoinさせる
        // $followCount = User::where('followed_user_id', $user->id)->get();
        $comment_info = DB::table('music_files')
                ->where('music_files.id', '=', $music_file_id)
                ->leftJoin('comments', 'comments.music_file_id', '=', 'music_files.id')
                ->leftJoin('users as commenter', 'commenter.id', '=', 'comments.user_id')
                ->select(
                    'text',
                    'comments.user_id as comments_user_id',
                    'comments.created_at as comments_created_at',
                    'commenter.name as commenter_name'
                    )
                ->get();
        return response()->json(['commentInfo' => $comment_info]);
    }

    public function comment(Request $request)
    {
        $comments = new Comment;
        $comments->text = $request->text;
        $comments->user_id = $request->user_id;
        $comments->music_file_id = $request->music_file_id;
        $comments->save();
    }
    
    public function uncomment($user_id, $music_file_id)
    {
        $follow = Comment::where('user_id', '=', $user_id)->where('music_file_id', '=', $music_file_id)->first();
        $follow->delete();
        // $followCount = count(FollowUser::where('followed_user_id', $user->id)->get());

        // return response()->json(['followCount' => $followCount]);
    }
}
