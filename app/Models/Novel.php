<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model
{
    public function usersWhoFavorited()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function adminsWhoFavorited()
    {
        return $this->belongsToMany(Admin::class, 'favorites_admins')->withTimestamps();
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function postChapter($data)
    {
        if (!$this->id) {
            return false;
        }

        $this->chapters()->insert(
            array(
                'novel_id' => $this->id,
                'title'    => $data['title'],
                'url'      => $data['url'],
            )
        );

        return true;
    }
}
