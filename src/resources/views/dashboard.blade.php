<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Contact Manager') }}
            </h2>
            <a href="#" 
               class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                + Add Contact
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Your Contacts</h3>

                <!-- Search Bar -->
                <form method="GET" action="#" class="mb-4">
                    <div class="flex items-center">
                        <input type="text" name="search" placeholder="Search contacts..." 
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                               value="">
                        <button type="submit" 
                                class="ml-2 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                            Search
                        </button>
                    </div>
                </form>

                <!-- Contacts Table -->
                <table class="table-auto w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="border px-4 py-2 text-left">Name</th>
                            <th class="border px-4 py-2 text-left">Email</th>
                            <th class="border px-4 py-2 text-left">Phone</th>
                            <th class="border px-4 py-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Placeholder Data -->
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="border px-4 py-2">John Doe</td>
                            <td class="border px-4 py-2">johndoe@example.com</td>
                            <td class="border px-4 py-2">123-456-7890</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="#" class="text-blue-600 hover:underline">Edit</a>
                                <form action="#" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:underline ml-2"
                                            onclick="return confirm('Are you sure you want to delete this contact?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <!-- Add more rows dynamically -->
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4">
                    <p class="text-gray-600">Pagination Placeholder</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>