<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseSubCategoryController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $categoryId)
    {
        $categories = CourseCategory::findOrFail($categoryId);
        $subCategories = CourseCategory::where(['parent_id' => $categoryId])->get();
        return view('admin.course.course-sub-category.index', compact('categories', 'subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $categoryId)
    {
        $categories = CourseCategory::findOrFail($categoryId);
        return view('admin.course.course-sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $categoryId)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:2048', 'dimensions:width=38,height=38'],
            'name' => ['required', 'string', 'max:255', 'unique:course_categories,name'],
            // 'show_at_treading' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        $category = new CourseCategory();

        $imagePath = $this->uploadImage($request, 'image', 'uploads/sub_categories_image');

        $category->image = $imagePath;
        // $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $categoryId;
        // $category->show_at_trending = $request->show_at_treading;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('admin.course-sub-categories.index', $categoryId)->with('toast', [
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
    public function edit(string $categoryId, string $subCategoryId)
    {
        $categories = CourseCategory::findOrFail($categoryId);
        $subCategories = CourseCategory::findOrFail($subCategoryId);
        return view('admin.course.course-sub-category.edit', compact('categories', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $categoryId, string $subCategoryId)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:2048', 'dimensions:width=38,height=38'],
            'name' => ['required', 'string', 'max:255', 'unique:course_categories,name,'. $subCategoryId],
            // 'show_at_treading' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        $category = CourseCategory::findOrFail($subCategoryId);

        $imagePath = $this->updateImage($request, 'image', 'uploads/sub_categories_image', $category->image);

        $category->image = empty(!$imagePath) ? $imagePath : $category->image;
        // $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $categoryId;
        // $category->show_at_trending = $request->show_at_treading;
        $category->status = $request->status;
        $category->save();

        return redirect()->route('admin.course-sub-categories.index', $categoryId)->with('toast', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Updated Successfully!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $subCategoryId)
    {
        $subCategories = CourseCategory::findOrFail($subCategoryId);
        $this->deleteImage($subCategories->image);
        $subCategories->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
