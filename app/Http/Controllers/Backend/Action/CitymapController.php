<?php

namespace App\Http\Controllers\Backend\Action;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Popular;
use App\Models\Provider;
use App\Models\Route;
use function Laravel\Prompts\select;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CitymapController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function getPopularRoutes(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('citymap.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any popular city mapping !');
        }

        // $popular = Popular::select('populars.id', 'populars.page_id', 'populars.subpage_id', 'populars.trainroute_id', 'populars.route_status', 'populars.provider_id', 'populars.provider_status', 'cities.name')
        //     ->join('cities', function ($join) {
        //         $join->on(['populars.subpage_id' => 'cities.id']);
        //     })
        //     ->where('populars.page_id', '=', '27')
        //     ->groupBy('populars.id', 'populars.page_id', 'populars.subpage_id', 'populars.trainroute_id', 'populars.route_status', 'populars.provider_id', 'populars.provider_status', 'cities.name')
        //     ->orderBy(DB::raw("populars.page_id, populars.subpage_id"), 'asc')
        //     ->get();

        $populars = DB::select("SELECT ppl.id, ppl.page_id, ppl.subpage_id, ppl.trainroute_id, ppl.route_status, ppl.provider_id,ppl.provider_status, cts.name as cityname FROM populars as ppl JOIN cities as cts on ppl.subpage_id=cts.id WHERE ppl.page_id=27 AND ppl.trainroute_id != 0 ORDER BY page_id, subpage_id ASC");

        // $buku = \DB::table('cities')
        //     ->select(['populars.*', 'cities.*'])
        //     ->leftJoin('populars', 'cities.id', '=', 'populars.subpage_id')
        //     ->get();

        // $results = DB::table('populars')
        //     ->leftJoin('cities', function ($join) {
        //         $join->on('populars.subpage_id', '=', 'cities.id');
        //     })
        //     ->select('populars.id', 'populars.page_id', 'populars.subpage_id', 'populars.trainroute_id', 'populars.route_status', 'populars.provider_id', 'populars.provider_status', 'cities.name')
        //     ->groupBy('populars.id', 'populars.page_id', 'populars.subpage_id')
        //     ->where('populars.trainroute_id', '!=', 0)
        //     ->where('populars.page_id', '=', '27')
        //     ->orderBy('populars.page_id', 'asc')
        //     ->orderBy('populars.subpage_id', 'asc')
        //     ->get();

        //$cities = City::select('id', 'name')->where('ctt', '=', '1')->orderBy('name', 'ASC')->get();

        //$populars = Popular::all();
        return view('backend.pages.cities.popularroutes', compact('populars'));
    }

    public function createPopularRoute(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('citymap.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any popular city mapping !');

        }
        $cities = City::all();
        $routes = Route::where('ctt', '=', '1')->select('id', 'name')->get();
        $operators = Provider::where(['type' => 'rail', 'status' => 'Yes'])->select('id', 'name')->get();

        return view('backend.pages.cities.createpopularroute', compact('cities', 'routes', 'operators'));
    }

    public function storePopularRoute(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'domain' => 'required|string|max:255',
            'topnavpageid' => 'required|string|max:12',
            'navsubpageid' => 'required|string|',
            'trainrouteid' => 'required|array|',
            'routestatus' => 'required|string|in:Yes,No',
            'operatorid' => 'required|array|',
            'operatorstatus' => 'required|string|in:Yes,No',
        ]);

        $mapExist = Popular::where('page_id', $request->topnavpageid)->where('subpage_id', $request->topnavpageid)->first();

        // Create New User
        $routeCount = count($request->trainrouteid);
        $operatorCount = count($request->operatorid);
        $popular = new Popular();

        if ((int) $routeCount === 4 && (int) $operatorCount === 4) {

            for ($i = 0; $i < $operatorCount; $i++) {
                dd($request->all());
                $popular->page_id = $request->topnavpageid;
                $popular->subpage_id = $request->navsubpageid;

                $popular->trainroute_id = $request->trainrouteid[$i];
                $popular->route_status = $request->routestatus;

                $popular->operator_id = $request->operatorid[$i];
                $popular->operator_status = $request->operatorstatus;

            }

        } else {
            return back()->withErrors(['message' => 'Select 4 Popular City  &  4 Popular Train each at least']);
        }

        dd($popular);
        //$popular->save();

        // if ($request->roles) {
        //     $user->assignRole($request->roles);
        // }

        return redirect()->route('admin.citymap.index')->with('success', 'Popular city mapping has been created !!');
        //return redirect()->route('admin.citymap.index');

    }

    /**
     * This function show edit form of a popular city map with a city page
     */
    public function editPopularRoute(int $id, int $pageId, int $subId)
    {
        if (is_null($this->user) || !$this->user->can('citymap.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any popular city mapping !');
        }

        //$popular = Popular::where(['id' => $id])->first();
        $assoctdRoutes = Popular::where(['page_id' => $pageId, 'subpage_id' => $subId])->get();
        $extRouteIdAry = [$assoctdRoutes[0]->subpage_id, $assoctdRoutes[1]->subpage_id, $assoctdRoutes[2]->subpage_id, $assoctdRoutes[3]->subpage_id];
        $cities = City::where('ctt', '!=', '0')->get();
        $popularSubpageId = $assoctdRoutes[0]->subpage_id;

        $routes = Route::where('ctt', '=', '1')->select('id', 'name')->get();
        $operators = Provider::where(['type' => 'rail', 'status' => 'Yes'])->select('id', 'name')->get();
        //$cityPopulars = Popular::all();
        return view('backend.pages.cities.editpopularroute', compact('cities', 'routes', 'operators', 'assoctdRoutes', 'extRouteIdAry'));
    }

    /**
     * Update popular cities map to a city page
     */
    public function updatePopularRoute(Request $request)
    {
        //
    }

    /**
     *
     */
    public function getAttractions(Request $request)
    {
        //
    }

    /**
     *
     */
    public function storeAttractions(Request $request)
    {
        //
    }

    /**
     *
     **/
    public function updateAttractions(Request $request)
    {
        //
    }

}
