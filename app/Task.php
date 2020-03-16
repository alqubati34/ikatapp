<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use function foo\func;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
      'completed' => 'boolean'
    ];

    protected $dates = [
        'due_date','created_at','updated_at'
    ];

    protected static $recordableEvents = ['created', 'deleted'];

    public function getDueDateAttribute($value) {
        return Carbon::parse($value)->toFormattedDateString();
    }
    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format('F d, Y H:i A');
    }
    public function getUpdatedAtAttribute($value) {
        return Carbon::parse($value)->format('F d, Y H:i A');
    }

    public function complete()
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->recordActivity('incompleted_task');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    public function status()
    {
        return $this->belongsToMany(Statuses::class);
    }

}
