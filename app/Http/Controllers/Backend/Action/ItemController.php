<?php

namespace App\Http\Controllers\Backend\Action;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('item.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $items = Item::all();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (is_null($this->user) || !$this->user->can('item.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $roles  = Role::all();
        return view('items.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
    $validatedData = $request->validate([
        'product_id' => 'required|integer',
        'subcategory_id' => 'required|integer',
        'admin_id' => 'required|integer',
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:items',
        'short_description' => 'nullable|string|max:2000',
        'description' => 'nullable|string|max:2000',
        'howto' => 'nullable|string|max:2000',
        'gems_origin' => 'nullable|string|max:2000',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:256',
        'video_url' => 'nullable|url',
        'price' => 'required|numeric|min:0',
        'usd_price' => 'nullable|numeric|min:0',
        'slicer_price' => 'nullable|numeric|min:0',
        'b2b_price' => 'nullable|numeric|min:0',
        'discount' => 'required|numeric|min:0',
        'cgst' => 'nullable|numeric|min:0',
        'sgst' => 'nullable|numeric|min:0',
        'top_sale' => 'nullable|integer',
        'publish' => 'required|integer|in:0,1,2',
        'is_homepage' => 'nullable|string|max:20',
        'viewcount' => 'nullable|integer',
        'salecount' => 'nullable|integer',
        'shipping' => 'required|numeric|min:0',
        'meta_title' => 'nullable|string|max:255',
        'meta_key' => 'nullable|string|max:512',
        'meta_description' => 'nullable|string|max:512',
    ]);

    $imageName = null;

    if ($request->hasFile('image')) {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
        ]);
        $image = $request->file('image');  // Get the uploaded file instance
        $imageName = time() . '_' . $image->getClientOriginalName();  // Generate a unique filename        
        // Move the file to the desired location within the public directory
        $image->move(public_path('assets/images/astroimg'), $imageName);
    }

    // Create a new item
    Item::create($validatedData);

    return redirect()->route('admin.items.index')->with('success', 'Item created successfully.');
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
        if (is_null($this->user) || !$this->user->can('item.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any admin !');
        }

        $itemById = Item::find($id);
        return view('items.edit', compact('itemById'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the item by ID
        $item = Item::findOrFail($id);

        $imageName = $item->image;  // Existing image name

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:256', // Add file validation rules
            ]);
            
            // Optional: Delete the old image if it exists
            if ($imageName) {
                $oldImagePath = public_path('assets/images/astroimg/' . $imageName);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $image = $request->file('image');  // Get the uploaded file instance
            $imageName = time() . '_' . $image->getClientOriginalName();  // Generate a unique filename        
            $image->move(public_path('assets/images/cttimg'), $imageName); // Move the file to the desired location
        }
        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_id' => 'nullable|integer',
            'subcategory_id' => 'nullable|integer',
            'admin_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:items,slug,' . $id,
            'short_description' => 'nullable|string|max:2000',
            'description' => 'nullable|string|max:2000',
            'howto' => 'nullable|string|max:2000',
            'gems_origin' => 'nullable|string|max:2000',
            'video_url' => 'nullable|url',
            'price' => 'required|numeric|min:0',
            'usd_price' => 'nullable|numeric|min:0',
            'slicer_price' => 'nullable|numeric|min:0',
            'b2b_price' => 'nullable|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'cgst' => 'nullable|numeric|min:0',
            'sgst' => 'nullable|numeric|min:0',
            'top_sale' => 'nullable|integer',
            'publish' => 'required|integer|in:0,1,2',
            'is_homepage' => 'nullable|string|max:20',
            'meta_title' => 'nullable|string|max:255',
            'meta_key' => 'nullable|string|max:512',
            'meta_description' => 'nullable|string|max:2000',
        ]);

        // Update the item with new data
        $item->update($validatedData);

        return redirect()->route('admin.items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
