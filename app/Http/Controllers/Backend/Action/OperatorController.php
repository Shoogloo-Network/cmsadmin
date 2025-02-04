<?php
namespace App\Http\Controllers\Backend\Action;

use App\Http\Controllers\Controller;
use App\Models\Operator;
use App\Models\OperatorDetail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class OperatorController extends Controller
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
        if (is_null($this->user) || ! $this->user->can('operator.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $operators = Operator::all();
        return view('operators.index', compact('operators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || ! $this->user->can('operator.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $roles = Role::all();
        return view('operators.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);
        // Validate the request
        $request->validate([
            'domain'      => 'required|integer',
            'status'      => 'required|string|in:Yes,No',
            'type'        => 'required|string',
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'topbanner'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rightbanner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'heading'     => 'nullable|string|max:255',
            'link'        => 'nullable|url',
            'mtitle'      => 'nullable|string|max:255',
            'mdesc'       => 'nullable|string|max:255',
            'mkeyw'       => 'nullable|string|max:255',
            'sdesc'       => 'nullable|string|max:255',
            'desc'        => 'nullable|string',
            'seating1'    => 'nullable|string',
            'seating2'    => 'nullable|string',
            'seating3'    => 'nullable|string',
            'customhtml'  => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {

            // Handle file uploads
            $logoName        = null;
            $bannerName      = null;
            $topbannerName   = null;
            $rightbannerName = null;
            $ctt             = 0;
            $stt             = 0;

            if ($request->hasFile('logo')) {
                $request->validate([
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
                ]);
                $logo     = $request->file('logo');                        // Get the uploaded file instance
                $logoName = time() . '_' . $logo->getClientOriginalName(); // Generate a unique filename
                                                                           // Move the file to the desired location within the public directory
                $logo->move(public_path('assets/images/cttimg'), $logoName);
            }

            if ($request->hasFile('banner')) {
                $request->validate([
                    'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
                ]);
                $banner     = $request->file('banner');                        // Get the uploaded file instance
                $bannerName = time() . '_' . $banner->getClientOriginalName(); // Generate a unique filename
                                                                               // Move the file to the desired location within the public directory
                $banner->move(public_path('assets/images/cttimg'), $bannerName);
            }

            if ($request->hasFile('topbanner')) {
                $request->validate([
                    'topbanner' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
                ]);
                $topbanner     = $request->file('topbanner');                        // Get the uploaded file instance
                $topbannerName = time() . '_' . $topbanner->getClientOriginalName(); // Generate a unique filename
                                                                                     // Move the file to the desired location within the public directory
                $topbanner->move(public_path('assets/images/cttimg'), $topbannerName);
            }

            if ($request->hasFile('rightbanner')) {
                $request->validate([
                    'rightbanner' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
                ]);
                $rightbanner     = $request->file('rightbanner');                        // Get the uploaded file instance
                $rightbannerName = time() . '_' . $rightbanner->getClientOriginalName(); // Generate a unique filename
                                                                                         // Move the file to the desired location within the public directory
                $rightbanner->move(public_path('assets/images/cttimg'), $rightbannerName);
            }

            $count = Operator::where('slug', trim($request->slug))->first();

            if ($request->domain == 6000008) {
                $ctt = 1;
            } elseif ($request->domain == 6000010) {
                $stt = 1;
            }

            if ($count) {
                $oId = $count->id;
            } else {
                $operator = Operator::create([
                    'country_id' => 29,
                    'name'       => $request->name,
                    'slug'       => $request->slug,
                    'ctt'        => $ctt,
                    'stt'        => $stt,
                ]);
                $oId = $operator->id;
            }
           
            OperatorDetail::create([
                'operator_id'       => $oId,
                'domain_id'         => $request->domain,
                'ota_type'          => $request->type,
                'banner'            => $bannerName,
                'logo'              => $logoName,
                'description'       => $request->desc,
                'metatitle'         => $request->mtitle,
                'metakeyword'       => $request->mkeyw,
                'metadescription'   => $request->mdesc,
                'status'            => $request->status,
                'topbanner_image'   => $topbannerName,
                'rightbanner_image' => $rightbannerName,
                'shortdesc'         => $request->sdesc,
                'rightbanner_code'  => $request->seating2,
                'search_right'      => $request->seating3,
                'merchant_link'     => $request->link,
                'merchant_details'  => $request->seating1,
                'customhtml'        => $request->customhtml,
            ]);
        });

        return redirect()->route('admin.operators.index')->with('success', 'Operator created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Operator $operators)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function editByDomainId(int $operator, int $domainid)
    {
        if (is_null($this->user) || ! $this->user->can('operator.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $operatorById        = Operator::find($operator);
        $operatorDetailsById = OperatorDetail::where('operator_id', $operator)->where('domain_id', $domainid)->first();
        return view('operators.edit', compact('operatorById', 'operatorDetailsById'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $operator       = Operator::findOrFail($id); // Find the record by ID
        $operatorDetail = OperatorDetail::where('operator_id', $operator->id)->where('domain_id', $request->domain)->firstOrFail();

                                                    // Handle file uploads
        $logoName        = $operatorDetail->logo;   // Existing logo name
        $bannerName      = $operatorDetail->banner; // Existing banner name
        $topbannerName   = $operatorDetail->topbanner_image;
        $rightbannerName = $operatorDetail->rightbanner_image;

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

            $logo     = $request->file('logo');                          // Get the uploaded file instance
            $logoName = time() . '_' . $logo->getClientOriginalName();   // Generate a unique filename
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

            $banner     = $request->file('banner');                          // Get the uploaded file instance
            $bannerName = time() . '_' . $banner->getClientOriginalName();   // Generate a unique filename
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

            $topbanner     = $request->file('topbanner');                          // Get the uploaded file instance
            $topbannerName = time() . '_' . $topbanner->getClientOriginalName();   // Generate a unique filename
            $topbanner->move(public_path('assets/images/cttimg'), $topbannerName); // Move the file to the desired location
        }

        if ($request->hasFile('rightbanner')) {
            $request->validate([
                'rightbanner' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
            ]);

            // Optional: Delete the old banner if it exists
            if ($rightbannerName) {
                $oldBannerPath = public_path('assets/images/cttimg/' . $rightbannerName);
                if (file_exists($oldBannerPath)) {
                    unlink($oldBannerPath);
                }
            }

            $rightbanner     = $request->file('rightbanner');                          // Get the uploaded file instance
            $rightbannerName = time() . '_' . $rightbanner->getClientOriginalName();   // Generate a unique filename
            $rightbanner->move(public_path('assets/images/cttimg'), $rightbannerName); // Move the file to the desired location
        }

        // Update the database with the new file names and other data
        $operator->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
        ]);
        
        $operatorDetail->update([
            'ota_type'          => $request->type,
            'banner'            => $bannerName,
            'logo'              => $logoName,
            'description'       => $request->desc,
            'metatitle'         => $request->mtitle,
            'metakeyword'       => $request->mkeyw,
            'metadescription'   => $request->mdesc,
            'status'            => $request->status, 
            'topbanner_image'   => $topbannerName,
            'rightbanner_image' => $rightbannerName,
            'shortdesc'         => $request->sdesc,
            'rightbanner_code'  => $request->seating2,
            'search_right'      => $request->seating3,
            'merchant_link'     => $request->link,
            'merchant_details'  => $request->seating1,
            'customhtml'        => $request->customhtml,
        ]);

        // Redirect or return response
        return redirect()->route('admin.operators.index')->with('success', 'Operator updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Operator $operators)
    {
        //
    }
}
