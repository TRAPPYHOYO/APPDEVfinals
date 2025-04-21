<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Contact Manager</h2>
            <a href="{{ route('contacts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Contact
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-medium">Phone</th>
                            <th class="px-6 py-3 text-right text-sm font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($contacts as $contact)
                            <tr>
                                <td class="px-6 py-4">{{ $contact->name }}</td>
                                <td class="px-6 py-4">{{ $contact->email }}</td>
                                <td class="px-6 py-4">{{ $contact->phone }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('contacts.edit', $contact->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">No contacts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
