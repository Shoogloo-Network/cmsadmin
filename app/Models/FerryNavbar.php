<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryNavbar extends Model
{
    use HasFactory;
    protected $table = 'feerynavbars';
    protected $fillable = [
        'domain_id',
        'ferry_id',
        'page_id',
    ];
}
