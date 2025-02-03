<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citydetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'citiesdetails';
    protected $fillable = [
        'city_id', 'domain_id', 'banner', 'smallbanner', 'header', 'merchant_link', 'description', 'metatitle', 'metakeyword', 'metadescription', 'status', 'shortdesc', 'rightbanner_code', 'train_companies_id', 'attractions_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
