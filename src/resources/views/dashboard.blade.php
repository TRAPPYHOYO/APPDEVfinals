<!-- filepath: c:\SIRKIM\ContactDaw\src\resources\views\dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Contact Manager</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .dashboard-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 800px;
            animation: fadeIn 1.5s ease-in-out;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 2rem;
            color: #007bff;
            text-align: center;
        }

        .flash-message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-bar input {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 70%;
        }

        .search-bar button {
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .search-bar button:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .contacts-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .contacts-table th, .contacts-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .contacts-table th {
            background: #007bff;
            color: #fff;
        }

        .contacts-table tr:nth-child(even) {
            background: #f9f9f9;
        }

        .contacts-table tr:hover {
            background: #f1f1f1;
        }

        .add-contact-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background: #28a745;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .add-contact-btn:hover {
            background: #218838;
            transform: scale(1.05);
        }

        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background: #dc3545;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: scale(1.05);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, {{ Auth::user()->name }}</h2>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="flash-message">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Bar -->
        <form method="GET" action="{{ route('contacts.index') }}" class="search-bar">
            <input type="text" name="search" placeholder="Search contacts..." value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>

        <!-- Contacts Table -->
        <table class="contacts-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>
                        <a href="{{ route('contacts.edit', $contact->id) }}" class="edit-btn">Edit</a>
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center;">No contacts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Add Contact Button -->
        <a href="{{ route('contacts.create') }}" class="add-contact-btn">+ Add Contact</a>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>