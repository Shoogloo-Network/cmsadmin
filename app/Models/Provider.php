<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Provider extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'providers';
    protected $fillable = [
            'country_id',
            'name',
            'type',
            'slug',
            'ctt',
            'stt', 
            'plt', 
            'split', 
            'popularorder', 
            'status', 
    ];

    public static function getProviderDetails($ProviderId = null, $domainId)
    {

       
    }
    
}
