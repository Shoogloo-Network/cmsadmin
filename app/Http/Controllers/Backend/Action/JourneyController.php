<?php

namespace App\Http\Controllers\Backend\Action;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\RouteDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class JourneyController extends Controller
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
        if (is_null($this->user) || !$this->user->can('deal.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $routes = Route::all();
        return view('routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        if (is_null($this->user) || !$this->user->can('route.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $roles  = Role::all();
        return view('routes.create', compact('roles'));
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'heading' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'mtitle' => 'nullable|string|max:255',
            'mdesc' => 'nullable|string|max:255',
            'mkeyw' => 'nullable|string|max:255',
            'sdesc' => 'nullable|string|max:255',
            'desc' => 'nullable|string',
        ]);        
          
        DB::transaction(function () use ($request) {

            // Handle file uploads
            $logoName = null;
            $bannerName = null;
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
            
            $count = Route::where('slug', trim($request->slug))->first();

            if($request->domain == 6000008){
                $ctt = 1;
            }elseif($request->domain == 6000010){    
                $stt = 1;
            }

            if($count){
                $rId = $count->id;
            }else{
                $route = Route::create([
                    'name' => $request->name,
                    'slug'=> $request->slug,
                    'ctt'=>$ctt,
                    'stt'=>$stt,
                ]);
                $rId = $route->id;
            }

            RouteDetail::create([
                'route_id' => $rId,
                'domain_id' => $request->domain,
                'banner' => $bannerName,
                'logo' => $logoName,
                'header'=> $request->heading,
                'description'=> $request->desc,
                'metatitle'=> $request->mtitle,
                'metakeyword'=> $request->mkeyw,
                'metadescription'=> $request->mdesc,
                'status'=> $request->status,
                'shortdesc'=> $request->sdesc,
                'merchant_link'=> $request->link,
            ]);
        });

        return redirect()->route('admin.routes.index')->with('success', 'Route created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Routes $routes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editByDomainId(int $Id, int $domainid)
    {
        if (is_null($this->user) || !$this->user->can('route.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $routeById = Route::find($Id);
        $routeDetailsById = RouteDetail::where('route_id', $Id)->where('domain_id', $domainid)->first();
        return view('routes.edit', compact('routeById','routeDetailsById'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $route = Route::findOrFail($id); // Find the record by ID
        $routeDetail = RouteDetail::where('route_id',$route->id)->where('domain_id', $request->domain)->firstOrFail();;

        // Handle file uploads
        $logoName = $routeDetail->logo;  // Existing logo name
        $bannerName = $routeDetail->banner;  // Existing banner name

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

        // Update the database with the new file names and other data
        $route->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);

        $routeDetail->update([
            'domain_id' => $request->domain,
            'banner' => $bannerName,
            'logo' => $logoName,
            'header'=> $request->heading,
            'description'=> $request->desc,
            'metatitle'=> $request->mtitle,
            'metakeyword'=> $request->mkeyw,
            'metadescription'=> $request->mdesc,
            'status'=> $request->status,
            'shortdesc'=> $request->sdesc,
            'merchant_link'=> $request->link,
        ]);

        // Redirect or return response
        return redirect()->route('admin.routes.index')->with('success', 'Route updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Routes $routes)
    {
        //
    }
}
