<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    //
    public function users()
    {
        return $this->belongsToMany(User::class, 'novel_user')->withTimestamps();
    }
}
