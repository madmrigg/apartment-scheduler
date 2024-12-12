<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'user_id', 'datetime', 'status', 'duration', 'description', 'apartment_id'
    ];

    protected function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function getFormattedStatusAttribute()
    {
        if(!$this->status) {
            $colour = "red";
            $status = "TODO";
        } else {
            $colour = "green";
            $status = "DONE";
        }

        return "<b style='color:{$colour}'>{$status}</b>";
    }

    protected function getDatetimeAttribute($date)
    {
        return Carbon::parse($date)->format("Y-m-d");
    }
}
