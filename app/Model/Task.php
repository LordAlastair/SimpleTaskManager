<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   protected $fillable = ['name', 'price', 'deadline', 'presentation_order', 'done'];
}
