<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function show(){
        return News::get();
    }

    public function showByAuthorId($id){
        $newsAuthor = News::where("author_id", $id)->get();
        return $newsAuthor;
    }

    public function showByCategoryId(Request $request, $id){
        $newsCategory = News::where("category_id", $request->category_id)->get();
        return $newsCategory;
    }

    public function post(Request $request){
        $news = new News();

        $news->User()->user_id = $request->user_id;
        $news->News()->news_id = $request->news_id;
        $news->save();

        return $news;
    }

    public function delete(Request $request, $id){
        $news = News::find($id);
        $news->delete();
        return "Deleted";
    }
}
