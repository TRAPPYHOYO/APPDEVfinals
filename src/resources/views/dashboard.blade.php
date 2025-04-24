<!-- filepath: c:\SIRKIM\ContactDaw\src\resources\views\dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Contact Manager</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

        /* Category styles */
        .categories-container {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }

        .category-label {
            font-weight: bold;
            margin-right: 10px;
        }

        .category-item {
            background: #eaeaea;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-item:hover {
            background: #d1d1d1;
        }

        .category-item.active {
            background: #007bff;
            color: white;
        }

        .add-category-btn {
            background: #6c757d;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .add-category-btn:hover {
            background: #5a6268;
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

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .add-contact-btn {
            display: inline-block;
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

        .recent-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background: #17a2b8;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .recent-btn:hover {
            background: #138496;
            transform: scale(1.05);
        }

        .logout-btn {
            display: inline-block;
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
            margin-left: auto;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: scale(1.05);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            overflow: auto;
        }

        .modal-content {
            position: relative;
            background-color: #fff;
            margin: 15% auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 500px;
            animation: slideDown 0.3s ease-out;
        }

        .close-modal {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 24px;
            font-weight: bold;
            color: #aaa;
            cursor: pointer;
        }

        .close-modal:hover {
            color: #333;
        }

        .modal-header {
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .modal-header h3 {
            margin: 0;
            color: #007bff;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .contact-data {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .contact-field {
            display: flex;
            flex-direction: column;
        }

        .contact-field label, .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .contact-field span {
            padding: 8px;
            background-color: #f9f9f9;
            border-radius: 4px;
            border: 1px solid #eee;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .modal-footer {
            text-align: right;
            padding-top: 15px;
            border-top: 1px solid #eee;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .modal-btn {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal-btn:hover {
            background-color: #0056b3;
        }

        .modal-btn-cancel {
            padding: 8px 15px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .modal-btn-cancel:hover {
            background-color: #5a6268;
        }

        .spinner {
            display: none;
            width: 40px;
            height: 40px;
            margin: 20px auto;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
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

        <!-- Categories -->
        <div class="categories-container">
            <span class="category-label">Categories:</span>
            <div class="category-item active" onclick="filterByCategory('all')">All Contacts</div>
            <!-- We'll populate these dynamically from the database -->
            @foreach($categories ?? [] as $category)
                <div class="category-item" onclick="filterByCategory('{{ $category->id }}')">{{ $category->name }}</div>
            @endforeach
            <div class="add-category-btn" onclick="openAddCategoryModal()">+ Add Category</div>
        </div>

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
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                <tr class="contact-row" data-category="{{ $contact->category_id ?? 'all' }}">
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>{{ $contact->category ? $contact->category->name : 'Uncategorized' }}</td>
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
                    <td colspan="5" style="text-align: center;">No contacts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ route('contacts.create') }}" class="add-contact-btn">+ Add Contact</a>
            <button type="button" class="recent-btn" onclick="fetchRecentContact()">Recent</button>
            <form method="POST" action="{{ route('logout') }}" style="margin-left: auto;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <!-- Recent Contact Modal -->
    <div id="recentContactModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('recentContactModal')">&times;</span>
            <div class="modal-header">
                <h3>Most Recent Contact</h3>
            </div>
            <div class="modal-body">
                <div id="spinner" class="spinner"></div>
                <div id="noContactsMessage" style="display: none; text-align: center; padding: 20px;">
                    <p>You have no contacts yet. Add your first contact!</p>
                </div>
                <div id="contactData" class="contact-data" style="display: none;">
                    <div class="contact-field">
                        <label>Name</label>
                        <span id="contactName"></span>
                    </div>
                    <div class="contact-field">
                        <label>Email</label>
                        <span id="contactEmail"></span>
                    </div>
                    <div class="contact-field">
                        <label>Phone</label>
                        <span id="contactPhone"></span>
                    </div>
                    <div class="contact-field">
                        <label>Category</label>
                        <span id="contactCategory"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-btn" onclick="closeModal('recentContactModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('addCategoryModal')">&times;</span>
            <div class="modal-header">
                <h3>Add New Category</h3>
            </div>
            <div class="modal-body">
                <form id="categoryForm">
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="text" id="categoryName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryDescription">Description (Optional)</label>
                        <input type="text" id="categoryDescription" name="description">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="modal-btn-cancel" onclick="closeModal('addCategoryModal')">Cancel</button>
                <button type="button" class="modal-btn" onclick="saveCategory()">Save Category</button>
            </div>
        </div>
    </div>

    <script>
        function fetchRecentContact() {
            // Get the CSRF token
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            // Show modal and spinner
            document.getElementById('recentContactModal').style.display = 'block';
            document.getElementById('spinner').style.display = 'block';
            document.getElementById('contactData').style.display = 'none';
            document.getElementById('noContactsMessage').style.display = 'none';
            
            // Make AJAX request to get the most recent contact
            fetch('/contacts/recent', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Hide spinner
                document.getElementById('spinner').style.display = 'none';
                
                if (data.contact) {
                    // Show contact data
                    document.getElementById('contactData').style.display = 'block';
                    document.getElementById('contactName').textContent = data.contact.name;
                    document.getElementById('contactEmail').textContent = data.contact.email;
                    document.getElementById('contactPhone').textContent = data.contact.phone;
                    document.getElementById('contactCategory').textContent = data.contact.category_name || 'Uncategorized';
                } else {
                    // Show no contacts message
                    document.getElementById('noContactsMessage').style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('spinner').style.display = 'none';
                alert('An error occurred while fetching the recent contact.');
            });
        }
        
        // Function to open the add category modal
        function openAddCategoryModal() {
            document.getElementById('addCategoryModal').style.display = 'block';
        }
        
        // Function to save a new category
        function saveCategory() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const name = document.getElementById('categoryName').value;
            const description = document.getElementById('categoryDescription').value;
            
            if (!name) {
                alert('Category name is required');
                return;
            }
            
            fetch('/api/categories', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    description: description
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close modal
                    closeModal('addCategoryModal');
                    
                    // Refresh page to show new category
                    window.location.reload();
                } else {
                    alert(data.message || 'Failed to create category');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while creating the category.');
            });
        }
        
        // Function to filter contacts by category
        function filterByCategory(categoryId) {
            // Update active category
            const categories = document.querySelectorAll('.category-item');
            categories.forEach(cat => cat.classList.remove('active'));
            event.currentTarget.classList.add('active');
            
            // Filter the contact rows
            const contactRows = document.querySelectorAll('.contact-row');
            contactRows.forEach(row => {
                if (categoryId === 'all' || row.dataset.category === categoryId) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        
        // Function to close modals
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            if (modalId === 'addCategoryModal') {
                // Reset form
                document.getElementById('categoryForm').reset();
            }
        }
        
        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const recentModal = document.getElementById('recentContactModal');
            const categoryModal = document.getElementById('addCategoryModal');
            
            if (event.target === recentModal) {
                recentModal.style.display = 'none';
            }
            
            if (event.target === categoryModal) {
                categoryModal.style.display = 'none';
            }
        }
    </script>
</body>
</html>