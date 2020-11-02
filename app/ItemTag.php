<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class ItemTag extends Model
{
    protected $table = 'item_tags';

    public function getItemTagsByItemId($item_id) :?Collection
    {
        $item_tags = ItemTag::select(
            'tags.id',
            'tags.name'
        )
        ->leftJoin('tags', 'tags.id', '=', 'item_tags.tag_id')
        ->where('item_tags.item_id', '=', $item_id)
        ->get();

        return $item_tags;
    }

}
