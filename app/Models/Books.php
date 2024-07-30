<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'id';

    /**
     * List of allowed column to insert / update 
     * @var array
     */
    protected $fillable = [
        'code', 
        'title', 
        'author', 
        'stock', 
        'created_at', 
        'updated_at',
    ];

    protected $hidden = [
        'created_at', 
        'updated_at',
    ];

    // disabled timestamps data
    public $timestamps = true;
}
