<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowing';
    protected $primaryKey = 'id';

    /**
     * List of allowed column to insert / update 
     * @var array
     */
    protected $fillable = [
        'member_id',
        'book_id',
        'start_date', 
        'end_date', 
        'status', 
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
