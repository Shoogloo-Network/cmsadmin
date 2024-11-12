<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Attraction extends Model
{
    use HasFactory;
    use Notifiable, HasRoles;

    protected $guard_name = 'admin';
    protected $table = 'attractions';

    protected $fillable = [
        'city_id',
        'country_id',
        'ota_id',
        'domain_id',
        'banner',
        'title',
        'description',
        'created_at',
        'modified_at',
    ];

}
