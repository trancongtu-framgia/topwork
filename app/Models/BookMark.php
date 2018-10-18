<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookMark extends Model
{
    protected $table = 'book_marks';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'user_id',
    ];
}
