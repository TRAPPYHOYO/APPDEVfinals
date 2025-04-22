<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
