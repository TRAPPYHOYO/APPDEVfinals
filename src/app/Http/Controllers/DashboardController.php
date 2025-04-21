<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // Since the Contact model is removed, replace the logic with placeholder data or other logic
        $contacts = []; // Empty array or replace with other data if needed

        return view('dashboard', compact('contacts'));
    }
}