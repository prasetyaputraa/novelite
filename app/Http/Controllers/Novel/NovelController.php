<?php

namespace App\Http\Controllers\Novel;

use App\Models\Novel;
use App\Models\Favorite;
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
        return response()->json($user);
    }

    public function getFavoriteNovels(Request $request)
    {
        $user = $request->user();

        return response()->json($user->favoriteNovels);
    }


    public function toggleFavorite(Request $request)
    {
        $modelNovel = new Novel();

        $user = $request->user();

        $novel       = $modelNovel->find($request['novel_id']);
        $isFavorited = ($novel->usersWhoFavorited->find($user->id) !== null);

        try {
            if (!$isFavorited) {
                $novel->usersWhoFavorited()->attach($user);

                return response()->json(
                    $this->successStatus
                );
            }

            if ($novel->usersWhoFavorited()->detach($user)) {
                return response()->json(
                    $this->successStatus
                );
            }

            return response()->json(
                [
                    'header'  => 500,
                    'message' => 'failed to toggle favorite/unfavorite'
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                500,
                $e->getMessage()
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
