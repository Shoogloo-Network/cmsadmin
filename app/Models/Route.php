<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Route extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'routes';
    protected $guard_name = 'admin';
    protected $fillable = [
        'country_id', 'name', 'slug', 'ctt', 'stt', 'plt', 'split', 'banner', 'logo', 'status',
    ];

    public static function getRoutes($domainId)
    {
        $data = DB::table('routes')
            ->join('routedetails as ctd', 'ctd.route_id', '=', 'routes.id')
            ->select(
                'routes.id as routeId',
                'routes.name',
                'routes.slug',
                'ctd.domain_id',
                'ctd.banner',
                'ctd.logo',
                'ctd.header',
                'ctd.description',
                'ctd.metatitle',
                'ctd.metakeyword',
                'ctd.metadescription',
                'ctd.shortdesc',
                'ctd.merchant_link',
            )->where(['domain_id' => $domainId])->whereIn('ctd.route_id', ['438', '449', '82', '446'])->where('ctd.shortdesc', '!=', '')
            ->orderBy('ctd.id', 'asc')->get();

        return $data;
    }
}
