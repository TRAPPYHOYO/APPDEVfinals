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

    /**
     * Display a listing of the contacts.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $contacts = Contact::query()
            ->where('user_id', Auth::id()) // Filter only current user's contacts
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
            })
            ->get();

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new contact.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created contact in storage.
     */
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
            'user_id' => Auth::id(), // Associate contact with the logged-in user
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified contact.
     */
    public function show(Contact $contact)
    {
        $this->authorizeContact($contact);

        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified contact.
     */
    public function edit(Contact $contact)
    {
        // Ensure the user is authorized to edit this contact
        $this->authorizeContact($contact);
    
        // Return the edit view with the contact data
        return view('contacts.edit', compact('contact'));
        $this->authorizeContact($contact);

        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified contact in storage.
     */
    public function update(Request $request, Contact $contact)
    {
         // Ensure the user is authorized to update this contact
    $this->authorizeContact($contact);

    // Validate the form input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
    ]);

    // Update the contact
    $contact->update($request->all());

    // Redirect back to the dashboard with a success message
    return redirect()->route('dashboard')->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified contact from storage.
     */
    public function destroy(Contact $contact)
    {
        $this->authorizeContact($contact);

        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    /**
     * Search for contacts based on a query.
     */
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

    /**
     * Paginate contacts.
     */
    public function paginate(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $contacts = Contact::where('user_id', Auth::id())
            ->paginate($perPage);

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Export contacts to a CSV file.
     */
    public function export()
    {
        $contacts = Contact::where('user_id', Auth::id())->get();

        $csvFileName = 'contacts_' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        return response()->stream(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Name', 'Email', 'Phone']);

            foreach ($contacts as $contact) {
                fputcsv($handle, [$contact->name, $contact->email, $contact->phone]);
            }

            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Authorize the contact to ensure it belongs to the logged-in user.
     */
    private function authorizeContact(Contact $contact)
    {
        if ($contact->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}