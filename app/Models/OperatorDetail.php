<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'operatordetails';
    protected $fillable = [
        'operator_id',
        'domain_id',    
        'ota_type',    
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
        'merchant_details',
    ];

}
