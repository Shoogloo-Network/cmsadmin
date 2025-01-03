<?php

namespace App\Http\Controllers\Backend\Action;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Countrydetail;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class CountryController extends Controller
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
     * Display a listing of the countries.
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('country.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $countries = Country::all();
        return view('backend.pages.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('backend.pages.countries.create', compact('countries'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $countryExist = Country::where('slug', trim($request->slug))->first();
        
        $countryId = null;
        if (!$countryExist) {

            $country = new Country();
            $country = Country::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'popularorder' => $request->order,
                'shortcode' => $request->code,
                'status' => $request->status,
            ]);
            $country->save();
            $countryId = $country->id;

        } else {
            $countryId = $countryExist->id;
        }

        $countryDtl = Countrydetail::where('country_id', $countryId)->where('domain_id', $request->domain)->first();
         // Handle file uploads
        

        if (!$countryDtl) {
            try {

                $logoName = null;
                $bannerName = null;
       
                if ($request->hasFile('logo')) {
                   $request->validate([
                       'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
                   ]);
                   $logo = $request->file('logo');  // Get the uploaded file instance
                   $logoName = time() . '_' . $logo->getClientOriginalName();  // Generate a unique filename        
                   // Move the file to the desired location within the public directory
                   $logo->move(public_path('assets/images/cttimg'), $logoName);
               }
               
               if ($request->hasFile('banner')) {
                   $request->validate([
                       'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
                   ]);
                   $banner = $request->file('banner');  // Get the uploaded file instance
                   $bannerName = time() . '_' . $banner->getClientOriginalName();  // Generate a unique filename        
                   // Move the file to the desired location within the public directory
                   $banner->move(public_path('assets/images/cttimg'), $bannerName);
               }

                Countrydetail::create([
                    'country_id' => $countryId,
                    'domain_id' => 6000008,
                    'banner' => $bannerName,
                    'logo' => $logoName,
                    'header' => $request->header,
                    'merchant_link' => $request->link,
                    'description' => $request->desc,
                    'metatitle' => $request->metatitle,
                    'metakeyword' => $request->metakeyword,
                    'metadescription' => $request->metadescription,
                    'status' => $request->status,
                    'shortdesc' => $request->shortdesc,
                ]);

            } catch (ValidationException $e) {
                if ($e->getCode() === '23000') {
                    // Handle duplicate entry
                    return back()->withErrors(['message' => 'This country detail is already exist']);
                }
            }
            return redirect()->route('admin.countries.index')->with('success', 'This country detail added successfully');
            //return back()->withErrors(['message' => 'This country detail added successfully']);

        } else {
            return back()->withErrors(['message' => 'This country detail is already exist']);
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
        if (is_null($this->user) || !$this->user->can('country.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }
        $country = Country::find($id);        
        $countryDetail = $country->countryDetail()->where('domain_id', '=', 6000008)->first();
        $roles = Role::all();
        return view('backend.pages.countries.edit', compact('country',  'countryDetail', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (is_null($this->user) || !$this->user->can('country.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }
        // TODO: You can delete this in your local. This is for heroku publish.
        // This is only for Super Admin role,
        // so that no-one could delete or disable it by somehow.
        if ($id === 1) {
            session()->flash('error', 'Sorry !! You are not authorized to update this Admin as this is the Super Admin. Please create new one if you need to test !');
            return back();
        }
     

        // Validation Data
        $request->validate([
            'name' => 'nullable|string|max:255',
            'status' => 'required|string|in:Yes,No',
            'code' => 'required|string',
            'order' => 'nullable|integer',
            'slug' => 'required|string|max:255',
            'header' => 'required|string',
            'link' => 'nullable|string',
            'metatitle' => 'nullable|string',
            'metakeyword' => 'nullable|string',
            'metadescription' => 'nullable|string',
            'shortdesc' => 'required|string',
            'desc' => 'nullable|string',
        ]);

        $country = Country::find($id);
        $countryDetail = $country->countryDetail()->where('domain_id', '=', 6000008)->firstOrFail();

        $logoName = $countryDetail->logo;  // Existing logo name
        $bannerName = $countryDetail->banner;  // Existing banner name

        if ($request->hasFile('logo')) {
            
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
            ]);
            
            // Optional: Delete the old logo if it exists
            if ($logoName) {
                $oldLogoPath = public_path('assets/images/cttimg/' . $logoName);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }

            $logo = $request->file('logo');  // Get the uploaded file instance
            $logoName = time() . '_' . $logo->getClientOriginalName();  // Generate a unique filename                    
            $logo->move(public_path('assets/images/cttimg'), $logoName); // Move the file to the desired location
        }


        if ($request->hasFile('banner')) {
            $request->validate([
                'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
            ]);
            
            // Optional: Delete the old banner if it exists
            if ($bannerName) {
                $oldBannerPath = public_path('assets/images/cttimg/' . $bannerName);
                if (file_exists($oldBannerPath)) {
                    unlink($oldBannerPath);
                }
            }

            $banner = $request->file('banner');  // Get the uploaded file instance
            $bannerName = time() . '_' . $banner->getClientOriginalName();  // Generate a unique filename        
            $banner->move(public_path('assets/images/cttimg'), $bannerName); // Move the file to the desired location
        }
        
        $country->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'popularorder' => $request->order,
            'shortcode' => $request->code,
            'status' => $request->status,
        ]);
    
        $countryDetail->update([
                'country_id' => $country->id,
                'banner' => $bannerName,
                'logo' => $logoName,
                'header' => $request->header,
                'merchant_link' => $request->link,
                'description' => $request->desc,
                'metatitle' => $request->metatitle,
                'metakeyword' => $request->metakeyword,
                'metadescription' => $request->metadescription,
                'status' => $request->status,
                'shortdesc' => $request->shortdesc,      
        ]);

        return redirect()->route('admin.countries.index')->with('success', 'Country updated successfully');
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

        $countries = Country::find($id);
        if (!is_null($countries)) {
            //$countries->delete();
        }

        session()->flash('success', 'Country has been deleted !!');
        return back();
    }
}
