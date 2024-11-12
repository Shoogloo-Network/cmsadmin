<?php

namespace App\Models;

use App\Models\Countrydetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Country extends Model
{

    use HasFactory;
    use Notifiable, HasRoles;

    protected $guard_name = 'admin';
    public $timestamps = false;
    protected $table = 'countries';

    protected $fillable = [
        'name', 'shortcode', 'popularorder', 'slug', 'status',
    ];

    public function countryDetail()
    {
        return $this->hasMany(Countrydetail::class);
    }

}
