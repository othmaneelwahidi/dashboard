<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    public function showUsers()
    {
        $users = User::all();
        return view('Panel.Listeutilisateur', compact('users'));
    }


    public function create()
    {
        return view('Panel.Utilisateuredit');
    }

    // Store the new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('users.create')->with('success', 'User added successfully!');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.Listeutilisateur')->with('success', 'User deleted successfully');
    }
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);


        $user = User::findOrFail($id);


        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();


        return redirect()->route('users.Listeutilisateur')->with('success', 'User updated successfully');
    }
    public function edit($id)
    {

        $user = User::findOrFail($id);


        return view('Panel.Editutilisateur', compact('user'));
    }
}
