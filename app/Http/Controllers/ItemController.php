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
}