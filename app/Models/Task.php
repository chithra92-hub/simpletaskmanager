<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable=[
        'title','description','image', 'is_completed','due_date'
    ];

   
}
