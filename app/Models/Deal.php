<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'deals';
    protected $guard_name = 'admin';
    protected $fillable = [
        'title',
        'discount',
        'discount_type',
        'description',
        'discount_tag',
        'image',
        'dealurl',
        'status',
        'expiry',
        'created_at',
    ];
}
