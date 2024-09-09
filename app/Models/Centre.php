<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    use HasFactory; 
    protected $guarded = [];
    protected $primaryKey = 'centre_id';
}
