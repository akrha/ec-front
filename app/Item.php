<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Item extends Model
{
    protected $table = 'items';

    public function searchByParams(
        ?array $query,
        ?int $login_id // お気に入り情報取得用
    ) :?LengthAwarePaginator {
        $items = new Item();

        $q = !empty($query['q']) ? $query['q'] : null;
        if (!empty($query['sort'])) {
            switch ($query['sort']) {
                case 'updatedAtAsc':
                    $orderBy = 'items.updated_at';
                    $sort = 'asc';
                    break;
                case 'updatedAtDesc':
                    $orderBy = 'items.updated_at';
                    $sort = 'desc';
                    break;
                case 'priceAsc':
                    $orderBy = 'items.price';
                    $sort = 'asc';
                    break;
                case 'priceDesc':
                    $orderBy = 'items.price';
                    $sort = 'desc';
                    break;
                default:
                    $orderBy = 'items.updated_at';
                    $sort = 'asc';
                    break;
            }
        } else {
            $orderBy = 'items.updated_at';
            $sort = 'asc';
        }
        $tag_id = !empty($query['tag_id']) ? $query['tag_id'] : null;

        return $items
            ->select('items.*')
            ->distinct()
            ->leftJoin('item_tags', 'item_tags.item_id', '=', 'items.id')
            ->leftJoin('tags', 'tags.id', '=', 'item_tags.tag_id')
            ->when($q, function ($items, $q) {
                return $items->where('item_name', 'like', "%" . $q . "%");
            })
            ->when($tag_id, function ($items, $tag_id) {
                return $items
                    ->where('item_tags.tag_id', '=', $tag_id);
            })
            ->when($login_id, function($items, $login_id) {
                return $items
                    ->addSelect('favorites.id AS favorite_id')
                    ->leftJoin('favorites', 'favorites.item_id', '=', 'items.id');
            })
            ->orderBy($orderBy, $sort)
            ->paginate(5);
    }

    public function getItemDetail(int $item_id) :?Item
    {
        $result = Item::select(
            'items.*'
        )
        ->where('items.id', $item_id)
        ->first();

        return $result;
    }
}
