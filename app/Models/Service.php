<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory; 
    protected $guarded = [];
    protected $primaryKey = 'serviceId'; 
    protected $casts = [
        'parts_changed' => 'array', // Cast the 'parts_changed' attribute to an array
    ];

}
