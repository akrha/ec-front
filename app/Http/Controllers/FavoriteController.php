<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Favorite;

class FavoriteController extends Controller
{
    public function __construct(
        Favorite $favorite
    ) {
        $this->middleware('auth');
        $this->favorite = $favorite;
    }

    public function list()
    {
        $favorite_items = $this->favorite->getFavoriteList(Auth::id());
        return view('favorite.list', [
            'items' => $favorite_items
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'item_id' => 'integer'
        ]);

        try {
            $this->favorite->createFavorite(Auth::id(), $request->item_id);
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
        return back();
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'item_id' => 'integer'
        ]);

        try {
            $this->favorite->deleteFavorite(Auth::id(), $request->item_id);
        } catch (\Throwable $th) {
            \Log::debug('Failed to delete:' . $th->getMessage());
        }
        return back();
    }
}
