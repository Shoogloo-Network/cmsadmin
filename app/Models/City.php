<?php

namespace App\Models;

use App\Models\Citydetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class City extends Model
{

    use HasFactory;
    use Notifiable, HasRoles;

    protected $guard_name = 'admin';
    public $timestamps = false;
    protected $table = 'cities';

    protected $fillable = [
        'country_id', 'name', 'popularorder', 'slug', 'ctt', 'stt', 'plt', 'split', 'status',
    ];

    public function cityDetail()
    {
        return $this->hasMany(Citydetail::class);
    }

}
