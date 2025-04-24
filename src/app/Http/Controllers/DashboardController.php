<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $contacts = Contact::where('user_id', Auth::id())->get();

        return view('dashboard', compact('contacts'));
    }
}
=======

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // Since the Contact model is removed, replace the logic with placeholder data or other logic
        $contacts = []; // Empty array or replace with other data if needed

        return view('dashboard', compact('contacts'));
    }
}
>>>>>>> 5636c5d13ba2b4d9ccada4d832aebbe4053e63f7
