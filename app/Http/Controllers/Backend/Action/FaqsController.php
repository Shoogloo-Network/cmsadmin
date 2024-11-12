<?php

namespace App\Http\Controllers\Backend\Action;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Navbar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class FaqsController extends Controller
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
        if (is_null($this->user) || !$this->user->can('faq.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $faqs = Faq::where('status', '=', 'Yes')->orderBy('id', 'DESC')->get();

        return view('faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('faq.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $roles = Role::all();
        return view('faqs.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('faq.create')) {
            abort(403, 'Sorry !! You are Unauthorized to admin !');
        }

        // Validate the incoming request
        $request->validate([        
            'page' => 'nullable|string|max:255',
            'domain' => 'required|string|max:255',
            'title' => 'required|string|max:255',            
            'slug' => 'required|string|max:255',
            'desc' => 'nullable|string',            
            'order' => 'nullable|integer',
            'status' => 'required|string|in:Yes,No',            
            'extrafaq' => 'nullable|string', 
        ]);

        // Store the data in the database
        $faq = new Faq();        
        $faq->page_id = $request->input('page');
        $faq->domain_id = $request->input('domain');        
        $faq->title = $request->input('title');
        $faq->slug = trim($request->input('slug'));
        $faq->description = $request->input('desc');
        $faq->order = $request->input('order');
        $faq->status = $request->input('status');
        $faq->extrafaqs = $request->input('extrafaq');

        $faq->save(); // Save the faq to the database
        return redirect()->route('admin.faqs.index')->with('success', 'Faq saved successfully.');

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
        if (is_null($this->user) || !$this->user->can('faq.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $faqById = Faq::find($id);
        $pages = Navbar::all();
        return view('faqs.edit', compact('faqById', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (is_null($this->user) || !$this->user->can('faq.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to update any Faqs !');
        }

        $faq = Faq::findOrFail($id); // Find the record by ID
        $faq->page_id = $request->input('page');
        $faq->domain_id = $request->input('domain');        
        $faq->title = $request->input('title');
        $faq->slug = trim($request->input('slug'));
        $faq->description = $request->input('desc');
        $faq->order = $request->input('order');
        $faq->status = $request->input('status');
        $faq->extrafaqs = $request->input('extrafaq');
        $faq->update(); // Save the faq to the database
        return redirect()->route('admin.faqs.index')->with('success', 'Faq updated successfully');
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
