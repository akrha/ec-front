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
        $login_id = Auth::id();
        $items = $this->item->searchByParams($request->query(), $login_id);

        return view('item.list', [
            'items' => $items,
            'request' => $request->all()
        ]);
    }

    public function detail(int $item_id)
    {
        $login_id = Auth::id();

        $item = $this->item->getItemDetail($item_id, $login_id);

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
