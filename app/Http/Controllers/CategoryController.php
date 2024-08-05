<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $categories;
    public function __construct()
    {
        $this->categories = new Category();
    }
    public function index()
    {
        $categories = $this->categories->getAll();
        return view('admins.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new category
        $dataInsert = [
            'name' => $request->name,
        ];

        // Insert the new category
        Category::createCategory($dataInsert);

        return redirect()->route('category.index')->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::find($id);

        if (!$categories) {
            return redirect()->route('category.index')->with('error', 'Category not found');
        }

        return view('admins.categories.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::find($id);

        if (!$categories) {
            return redirect()->route('category.index')->with('error', 'Category not found');
        }

        return view('admins.categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Fetch the category
        $categories = Category::find($id);

        if (!$categories) {
            return redirect()->route('category.index')->with('error', 'Category not found');
        }

        // Prepare the data for update
        $dataUpdate = [
            'name' => $request->name,
        ];

        // Update the category
        $categories->updateCategory($dataUpdate);

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $categories = $this->categories->find($id);
        if(!$categories){
            return redirect()->route('category.index');
        }
        $categories->delete();
        return redirect()->route('category.index');
    }
}
