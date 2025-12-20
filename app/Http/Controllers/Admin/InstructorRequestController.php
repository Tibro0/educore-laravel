<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InstructorRequestApprovedMail;
use App\Mail\InstructorRequestRejectMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class InstructorRequestController extends Controller
{
    public function index()
    {
        $instructorsRequests = User::whereIn('approve_status', ['pending', 'rejected'])->orderBy('id', 'DESC')->get();
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

        self::sendNotification($instructor_request);

        return redirect()->back()->with('toast', [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Updated Successfully!'
        ]);
    }

    public static function sendNotification($instructor_request)
    {
        if ($instructor_request->approve_status === 'approved') {
            if (Config::get('mail_queue.is_queue')) {
                Mail::to($instructor_request->email)->queue(new InstructorRequestApprovedMail());
            } else {
                Mail::to($instructor_request->email)->send(new InstructorRequestApprovedMail());
            }
        } elseif ($instructor_request->approve_status === 'rejected') {
            if (Config::get('mail_queue.is_queue')) {
                Mail::to($instructor_request->email)->queue(new InstructorRequestRejectMail());
            } else {
                Mail::to($instructor_request->email)->send(new InstructorRequestRejectMail());
            }
        }
    }
}
