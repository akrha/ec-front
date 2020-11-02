<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TopController extends Controller
{
    public function __construct(
        Tag $tag
    ) {
        $this->tag = $tag;
    }

    public function top()
    {
        return view('top', [
            'tags' => $this->tag->getTags()
        ]);
    }
}
