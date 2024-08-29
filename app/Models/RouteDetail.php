<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'routedetails';
    protected $fillable = [
        'route_id',
        'domain_id',        
        'banner',
        'logo',
        'header',
        'description',
        'metatitle',
        'metakeyword',
        'metadescription',
        'status',
        'shortdesc',
        'merchant_link',
    ];

}
