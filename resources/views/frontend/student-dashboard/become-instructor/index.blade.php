@extends('frontend.layouts.master')

@section('page-title')
    EduCore | Student Dashboard
@endsection

@section('content')
    <!--===========================BREADCRUMB START============================-->
    <section class="wsus__breadcrumb" style="background: url({{ asset('frontend/assets/images/breadcrumb_bg.jpg') }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Become a Instructor</h1>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li>Become a Instructor</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--===========================BREADCRUMB END============================-->


    <!--===========================DASHBOARD OVERVIEW START============================-->
    <section class="wsus__dashboard mt_90 xs_mt_70 pb_120 xs_pb_100">
        <div class="container">
            <div class="row">
                @include('frontend.student-dashboard.sidebar')
                <div class="col-xl-9 col-md-8">
                    <div class="text-end">
                        <a href="{{ route('student.dashboard') }}" class="common_btn">
                            Back
                        </a>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            Become a Instructor
                        </div>
                        <div class="card-body">
                            <form action="{{ route('student.become-instructor.update', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Document <span class="text-danger">* Maximum 3MB</span>
                                            (Education/Certificate)</label>
                                        <input type="file" name="document"
                                            class="@error('document') border border-danger @enderror">
                                        @error('document')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="common_btn">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=========================== DASHBOARD OVERVIEW END ============================-->
@endsection
