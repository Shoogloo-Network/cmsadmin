<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteNavbar extends Model
{

    use HasFactory;
    protected $table = 'route_navbars';
    protected $fillable = [
        'domain_id',
        'trainroute_id',
        'page_id',
    ];
}
