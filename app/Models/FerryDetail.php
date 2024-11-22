<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FerryDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ferrydetails';
    protected $fillable = [
        'ferry_id',
        'domain_id',
        'herobanner',      
        'banner',
        'logo',
        'description',
        'metatitle',
        'metakeyword',
        'metadescription',
        'status',        
        'merchant_link',
        'mob_herobanner',
        'shortdesc',
    ];
}
