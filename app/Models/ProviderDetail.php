<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'providerdetails';
    protected $fillable = [
        'id',
        'provider_id',
        'domain_id',
        'popularorder',
        'banner',
        'logo',
        'description',
        'metatitle',
        'metakeyword',
        'metadescription',
        'status',
        'created_at',
        'topbanner_code',
        'rightbanner_code',
        'search_right',
        'merchant_image',
        'merchant_link',
        'merchant_details',
        'video_link',
    ];

}
