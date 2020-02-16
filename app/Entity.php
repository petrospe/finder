<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'attribute_id',
        'parent_id',
        'display_order',
        'row_value',
        'status_id'
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
}
