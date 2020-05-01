<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['name', 'type', 'path', 'size'];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function entity()
    {
      return $this->belongsTo(Entity::class);
    }
}
