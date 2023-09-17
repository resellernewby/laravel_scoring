<?php

namespace App\Traits;

use App\Models\Classroom;

trait ClassroomList
{
    public function getClassroomListsProperty()
    {
        return Classroom::oldest('name')->pluck('name', 'id');
    }
}