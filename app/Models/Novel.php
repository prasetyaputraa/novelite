<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    //
    public function usersWhoFavorited()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
