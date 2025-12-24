<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        return view('frontend.instructor-dashboard.course.index');
    }

    public function create()
    {
        return view('frontend.instructor-dashboard.course.create');
    }

    function storeBasicInfo(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'seo_description' => ['nullable', 'max:255', 'string'],
            'demo_video_storage' => ['nullable', 'in:youtube,vimeo,external_link,upload', 'string'],
            'price' => ['required', 'numeric'],
            'discount' => ['nullable', 'numeric'],
            'description' => ['required'],
            'thumbnail' => ['required', 'image', 'max:2048', 'dimensions:width=305,height=200'],
            'demo_video_source' => ['nullable']
        ]);

        $thumbnailPath = $this->uploadImage($request, 'thumbnail', 'uploads/course_thumbnail_image');

        $course = new Course();
        $course->title = $request->title;
        $course->slug = Str::slug($request->title);
        $course->seo_description = $request->seo_description;
        $course->thumbnail = $thumbnailPath;
        $course->demo_video_storage = $request->demo_video_storage;
        $course->demo_video_source = $request->demo_video_source;
        $course->price = $request->price;
        $course->discount = $request->discount;
        $course->description = $request->description;
        $course->instructor_id = Auth::guard('web')->user()->id;
        $course->save();

        // Save Course id on Session
        Session::put('course_create_id', $course->id);

        return response([
            'status' => 'success',
            'message' => 'Updated successfully.',
            'redirect' => route('instructor.courses.edit', ['id' => $course->id, 'step' => $request->next_step])
        ]);
    }

    function edit(Request $request)
    {

        switch ($request->step) {
            case '1':

                break;

            case '2':
                $categories = CourseCategory::where(['status' => 1])->get();
                return view('frontend.instructor-dashboard.course.more-info', compact('categories'));
                break;
        }
    }
}
