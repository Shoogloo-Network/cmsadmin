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

        $cityPopulars = Popular::all();
        return view('backend.pages.cities.popularroutes', compact('cityPopulars'));
    }

    public function createPopularRoute(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('citymap.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any popular city mapping !');

        }
        $cities = City::all();
        $routes = Route::where('ctt', '=', '1')->select('id', 'name')->get();
        $operators = Provider::where(['type' => 'rail', 'status' => 'Yes'])->select('id', 'name')->get();
        //$cityPopulars = Popular::all();
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
     * This function show edit window of a popular city map with a city page
     */
    public function editPopularRoute(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('citymap.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any popular city mapping !');
        }

        $cityPopulars = Popular::all();
        return view('backend.pages.cities.editpopularroute', compact('cityPopulars'));
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
