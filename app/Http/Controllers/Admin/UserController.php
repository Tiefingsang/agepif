<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        return view('admin.users.form', ['user' => new User()]);
    }

    public function store(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,user',
            'phone' => 'nullable|string|max:20',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur ajouté avec succès.');
    }

    public function edit(User $user)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        return view('admin.users.form', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'phone' => 'nullable|string|max:20',
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:6|confirmed',
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur modifié avec succès.');
    }

    public function destroy(User $user)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé.');
        }

        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }
}
