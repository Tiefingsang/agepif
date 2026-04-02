<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        // Vérifier si l'utilisateur est admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé. Vous devez être administrateur.');
        }

        $categories = Category::orderBy('order')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        // Vérifier si l'utilisateur est admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé. Vous devez être administrateur.');
        }

        return view('admin.categories.form', ['category' => new Category()]);
    }

    public function store(Request $request)
    {
        // Vérifier si l'utilisateur est admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé. Vous devez être administrateur.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($request->name);

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function edit(Category $category)
    {
        // Vérifier si l'utilisateur est admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé. Vous devez être administrateur.');
        }

        return view('admin.categories.form', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Vérifier si l'utilisateur est admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé. Vous devez être administrateur.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->name !== $category->name) {
            $validated['slug'] = Str::slug($request->name);
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie modifiée avec succès.');
    }

    public function destroy(Category $category)
    {
        // Vérifier si l'utilisateur est admin
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé. Vous devez être administrateur.');
        }

        if ($category->properties()->count() > 0) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des biens.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}
