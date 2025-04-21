<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Contact Manager') }}
            </h2>
            <a href="{{ route('contacts.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                + Add Contact
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Your Contacts</h3>

                @if ($contacts->isEmpty())
                    <p class="text-gray-600">No contacts found. Click "+ Add Contact" to create one.</p>
                @else
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Phone</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td class="border px-4 py-2">{{ $contact->name }}</td>
                                    <td class="border px-4 py-2">{{ $contact->email }}</td>
                                    <td class="border px-4 py-2">{{ $contact->phone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>