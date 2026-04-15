<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category; // Import Category to show the filter list
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // 1. Start a query for Available items
        $query = Item::query()->where('status', 'Available');

        // 2. If a user clicked a category (e.g., ?category=1), filter the results
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // 3. Get the items, latest first
        $items = $query->latest()->get();

        // 4. Also get all categories so we can show the filter buttons in the view
        $categories = Category::all();

        return view('welcome', compact('items', 'categories'));
    }

    public function show(Item $item)
    {
        $item->load(['category', 'user', 'images']);
        return view('items.show', compact('item'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'condition' => 'required|in:New,Used',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $item = Item::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'condition' => $request->condition,
            'status' => 'Available',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('items', 'public');
                $item->images()->create(['image_path' => $path]);
            }
        }
        

        return redirect()->route('home')->with('success', 'Item posted successfully!');
    }
        // Seller Dashboard - View all my listings
    public function dashboard()
    {
        $items = Item::where('user_id', auth()->id())
                     ->latest()
                     ->paginate(10);
        
        return view('seller.my-listings', compact('items'));
    }

    // Show Edit Form
    public function edit(Item $item)
    {
        if ($item->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    // Update the item
    public function update(Request $request, Item $item)
    {
        if ($item->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'condition' => 'required|in:New,Used',
        ]);
        
        $item->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'condition' => $request->condition,
        ]);
        
        return redirect()->route('seller.dashboard')->with('success', 'Item updated successfully!');
    }

    // Delete the item
    public function destroy(Item $item)
    {
        if ($item->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        foreach ($item->images as $image) {
            \Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        
        $item->delete();
        
        return redirect()->route('seller.dashboard')->with('success', 'Item deleted successfully!');
    }

    // Toggle between Available and Sold
    public function toggleStatus(Item $item)
    {
        if ($item->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $item->status = $item->status === 'Available' ? 'Sold' : 'Available';
        $item->save();
        
        return back()->with('success', 'Item status updated to ' . $item->status);
    }
} 
