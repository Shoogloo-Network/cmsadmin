<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Navbar extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_id', 'name', 'slug', 'title', 'type', 'description', 'tab_order', 'description',
        'metatitle', 'metakeyword', 'metadescription', 'status', 'created_at', 'updated_at',
    ];

    public static function getNestedNavbars()
    {
        $data = DB::table('navbars')
            ->join('subnavbars', 'subnavbars.navbar_id', '=', 'navbars.id')
            ->select('navbars.id as navbar_id',
                'navbars.domain_id',
                'navbars.name as navbar_name',
                'navbars.slug as navbar_slug',
                'navbars.status as navbar_status',
                'navbars.tab_order as navbar_tab_order',
                'subnavbars.id as subnavbar_id',
                'subnavbars.name as subnavbar_name',
                'subnavbars.slug as subnavbar_slug',
                'subnavbars.order',
                'subnavbars.status as subnavbar_status',
            )->where('subnavbars.child_id', '<>', 999)->where('subnavbars.domain_id', '=', $_ENV['DOMAIN_ID'])
            ->orderBy('subnavbars.navbar_id', 'asc')->orderBy('subnavbars.order', 'ASC')
            ->get();

        $result = array();
        $currentParentId = null;
        $currentParentIndex = null;

        foreach ($data as $row) {

            if ($row->navbar_id != $currentParentId) {
                $currentParentIndex = count($result);
                $result[$currentParentIndex] = array(
                    'parentid' => $row->navbar_id,
                    'domainid' => $row->domain_id,
                    'parent_name' => $row->navbar_name,
                    'parent_slug' => $row->navbar_slug,
                    'parent_status' => $row->navbar_status,
                    'parent_tab_order' => $row->navbar_tab_order,
                    'children' => array(),
                );
                $currentParentId = $row->navbar_id;
            }

            $result[$currentParentIndex]['children'][] = array(
                'child_id' => $row->subnavbar_id,
                'child_name' => $row->subnavbar_name,
                'child_slug' => $row->subnavbar_slug,
                'child_status' => $row->subnavbar_status,
            );
        }

        return $result;
    }

    /**
     *
     */
    public static function getPopularData($pid, $spid)
    {
        $popularData = DB::table('populars as pop')
            ->select([
                'pop.page_id',
                'pop.subpage_id',
                'pop.trainroute_id',
                'pop.operator_id',
                'tr.name as route_name',
                'tr.slug as route_slug',
                'tr.banner as route_banner',
                'tr.short_desc as route_short_desc',
                'opr.name as operator_name',
                'opr.slug as operator_slug',
                'opr.logo as operator_logo',
                'opr.short_desc as operator_short_desc',
            ])
            ->join('navbars as sn', 'sn.id', '=', 'pop.page_id')
            ->join('trainroutes as tr', 'tr.id', '=', 'pop.trainroute_id')
            ->join('operators as opr', 'opr.id', '=', 'pop.operator_id')
            ->where(['page_id' => $pid, 'subpage_id' => $spid, 'route_status' => 'Yes'])
            ->get();

        return $popularData;
    }
}
