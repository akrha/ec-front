<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;

class ItemController extends Controller
{
    public function __construct(
        Item $item
    ) {
        $this->item = $item;
    }

    public function search(
        Request $request
    ) {
        $items = $this->item->searchByParams($request->query());
        
        return view('item.list',[
            'items' => $items,
            'request' => $request->all()
        ]);
    }

    public function detail()
    {
    }
}
