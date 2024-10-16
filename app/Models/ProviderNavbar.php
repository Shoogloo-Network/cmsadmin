<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderNavbar extends Model
{
    use HasFactory;
    protected $table = 'provider_navbars';
    protected $fillable = [
        'domain_id',
        'provider_id',
        'page_id',
    ];
}
