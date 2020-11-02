<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Favorite extends Model
{
    protected $table = 'favorites';
    public $timestamps = false;

    public function getFavoriteList(
        int $user_id
    ) : ?Collection {
        return Favorite::select([
            'items.*',
            'favorites.id AS favorite_id'
        ])
        ->leftJoin('items', 'items.id', '=', 'favorites.item_id')
        ->where('favorites.user_id', '=', $user_id)
        ->get();
    }

    public function createFavorite(
        int $user_id,
        int $item_id
    ) : bool
    {
        $favorite = new Favorite;
        $favorite->user_id = $user_id;
        $favorite->item_id = $item_id;

        return $favorite->save();
    }

    public function deleteFavorite(
        int $user_id,
        int $item_id
    ) :int {
        return Favorite::where([
            'user_id' => $user_id,
            'item_id' => $item_id
        ])->delete();
    }

}
