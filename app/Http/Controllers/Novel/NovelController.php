<?php

namespace App\Http\Controllers\Novel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NovelController extends Controller
{
    public function explore(Request $request)
    {
        if (!$user = $request->user()) {
            //TODO return default home data here
            return 'not logged in';
        }

        $userId = $user->token()->user_id;

        //TODO return home data personalised for logged user
        //ex: history, favorites
        return $userId;
    }

    public function toggleFavorite(boolean $switch, int $id)
    {
        $modelNovelFav = new Novel_Favorite();

        if ($switch && $modelNovelFav->makeFavorite($id)) {
            return response()->json(
                $this->successStatus
            );
        } elseif (!$switch && $modelNovelFav->removeFavorite($id)) {
            return response()->json(
                $this->successStatus
            );
        }
    }

    public function readChapter(int $chapterId)
    {
        $modelNovelChapter = new Novel_Chapter();
        $modelNovelHistory = new Novel_History();

        if ($file = $modelNovelChapter->getChapter($chapterId)->file()) {
            $history = $modelNovelHistory->get($novelId);

            if (!$history) {
                $modelNovelHistory->createHistory($novelId, $chapterId);
            } else {
                $histoty->updateHistory($chapterId);
            }
        }

        return $file;
    }

    /*
     * Below is code for administrator
     */

    public function createNovel(Request $request)
    {
        $modelNovel = new Novel();

        $data = [
            'title'    => $request->title,
            'synopsis' => $request->synopsis,
            'author'   => $request->author,
            'cover'    => $request->cover
        ];

        //TODO validate data

        $modelNovel->create($data);
    }

    public function updateNovel(Request $request)
    {
        $modelNovel = new Novel();

        $modelNovel->update($request);
    }

    public function deleteNovel($id)
    {
        $modelNovel = new Novel();

        $modelNovel->delete($request);
    }

    public function updateChapter($chapterId, $file)
    {
    }
}
