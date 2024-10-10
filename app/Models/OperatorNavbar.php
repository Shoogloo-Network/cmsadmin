<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorNavbar extends Model
{

    use HasFactory;
    protected $fillable = [
        'domain_id',
        'operator_id',
        'page_id',
    ];
}
