<x-app-layout>
    <style>
      
         .container {
         
            align-items: center;
            justify-content: center;
            height: 100vh; /* Full viewport height */
            margin: 0; /* Remove any margin */
            margin-top:-45%;
         
        }
        .submit-btn {
          margin-left:45%;
            padding: 12px 24px;
            background-color: green;
            color: white; 
            border-radius: 8px; 
            border: none; 
            cursor: pointer; 
            transition: background-color 0.2s ease, transform 0.2s ease; 
        }

        .submit-btn:hover {
            background-color: green; 
            transform: scale(1.05); 
        }

        .submit-btn:focus {
            outline: none; 
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5); 
        }

    </style>
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-bold mb-4">Add New User</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="w-full px-3 py-2 border rounded"
                    required
                    value="{{ old('name') }}"
                />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    class="w-full px-3 py-2 border rounded"
                    required
                    value="{{ old('email') }}"
                />
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role</label>
                <select id="role" class="block mt-1 w-full" name="role" required>
                    <option value="" selected disabled>Choisir votre rôle</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select> 
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full px-3 py-2 border rounded"
                    required
                />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="w-full px-3 py-2 border rounded"
                    required
                />
            </div>

            <!-- Submit Button -->
          <!-- Submit Button -->
          <div class="mt-4">
                <button type="submit" class="submit-btn">
                    Add User
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
