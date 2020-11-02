<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Tag extends Model
{
    protected $table = 'tags';

    public static function getTags() :?Collection
    {
        $tags = new Tag();
        return $tags->get();
    }
}
