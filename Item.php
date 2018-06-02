<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['title', 'contact','description', 'status', 'complete','created_at','updated_at'];
}
