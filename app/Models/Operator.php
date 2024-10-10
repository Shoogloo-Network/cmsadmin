<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'country_id',
        'name',
        'slug',        
        'popularorder',
        'banner',
        'logo',
        'description',
        'metatitle',
        'metakeyword',
        'metadescription',
        'status',
        'image',
        'topbanner_code',
    ];
}