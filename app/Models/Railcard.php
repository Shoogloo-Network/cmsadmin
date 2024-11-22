<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Railcard extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'country_id',
        'name',
        'slug',        
        'popularorder', 
        'status',
    ];
}
