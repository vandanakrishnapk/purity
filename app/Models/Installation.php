<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installation extends Model
{
    use HasFactory; 
    protected $guarded = [];
    protected $primaryKey ='installId';
   
    protected $casts = [
        'sow' => 'array', // Automatically casts JSON to array when accessed
    ];
}
