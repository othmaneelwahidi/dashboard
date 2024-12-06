<x-app-layout>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            margin-top: -55%;
        }

        .table-container {
            overflow-x: auto;
            white-space: nowrap;
        }

        .dowload {
            margin-top: 5%;
            color: black;
            margin-left: -300%;
            background-color: green;
            border-radius: 18px;
            padding: 5px 10px;
        }

        .a {

            margin-left: -100%;
        }
    </style>


    <div class="container mx-auto p-4">
        <div class="a"><a href="" style="color:black;">Dashboard </a> / Liste utilisateur</div>
        <div>
            <button class="dowload">
                <a href="{{ route('export.users') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                    Download Excel
                </a></button>
        </div>
        <h2 class="text-xl font-bold mb-4">Liste utilisateurs</h2>

        <!-- Role Filter Input -->
        <div class="mb-4">
            <label for="roleFilter" class="mr-2"><strong>Role :</strong> </label>
            <input type="text" id="roleFilter" class="border p-2" placeholder="Enter role to filter"
                oninput="filterByRole()" />
        </div>

        <div class="table-container">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-200 text-gray-600">
                    <tr>
                        <th class="py-2 px-4 border-b">#</th>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Role</th>
                        <th class="py-2 px-4 border-b">Created At</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    @foreach ($users as $index => $user)
                        <tr class="user-row">
                            <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->role->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $user->created_at->format('Y-m-d') }}</td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('user.edit', $user->id) }}">
                                    <button>Edit</button>
                                </a>
                                <br>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
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
                const role = row.cells[2].innerText.trim().toLowerCase();


                if (roleFilter === "" || role.includes(roleFilter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-app-layout>
