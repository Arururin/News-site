<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fav;

class FavsController extends Controller
{
    public function show(){
        return Fav::get();
    }

    public function showByUserId(Request $request, $id){
        $userFav = Fav::where("user_id", $request->user_id)->get();
        return $userFav;
    }

    public function showByNewsId(Request $request, $id){
        $newsFav = Fav::where("news_id", $request->news_id)->get();
        return $newsFav;
    }

    public function post(Request $request){
        $news = new Fav();

        $news->User()->user_id = $request->user_id;
        $news->News()->news_id = $request->news_id;
        $news->save();

        return $news;
    }

    public function delete(Request $request, $id){
        $news = Fav::find($id);
        $news->delete();
        return "Deleted";
    }
}
