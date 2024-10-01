<?php

namespace App\Http\Controllers\Backend\Action;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Models\Navbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class DealsController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('deal.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $deals = Deal::all();
        return view('deals.index', compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('deal.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $roles  = Role::all();
        return view('deals.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'domain' => 'required|string|max:255',
            'page' => 'nullable|string|max:255',
            'status' => 'required|string|in:Yes,No',
            'slug' => 'required|string|max:255',
            'discount' => 'required|string',
            'expiry' => 'required|date',
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'link' => 'nullable|string',
        ]);

        // Store the data in the database
        $deal = new Deal();
        $deal->domain_id = $request->input('domain');
        $deal->page_id = $request->input('page');
        $deal->status = $request->input('status');
        $deal->slug = trim($request->input('slug'));
        $deal->discount = $request->input('discount');
        $deal->discount_type = 'deal';
        $deal->discount_teg = 'get deal';
        $deal->expiry = $request->input('expiry');
        $deal->title = $request->input('title');
        $deal->description = $request->input('desc');
        $deal->dealurl = $request->input('link');

        $deal->save(); // Save the deal to the database
        return redirect()->route('admin.deals.index')->with('success', 'Deal saved successfully.');

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
        if (is_null($this->user) || !$this->user->can('deal.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $dealById = Deal::find($id);
        $pages = Navbar::all();
        return view('deals.edit', compact('dealById','pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $deal = Deal::findOrFail($id); // Find the record by ID
        $deal->domain_id = $request->input('domain');
        $deal->page_id = $request->input('page');
        $deal->status = $request->input('status');
        $deal->slug = trim($request->input('slug'));
        $deal->discount = $request->input('discount');
        $deal->discount_type = 'deal';
        $deal->discount_tag = 'get deal';
        $deal->expiry = $request->input('expiry');
        $deal->title = $request->input('title');
        $deal->description = $request->input('desc');
        $deal->dealurl = $request->input('link');
        $deal->update(); // Save the deal to the database
        return redirect()->route('admin.deals.index')->with('success', 'Deal updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getPagesbyId($id)
    {
        $options = Navbar::where('domain_id', $id)->pluck('name', 'id'); // Fetch data based on the selected value
        return response()->json($options);
    }
}
