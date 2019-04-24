<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   protected $fillable = ['name' | 'price' | 'deadline' | 'presentation_order' ];
}
