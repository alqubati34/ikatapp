<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
