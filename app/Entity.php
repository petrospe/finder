<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $fillable = [
        'attribute_id',
        'parent_id',
        'display_order',
        'row_value',
        'status_id'
    ];
}
