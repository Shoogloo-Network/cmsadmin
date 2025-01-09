<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Popular extends Model
{
    use HasFactory;
    use Notifiable, HasRoles;

    protected $guard_name = 'admin';
    protected $table = 'populars';
    protected $fillable = [
        'page_id',
        'subpage_id',
        'trainroute_id',
        'route_status',
        'operator_id',
        'operator_status',
        'provider_id',
        'provider_status',
    ];

/**
 * Find a popular mapping by its id (and optionally PageId).
 *
 * @return PopularDetailsById
 */
    public static function findById(int | string $id, ?int $page_id = null)
    {
        //$guardName = $guardName ?? Guard::getDefaultName(static::class);

        //$popular = static::findByParam([(new static())->getKeyName() => $id, 'guard_name' => $guardName]);

        // if (!$popular) {
        //     return new static("There is no record available");
        // }

        //return $popular;
    }

}
