<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseCategoryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CourseCategory::whereNull('parent_id')->get();
        return view('admin.course.course-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.course-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:2048', 'dimensions:width=38,height=38'],
            'name' => ['required', 'string', 'max:255', 'unique:course_categories,name'],
            'show_at_treading' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        $imagePath = $this->uploadImage($request, 'image', 'uploads/categories_image');

        $category = new CourseCategory();
        $category->image = $imagePath;
        // $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->show_at_trending = $request->show_at_treading;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('admin.course-categories.index')->with('toast', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Create Successfully!'
        ]);
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
    public function edit(string $id)
    {
        $category = CourseCategory::findOrFail($id);
        return view('admin.course.course-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:2048', 'dimensions:width=38,height=38'],
            'name' => ['required', 'string', 'max:255', 'unique:course_categories,name,' . $id],
            'show_at_treading' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        $category = CourseCategory::findOrFail($id);

        $imagePath = $this->updateImage($request, 'image', 'uploads/categories_image', $category->image);

        $category->image = empty(!$imagePath) ? $imagePath : $category->image;
        // $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->show_at_trending = $request->show_at_treading;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('admin.course-categories.index')->with('toast', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Update Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = CourseCategory::findOrFail($id);
        $this->deleteImage($category->image);
        $category->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
