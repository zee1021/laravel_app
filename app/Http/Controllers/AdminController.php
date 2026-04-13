<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        // $items = Item::latest()->get(); // You will uncomment this when Member 2 builds the Items!

        return view('admin.dashboard', compact('users'));
    }
}
