<x-app-layout>
    <style>
        .container {
            align-items: center;
            justify-content: center;
            height: 100vh; /* Full viewport height */
            margin: 0; /* Remove any margin */
            margin-top: -45%;
        }

        .submit-btn {
            margin-left: 45%;
            padding: 12px 24px;
            background-color: green;
            color: white;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .submit-btn:hover {
            background-color: darkgreen;
            transform: scale(1.05);
        }

        .submit-btn:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }

        /* Styling for the form inputs and labels */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        small {
            display: block;
            margin-top: 5px;
            font-size: 0.875rem;
            color: #888;
        }

        .alert {
            margin-top: 10px;
            padding: 10px;
            border-radius: 8px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>

    <div class="container mx-auto p-4">
        <h2 class="text-xl font-bold mb-4">Edit User</h2>

        <!-- Success message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form to update user -->
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name') <span>{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email') <span>{{ $message }}</span> @enderror
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label for="role">Role</label>
                <select name="role" id="role" required>
                    <option value="Administrateur" {{ old('role', $user->role) == 'Administrateur' ? 'selected' : '' }}>Administrateur</option>
                    <option value="Visualiseur" {{ old('role', $user->role) == 'Visualiseur' ? 'selected' : '' }}>Visualiseur</option>
                    <option value="Utilisateur standar" {{ old('role', $user->role) == 'Utilisateur standar' ? 'selected' : '' }}>Utilisateur standar</option>
                </select>
                @error('role') <span>{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password">
                <small>If you want to change the password, enter a new one.</small>
                @error('password') <span>{{ $message }}</span> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
                @error('password_confirmation') <span>{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="submit-btn">
                    Update User
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
