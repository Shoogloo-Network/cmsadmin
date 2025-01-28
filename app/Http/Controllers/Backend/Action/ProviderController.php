<?php

namespace App\Http\Controllers\Backend\Action;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\ProviderDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        if (is_null($this->user) || !$this->user->can('provider.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $providers = Provider::all();
        return view('providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        if (is_null($this->user) || !$this->user->can('provider.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $roles  = Role::all();
        return view('providers.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // Validate the request
        $request->validate([
            'domain' => 'required|integer',
            'status' => 'required|string|in:Yes,No',
            'type' => 'required|string',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'topbanner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rightbanner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'heading' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'mtitle' => 'nullable|string|max:255',
            'mdesc' => 'nullable|string|max:255',
            'mkeyw' => 'nullable|string|max:255',
            'sdesc' => 'nullable|string|max:255',
            'desc' => 'nullable|string',
            'seating1' => 'nullable|string',
            'seating2' => 'nullable|string',
            'seating3' => 'nullable|string',
        ]);        

        DB::transaction(function () use ($request) {

            // Handle file uploads
            $logoName = null;
            $bannerName = null;
            $topbannerName = null;
            $ctt = 0;
            $stt = 0;

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

            if ($request->hasFile('topbanner')) {
                $request->validate([
                    'topbanner' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
                ]);
                $topbanner = $request->file('topbanner');  // Get the uploaded file instance
                $topbannerName = time() . '_' . $topbanner->getClientOriginalName();  // Generate a unique filename        
                // Move the file to the desired location within the public directory
                $topbanner->move(public_path('assets/images/cttimg'), $topbannerName);
            }

            $count = Provider::where('slug', trim($request->slug))->first();

            if($request->domain == 6000008){
                $ctt = 1;
            }elseif($request->domain == 6000010){    
                $stt = 1;
            }

            if($count){
                $oId = $count->id;
            }else{
                $provider = Provider::create([
                    'country_id' => 29,
                    'name' => $request->name,
                    'slug'=> $request->slug,
                    'type' => $request->type,
                    'ctt'=>$ctt,
                    'stt'=>$stt,
                ]);
                $pId = $provider->id;
            }

            ProviderDetail::create([
                'provider_id' => $pId,
                'domain_id' => $request->domain,
                'banner' => $bannerName,
                'logo' => $logoName,
                'description'=> $request->desc,
                'metatitle'=> $request->mtitle,
                'metakeyword'=> $request->mkeyw,
                'metadescription'=> $request->mdesc,
                'status'=> $request->status,        
                'topbanner_code' => $request->seating1,        
                'topbanner_image' => $topbannerName,
                'rightbanner_code' => $request->seating2,
                'search_right' => $request->seating3,
                'merchant_link'=> $request->link,
                'merchant_details' => $request->sdesc,
                'video_link' => $request->heading,
            ]);
        });

        return redirect()->route('admin.providers.index')->with('success', 'Provider created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $providers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editByDomainId(int $Id, int $domainid)
    {
        if (is_null($this->user) || !$this->user->can('provider.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $providerById = Provider::find($Id);
        $providerDetailsById = ProviderDetail::where('provider_id', $Id)->where('domain_id', $domainid)->first();
        return view('providers.edit', compact('providerById','providerDetailsById'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $provider = Provider::findOrFail($id); // Find the record by ID
        $providerDetail = ProviderDetail::where('provider_id',$provider->id)->where('domain_id', $request->domain)->firstOrFail();;

        // Handle file uploads
        $logoName = $providerDetail->logo;  // Existing logo name
        $bannerName = $providerDetail->banner;  // Existing banner name
        $topbannerName = $providerDetail->topbanner_image;
   

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

        if ($request->hasFile('topbanner')) {
            $request->validate([
                'topbanner' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
            ]);
            
            // Optional: Delete the old banner if it exists
            if ($topbannerName) {
                $oldBannerPath = public_path('assets/images/cttimg/' . $topbannerName);
                if (file_exists($oldBannerPath)) {
                    unlink($oldBannerPath);
                }
            }

            $topbanner = $request->file('topbanner');  // Get the uploaded file instance
            $topbannerName = time() . '_' . $topbanner->getClientOriginalName();  // Generate a unique filename        
            $topbanner->move(public_path('assets/images/cttimg'), $topbannerName); // Move the file to the desired location
        }

       

        // Update the database with the new file names and other data
        $provider->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'type' => $request->type,
        ]);

        $providerDetail->update([
            'banner' => $bannerName,
            'logo' => $logoName,
            'description'=> $request->desc,
            'metatitle'=> $request->mtitle,
            'metakeyword'=> $request->mkeyw,
            'metadescription'=> $request->mdesc,
            'status'=> $request->status,        
            'topbanner_code' => $request->seating1,        
            'topbanner_image' => $topbannerName,
            'rightbanner_code' => $request->seating2,
            'search_right' => $request->seating3,
            'merchant_link'=> $request->link,
            'merchant_details' => $request->sdesc,
            'video_link' => $request->heading,        
        ]);

        // Redirect or return response
        return redirect()->route('admin.providers.index')->with('success', 'Provider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $providers)
    {
        //
    }
}
