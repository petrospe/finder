<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'attribute_id',
        'parent_id',
        'display_order',
        'row_value',
        'status_id',
        'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function attribute()
    {
      return $this->belongsTo(Attribute::class);
    }

    public function status()
    {
      return $this->belongsTo(Status::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Entity::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Entity::class, 'parent_id');
    }

    public function childrenRecursive()
    {
       return $this->children()->with('childrenRecursive');
    }
}
