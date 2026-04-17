<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource for the homepage.
     */
    public function index()
    {
        // Eager load relationships for performance and paginate results
        $items = Item::with('category', 'images')
            ->where('status', 'Available')
            ->latest()
            ->paginate(12);

        return view('home', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'required|string',
            'location' => 'nullable|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validate each image
        ]);

        $item = Auth::user()->items()->create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('item_images', 'public');
                $item->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('seller.dashboard')->with('success', 'Item posted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        // Eager load for performance
        $item->load('user', 'category', 'images');
        return view('show', compact('item'));
    }

    /**
     * Show the seller's private dashboard with their listings.
     */
    public function dashboard()
    {
        $items = Auth::user()->items()
            ->with('category', 'images') // Eager load for efficiency
            ->latest()
            ->get();

        return view('seller.dashboard', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        // Authorization: Ensure the logged-in user owns this item
        if (Auth::id() !== $item->user_id) {
            abort(403, 'You are not authorized to edit this item.');
        }

        $categories = Category::orderBy('name')->get();
        return view('seller.items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        // Authorization: Ensure the logged-in user owns this item
        if (Auth::id() !== $item->user_id) {
            abort(403, 'You are not authorized to update this item.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'required|string',
            'location' => 'nullable|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array',
        ]);

        $item->update($validated);

        // Handle existing image deletions
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $item->images()->find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('item_images', 'public');
                $item->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('seller.dashboard')->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Authorization: Ensure the logged-in user owns this item
        if (Auth::id() !== $item->user_id) {
            abort(403, 'You are not authorized to delete this item.');
        }

        // Delete associated images from storage
        foreach ($item->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $item->delete(); // This will also delete related images from DB due to cascade

        return redirect()->route('seller.dashboard')->with('success', 'Item deleted successfully.');
    }

    /**
     * Toggle the status of the item between "Available" and "Sold".
     */
    public function toggleStatus(Item $item)
    {
        // Authorization: Ensure the logged-in user owns this item
        if (Auth::id() !== $item->user_id) {
            abort(403, 'You are not authorized to change this item\'s status.');
        }

        $item->status = ($item->status === 'Available') ? 'Sold' : 'Available';
        $item->save();

        return back()->with('success', 'Item status updated.');
    }
}