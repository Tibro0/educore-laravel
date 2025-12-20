<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    use ImageUploadTrait;
    public function index()
    {
        return view('frontend.student-dashboard.dashboard.index');
    }

    public function becomeInstructor()
    {
        if (Auth::user()->role == 'instructor') {
            abort(403);
        }
        return view('frontend.student-dashboard.become-instructor.index');
    }

    public function becomeInstructorUpdate(Request $request, User $user)
    {
        $request->validate(['document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:3072']]);

        $filePath = $this->uploadImage($request, 'document', 'uploads/certificate');

        $user->update([
            'approve_status' => 'pending',
            'document' => $filePath
        ]);

        return redirect()->route('student.dashboard')->with('toast', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Your Request Has Been Send.'
        ]);
    }
}
