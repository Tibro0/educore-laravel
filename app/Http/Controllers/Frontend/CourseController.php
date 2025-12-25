<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseLanguage;
use App\Models\CourseLevel;
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
        $courses = Course::where(['instructor_id' => Auth::user()->id])->orderBy('id', 'DESC')->get();
        return view('frontend.instructor-dashboard.course.index', compact('courses'));
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

    public function edit(Request $request)
    {
        switch ($request->step) {
            case '1':
                $course = Course::findOrFail($request->id);
                return view('frontend.instructor-dashboard.course.edit', compact('course'));
                break;

            case '2':
                $categories = CourseCategory::where(['status' => 1])->orderBy('id', 'DESC')->get();
                $levels = CourseLevel::orderBy('id', 'DESC')->get();
                $languages = CourseLanguage::orderBy('id', 'DESC')->get();
                $course = Course::findOrFail($request->id);
                return view('frontend.instructor-dashboard.course.more-info', compact('categories', 'levels', 'languages', 'course'));
                break;
        }
    }

    public function update(Request $request)
    {
        switch ($request->current_step) {
            case '1':
                $request->validate([
                    'title' => ['required', 'max:255', 'string'],
                    'seo_description' => ['nullable', 'max:255', 'string'],
                    'demo_video_storage' => ['nullable', 'in:youtube,vimeo,external_link,upload', 'string'],
                    'price' => ['required', 'numeric'],
                    'discount' => ['nullable', 'numeric'],
                    'description' => ['required'],
                    'thumbnail' => ['nullable', 'image', 'max:2048', 'dimensions:width=305,height=200'],
                    'demo_video_source' => ['nullable']
                ]);

                $course = Course::findOrFail($request->id);


                $thumbnailPath = $this->updateImage($request, 'thumbnail', 'uploads/course_thumbnail_image', $course->thumbnail);


                $course->title = $request->title;
                $course->slug = Str::slug($request->title);
                $course->seo_description = $request->seo_description;
                $course->thumbnail = empty(!$thumbnailPath) ? $thumbnailPath : $course->thumbnail;
                $course->demo_video_storage = $request->demo_video_storage;
                $course->demo_video_source = $request->filled('file') ? $request->file : $request->url;
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
                break;

            case '2':
                $request->validate([
                    'capacity' => ['nullable', 'numeric'],
                    'duration' => ['required', 'numeric'],
                    'qna' => ['nullable', 'boolean'],
                    'certificate' => ['nullable', 'boolean'],
                    'category' => ['required', 'integer'],
                    'level' => ['required', 'integer'],
                    'language' => ['required', 'integer'],
                ]);

                // update course data
                $course = Course::findOrFail($request->id);
                $course->capacity = $request->capacity;
                $course->duration = $request->duration;
                $course->qna = $request->qna ? 1 : 0;
                $course->certificate = $request->certificate ? 1 : 0;
                $course->category_id = $request->category;
                $course->course_level_id = $request->level;
                $course->course_language_id = $request->language;
                $course->save();

                return response([
                    'status' => 'success',
                    'message' => 'Updated successfully.',
                    'redirect' => route('instructor.courses.edit', ['id' => $course->id, 'step' => $request->next_step])
                ]);
                break;
        }
    }
}
