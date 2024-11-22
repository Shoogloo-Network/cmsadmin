<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RailcardNavbar extends Model
{
    use HasFactory;
    protected $fillable = [
        'domain_id',
        'railcard_id',
        'page_id',
    ];
}
