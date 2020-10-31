<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Item extends Model
{
    protected $table = 'items';

    public function searchByParams(?array $query) :?Collection
    {
        $items = new Item();

        $q = !empty($query['q']) ? $query['q'] : null;
        if (!empty($query['sort'])) {
            switch ($query['sort']) {
                case 'updatedAtAsc':
                    $orderBy = 'updated_at';
                    $sort = 'asc';
                    break;
                case 'updatedAtDesc':
                    $orderBy = 'updated_at';
                    $sort = 'desc';
                    break;
                case 'priceAsc':
                    $orderBy = 'price';
                    $sort = 'asc';
                    break;
                case 'priceDesc':
                    $orderBy = 'price';
                    $sort = 'desc';
                    break;
                default:
                    $orderBy = 'updated_at';
                    $sort = 'asc';
                    break;
            }
        } else {
            $orderBy = 'updated_at';
            $sort = 'asc';
        }

        return $items
        ->when($q, function ($items, $q) {
            return $items->where('item_name', 'like', "%" . $q . "%");
        })
        ->orderBy($orderBy, $sort)
        ->get();
    }
}
