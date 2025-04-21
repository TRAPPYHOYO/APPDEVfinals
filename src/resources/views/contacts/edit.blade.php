<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Edit Contact</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto">
            <form action="{{ route('contacts.update', $contact->id) }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium">Name</label>
                    <input name="name" value="{{ $contact->name }}" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Email</label>
                    <input name="email" type="email" value="{{ $contact->email }}" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium">Phone</label>
                    <input name="phone" value="{{ $contact->phone }}" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" type="submit">
                    Update Contact
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
