<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use RecordsActivity;

    protected  $fillable = ['path'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
