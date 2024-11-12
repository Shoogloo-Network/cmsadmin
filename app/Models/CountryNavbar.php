<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryNavbar extends Model
{
    use HasFactory;
    protected $fillable = [
        'domain_id',
        'country_id',
        'page_id',
    ];
}
