<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinalty extends Model
{
    use HasFactory;

    protected $table = 'pinalty';
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
