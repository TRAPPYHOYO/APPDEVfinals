<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure all actions require login
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $contacts = Contact::query()
            ->where('user_id', Auth::id()) // Filter only current user's contacts
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->get();

        return view('contacts.index', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_id' => Auth::id(), // ✅ Using Auth facade
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('success', 'Contact updated.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted.');
    }
    public function create()
    {
        return view('contacts.create');
    
    }    
    public function search(Request $request)
    {
        $search = $request->input('search');
        $contacts = Contact::where('user_id', Auth::id())
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
            })
            ->get();

        return view('contacts.index', compact('contacts'));
    }
    public function filter(Request $request)
    {
        $filter = $request->input('filter');
        $contacts = Contact::where('user_id', Auth::id())
            ->where('status', $filter)
            ->get();

        return view('contacts.index', compact('contacts'));
    }
    public function sort(Request $request)
    {
        $sort = $request->input('sort');
        $contacts = Contact::where('user_id', Auth::id())
            ->orderBy($sort, 'asc')
            ->get();

        return view('contacts.index', compact('contacts'));
    }
    public function paginate(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $contacts = Contact::where('user_id', Auth::id())
            ->paginate($perPage);

        return view('contacts.index', compact('contacts'));
    }
    public function export(Request $request)
    {
        $contacts = Contact::where('user_id', Auth::id())->get();
        $csvFileName = 'contacts_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Name', 'Email', 'Phone']);

        foreach ($contacts as $contact) {
            fputcsv($handle, [$contact->name, $contact->email, $contact->phone]);
        }

        fclose($handle);

        return response()->stream(function () use ($handle) {
            fclose($handle);
        }, 200, $headers);
    }
}
