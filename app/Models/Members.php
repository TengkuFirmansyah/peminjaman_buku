<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;
    
    protected $table = 'members';
    protected $primaryKey = 'id';

    /**
     * List of allowed column to insert / update 
     * @var array
     */
    protected $fillable = [
        'code', 
        'nama', 
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