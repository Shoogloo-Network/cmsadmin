<?php

namespace App\Http\Controllers\Backend\Action;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Citydetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class CityController extends Controller
{

    public $user;
    protected $domainIds = "";
    public function __construct()
    {
        $this->domainIds = ['6000008', '6000010'];
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the cities.
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('city.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $cities = City::all();
        return view('backend.pages.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('backend.pages.cities.create', compact('cities'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
if (is_null($this->user) || !$this->user->can('city.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $request->validate([
            'domain' => 'required|string|max:255',
            'name' => 'nullable|string|max:255',
            'status' => 'required|string|in:Yes,No',
            'slug' => 'required|string|max:255',
            //'banner' => 'required|string',
            //'smallbanner' => 'required|string',
            'header' => 'required|string',
            'metatitle' => 'nullable|string',
            'metakeyword' => 'nullable|string',
            'metadescription' => 'nullable|string',
            'shortdesc' => 'required|string',
            'desc' => 'nullable|string',
            //'merchant_link'   => 'nullable|string',
            //'rightbanner_code' => 'nullable|string',
            //'train_companies_id' => 'nullable|string',
            //'attractions_id' => 'nullable|string',
        ]);

        $cityExist = City::where('slug', trim($request->slug))
            ->where(function ($q) {
                $q->where('ctt', '0')->orWhere('ctt', '1');
            })->first();

        $cityId = null;
        if (!$cityExist) {

            $city = new City();
            $city = City::create([
                'country_id' => '29',
                'name' => $request->name,
                'popularorder' => '0',
                'slug' => $request->slug,
            ]);
            $city->save();
            $cityId = $city->id;

        } else {
            $cityId = $cityExist->id;
        }

        $cityDtl = Citydetail::where('city_id', $cityId)->where('domain_id', $request->domain)->first();

        if (!$cityDtl) {
            try {
                Citydetail::create([
                    'city_id' => $cityId,
                    'domain_id' => $request->domain,
                    'banner' => $request->banner,
                    'smallbanner' => $request->smallbanner,
                    'header' => $request->header,
                    'merchant_link' => $request->merchant_link,
                    'description' => $request->desc,
                    'metatitle' => $request->metatitle,
                    'metakeyword' => $request->metakeyword,
                    'metadescription' => $request->metadescription,
                    'status' => $request->status,
                    'shortdesc' => $request->shortdesc,
                    //rightbanner_code = $request->rightbanner_code,
                    //train_companies_id = $request->train_companies_id,
                    //attractions_id = $request->attractions_id,
                ]);

            } catch (ValidationException $e) {
                if ($e->getCode() === '23000') {
                    // Handle duplicate entry
                    return back()->withErrors(['message' => 'This city detail is already exist']);
                }
            }
            return redirect()->route('admin.cities.index')->with('success', 'This city detail added successfully');
            //return back()->withErrors(['message' => 'This city detail added successfully']);

        } else {
            return back()->withErrors(['message' => 'This city detail is already exist']);
        }

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (is_null($this->user) || !$this->user->can('city.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $city = City::find($id)
                    ->with(['cityDetail' => function($query) {
            $query->where('domain_id', 6000008);
        }])->firstOrFail();
        $roles = Role::all();
        return view('backend.pages.cities.edit', compact('city', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        dd($request->all());

        // TODO: You can delete this in your local. This is for heroku publish.
        // This is only for Super Admin role,
        // so that no-one could delete or disable it by somehow.
        if ($id === 1) {
            session()->flash('error', 'Sorry !! You are not authorized to update this Admin as this is the Super Admin. Please create new one if you need to test !');
            return back();
        }

        // Create New Admin
        $city = City::find($id);

        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $city->name = $request->name;
        $city->email = $request->email;
        $city->username = $request->username;
        // if ($request->password) {
        //     $city->password = Hash::make($request->password);
        // }
        $city->save();

        $city->roles()->detach();
        if ($request->roles) {
            $city->assignRole($request->roles);
        }

        session()->flash('success', 'Admin has been updated !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (is_null($this->user) || !$this->user->can('admin.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to delete any admin !');
        }

        // TODO: You can delete this in your local. This is for heroku publish.
        // This is only for Super Admin role,
        // so that no-one could delete or disable it by somehow.
        if ($id === 1) {
            session()->flash('error', 'Sorry !! You are not authorized to delete this Admin as this is the Super Admin. Please create new one if you need to test !');
            return back();
        }

        $cities = City::find($id);
        if (!is_null($cities)) {
            //$cities->delete();
        }

        session()->flash('success', 'City has been deleted !!');
        return back();
    }
}
