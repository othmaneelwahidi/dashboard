<x-app-layout>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <style>
        .text-xl {
            margin-bottom:-40%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
            width: 90%; /* Adjust width as needed */
        }

        .container {
       
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            margin: 20px auto;
        }

        .dowload {
            margin-top: 15px;
            color: white;
            background-color: green;
            border-radius: 18px;
            padding: 8px 16px;
            text-align: center;
            cursor: pointer;
            margin-left:5%;
        }

        .dowload a {
            text-decoration: none;
            color: white;
        }

        .table-container {
            margin-top: 20px;
            width: 100%;
            overflow-x: auto; /* For responsiveness */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
        .c{
            margin-top:-100%;
            margin-left:5%;
            margin-bottom:5%;
        }
        .mb-4{
            margin-left:38%;
        }
    </style>


        <div class="container">
            <div class="c">
                <a href="#" style="color: black;">Dashboard</a> / Liste utilisateur
            </div>
            <button class="dowload">
                <a href="{{ route('export.users') }}">Download Excel</a>
            </button>
            <h2 class="text-xl font-bold mt-4">Liste utilisateurs</h2>

            <!-- Role Filter Input -->
            <div class="mb-4">
                <label for="roleFilter" class="mr-2"><strong>Role:</strong></label>
                <input type="text" id="roleFilter" class="border p-2" placeholder="Enter role to filter" oninput="filterByRole()" />
            </div>

            <!-- User Table -->
            <div class="table-container">
                <table class="border border-gray-200">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">
                        @foreach ($users as $index => $user)
                            <tr class="user-row">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name ?? 'N/A' }}</td>
                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}" class="text-blue-600">Edit</a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
  

    <script>
        // JavaScript function to filter users by role
        function filterByRole() {
            const roleFilter = document.getElementById('roleFilter').value.toLowerCase();
            const rows = document.querySelectorAll('.user-row');

            rows.forEach(row => {
                const role = row.cells[3].innerText.trim().toLowerCase(); // Fix: Correct column index for role
                if (role.includes(roleFilter) || roleFilter === "") {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
