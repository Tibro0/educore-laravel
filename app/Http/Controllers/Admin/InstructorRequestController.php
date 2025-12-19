<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InstructorRequestController extends Controller
{
    public function index()
    {
        $instructorsRequests = User::whereIn('approve_status', ['pending', 'rejected'])->get();
        return view('admin.instructor-request.index', compact('instructorsRequests'));
    }

    function download(User $user)
    {
        return response()->download(public_path($user->document));
    }

    public function update(Request $request, User $instructor_request)
    {
        $request->validate(['status' => ['required', 'in:approved,rejected,pending']]);

        $instructor_request->approve_status = $request->status;
        $request->status == 'approved' ? $instructor_request->role = 'instructor' : '';
        $instructor_request->save();

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Updated Successfully!'
        ]);
    }
}
