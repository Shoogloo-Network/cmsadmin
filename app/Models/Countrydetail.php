<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countrydetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'countriesdetails';
    protected $fillable = [
        'country_id', 'domain_id', 'banner', 'smallbanner', 'header', 'merchant_link', 'description', 'metatitle', 'metakeyword', 'metadescription', 'status', 'shortdesc', 'rightbanner_code', 'train_companies_id', 'attractions_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
