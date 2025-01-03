<?php

namespace App\Http\Controllers\Backend\Action;

use App\Http\Controllers\Controller;
use App\Models\Ferries;
use App\Models\FerryDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class FerryController extends Controller
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
        if (is_null($this->user) || !$this->user->can('ferry.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $ferries = Ferries::all();
        return view('ferries.index', compact('ferries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {        
        if (is_null($this->user) || !$this->user->can('ferry.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $roles  = Role::all();
        return view('ferries.create', compact('roles'));
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
            'topbanner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'topmbanner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            $topbannerName = null;
            $topmbannerName = null;
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

            if ($request->hasFile('topmbanner')) {
                $request->validate([
                    'topmbanner' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
                ]);
                $topmbanner = $request->file('topmbanner');  // Get the uploaded file instance
                $topmbannerName = time() . '_' . $topmbanner->getClientOriginalName();  // Generate a unique filename        
                // Move the file to the desired location within the public directory
                $topmbanner->move(public_path('assets/images/cttimg'), $topmbannerName);
            }

            $count = Ferries::where('slug', trim($request->slug))->first();

            if($request->domain == 6000008){
                $ctt = 1;
            }elseif($request->domain == 6000010){    
                $stt = 1;
            }

            if($count){
                $oId = $count->id;
            }else{
                $ferry = Ferries::create([
                    'country_id' => 29,
                    'name' => $request->name,
                    'slug'=> $request->slug,
                    'popularorder'=>$request->order,
                    'ctt'=>$ctt,
                    'stt'=>$stt,
                ]);
                $pId = $ferry->id;
            }

            FerryDetail::create([
                'ferry_id' => $pId,
                'domain_id' => $request->domain,
                'herobanner' => $topbannerName,
                'banner' => $bannerName,
                'logo' => $logoName,
                'description'=> $request->desc,
                'metatitle'=> $request->mtitle,
                'metakeyword'=> $request->mkeyw,
                'metadescription'=> $request->mdesc,
                'status'=> $request->status,      
                'merchant_link'=> $request->link,
                'mob_herobanner' => $topmbannerName,
                'shortdesc' => $request->sdesc,
            ]);
        });

        return redirect()->route('admin.ferries.index')->with('success', 'Ferries created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ferries $ferries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $Id)
    {
        if (is_null($this->user) || !$this->user->can('ferry.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $ferryById = Ferries::find($Id);
        $ferryDetailsById = FerryDetail::where('ferry_id', $Id)->first();
        return view('ferries.edit', compact('ferryById','ferryDetailsById'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ferry = Ferries::findOrFail($id); // Find the record by ID
        $ferryDetail = FerryDetail::where('ferry_id',$ferry->id)->firstOrFail();;

        // Handle file uploads
        $logoName = $ferryDetail->logo;  // Existing logo name
        $bannerName = $ferryDetail->banner;  // Existing banner name
        $topbannerName = $ferryDetail->herobanner;
        $topmbannerName = $ferryDetail->mob_herobanner;

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

        if ($request->hasFile('topmbanner')) {
            $request->validate([
                'topmbanner' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
            ]);
            
            // Optional: Delete the old banner if it exists
            if ($topmbannerName) {
                $oldBannerPath = public_path('assets/images/cttimg/' . $topmbannerName);
                if (file_exists($oldBannerPath)) {
                    unlink($oldBannerPath);
                }
            }

            $topmbanner = $request->file('topmbanner');  // Get the uploaded file instance
            $topmbannerName = time() . '_' . $topmbanner->getClientOriginalName();  // Generate a unique filename        
            $topmbanner->move(public_path('assets/images/cttimg'), $topmbannerName); // Move the file to the desired location
        }
       

        // Update the database with the new file names and other data
        $ferry->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'popularorder'=>$request->order,
            
        ]);

        $ferryDetail->update([
            'ferry_id'=>$id,
            'domain_id' => $request->domain,
            'herobanner' => $topbannerName,
            'banner' => $bannerName,
            'logo' => $logoName,
            'description'=> $request->desc,
            'metatitle'=> $request->mtitle,
            'metakeyword'=> $request->mkeyw,
            'metadescription'=> $request->mdesc,
            'status'=> $request->status,      
            'merchant_link'=> $request->link,
            'mob_herobanner' => $topmbannerName,
            'shortdesc' => $request->sdesc,     
        ]);

        // Redirect or return response
        return redirect()->route('admin.ferries.index')->with('success', 'Ferry updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ferries $ferries)
    {
        //
    }
}
