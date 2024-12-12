<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'name',
    ];

    protected function residents()
    {
        return $this->hasMany(User::class);
    }

    protected function tasks()
    {
        return $this->hasMany(Task::class)->orderBy('created_at', 'desc');
    }
}
