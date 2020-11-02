<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;
use App\ItemTag;

class ItemController extends Controller
{
    public function __construct(
        Item $item,
        ItemTag $item_tag
    ) {
        $this->item = $item;
        $this->item_tag = $item_tag;
    }

    public function search(
        Request $request
    ) {
        $items = $this->item->searchByParams($request->query());
        
        return view('item.list', [
            'items' => $items,
            'request' => $request->all()
        ]);
    }

    public function detail(int $item_id)
    {
        $item = $this->item->getItemDetail($item_id);

        if (is_null($item)) {
            abort('404', 'Item Not found');
        }

        $tags = $this->item_tag->getItemTagsByItemId($item_id);

        return view('item.detail', [
            'item' => $item,
            'tags' => $tags
        ]);
    }
}
