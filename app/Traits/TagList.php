<?php

namespace App\Traits;

use App\Models\Tag;

trait TagList
{
    public function getTagListsProperty()
    {
        return Tag::oldest('name')->pluck('name', 'id');
    }
}
