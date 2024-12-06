<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Produit;
use App\Models\Role;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function index()
    {
        // Eager load the 'role' relationship
        $users = User::with('role')->get();
        return view('user.index', compact('users'));
    }


    public function create()
{
    // Fetch all roles to populate the dropdown or selection list
    $roles = Role::all();
    return view('user.create', compact('roles'));
}

// Store the new user
public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role' => 'exists:role,name', // Validate the role exists in the 'role' table
        'password' => 'required|string|min:8|confirmed',
    ]);

    $role = Role::where('name', $request->role)->first();

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'role_id' => $role->id, 
        'password' => Hash::make($request->password),
    ]);
    $user->save();

    return redirect()->route('users.index')->with('success', 'User added successfully!');
}



    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
    public function update(Request $request, $id)
    {
        // Validate the request input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role_id' => 'required|exists:role,id', // Validate that role_id exists in the role table
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Find the user and the role
        $role = Role::where('id', $request->role_id)->first();
        $user = User::findOrFail($id);

        // Update the user attributes
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role_id = $role->id;

        // Update the password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Save the user
        $user->save();

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }


    public function edit($id)
    {
        // Find the user by ID or fail
        $user = User::findOrFail($id);

        // Fetch all roles to populate the dropdown in the edit form
        $roles = Role::all();

        // Pass the user and roles to the edit view
        return view('user.edit', compact('user', 'roles'));
    }
}
