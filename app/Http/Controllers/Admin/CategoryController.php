<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
{
    $validatedData = $request->validated();

    // Validate file extension manually
    if (!in_array($request->file('image')->getClientOriginalExtension(), ['jpg', 'jpeg', 'png'])) {
        return redirect()->back()->withErrors(['image' => 'Only JPG and PNG files are allowed.'])->withInput();
    }

    $image = $request->file('image')->store('public/categories');

    Category::create([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $image
    ]);

    return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'image' => ['nullable', 'image', function ($attribute, $value, $fail) use ($request) {
            if ($request->hasFile('image')) {
                $allowedExtensions = ['jpg', 'jpeg', 'png'];
                $extension = $request->file('image')->getClientOriginalExtension();
                if (!in_array($extension, $allowedExtensions)) {
                    $fail('The '.$attribute.' must be a JPG, JPEG, or PNG image.');
                }
            }
        }],
    ]);

    $image = $category->image;
    if ($request->hasFile('image')) {
        Storage::delete($category->image);
        $image = $request->file('image')->store('public/categories');
    }

    $category->update([
        'name' => $request->name,
        'description' => $request->description,
        'image' =>$image
    ]);
    
    return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Storage::delete($category->image);
        $category->menus()->detach();
        $category->delete();

        return to_route('admin.categories.index')->with('danger', 'Category deleted successfully');
    }
}
