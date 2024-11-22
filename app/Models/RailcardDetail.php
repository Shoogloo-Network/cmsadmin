<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RailcardDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'railcarddetails';
    protected $fillable = [
        'railcard_id',
        'domain_id',      
        'banner',
        'logo',
        'header',
        'description',
        'metatitle',
        'metakeyword',
        'metadescription',
        'status',
        'topbanner_image',
        'rightbanner_image',
        'shortdesc',
        'rightbanner_code',
        'search_right',
        'merchant_link',
        'merchant_details'
    ];
}
