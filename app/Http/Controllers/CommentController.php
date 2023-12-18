<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller

{
    public function show(){
        return Comment::get();
    }

    public function showByUserId(Request $request, $id){
        $userComment = Comment::where("user_id", $request->user_id)->get();
        return $userComment;
    }

    public function showByNewsId(Request $request, $id){
        $newsComments = Comment::where("news_id", $request->news_id)->get();
        return $newsComments;
    }

    public function post (Request $request){
        $comment = new Comment();

        $comment->User()->user_id = $request->user_id;
        $comment->News()->news_id = $request->news_id;
        $comment->text =  $request->comment;
        $comment->save();
        return $comment;
    }

    public function delete(Request $request, $id){
        $comment = Comment::find($id);
        $comment->delete();
        return "Deleted";
    }
}