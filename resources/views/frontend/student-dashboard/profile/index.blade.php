@extends('frontend.layouts.master')

@section('page-title')
    EduCore | Student Profile
@endsection

@section('content')
    <!--===========================BREADCRUMB START============================-->
    <section class="wsus__breadcrumb" style="background: url({{ asset('frontend/assets/images/breadcrumb_bg.jpg') }});">
        <div class="wsus__breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12 wow fadeInUp">
                        <div class="wsus__breadcrumb_text">
                            <h1>Student Profile Update</h1>
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li>Student Profile Update</li>
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
                <div class="col-xl-9 col-md-8 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                    <div class="wsus__dashboard_contant">
                        <div class="wsus__dashboard_contant_top d-flex flex-wrap justify-content-between">
                            <div class="wsus__dashboard_heading">
                                <h5>Update Your Information</h5>
                                <p>Manage your courses and its update like live, draft and insight.</p>
                            </div>
                        </div>
                        <form action="{{ route('student.profile.update') }}" method="POST"
                            class="wsus__dashboard_profile_update" enctype="multipart/form-data">
                            @csrf
                            <div class="wsus__dashboard_profile wsus__dashboard_profile_avatar">
                                <div class="img">
                                    <img src="{{ asset(Auth::user()->image) }}" alt="profile" class="img-fluid w-100">
                                    <label for="profile_photo">
                                        <img src="{{ asset('frontend/assets/images/dash_camera.png') }}" alt="camera"
                                            class="img-fluid w-100">
                                    </label>
                                    <input type="file" id="profile_photo" name="avatar" hidden="">
                                </div>
                                <div class="text">
                                    <h6>Your avatar</h6>
                                    <p>PNG or JPG no bigger than 400px wide and tall.</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" placeholder="Enter your name" name="name"
                                            value="{{ Auth::user()->name }}"
                                            class="@error('name') border border-danger @enderror">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label class="form-label">Headline</label>
                                        <input type="text" placeholder="Enter your headline" name="heading"
                                            value="{{ Auth::user()->headline }}"
                                            class="@error('heading') border border-danger @enderror">
                                        @error('heading')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label class="form-label">Email</label>
                                        <input type="text" placeholder="Enter your email" name="email"
                                            value="{{ Auth::user()->email }}"
                                            class="@error('email') border border-danger @enderror">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="wsus__dashboard_profile_update_info ">
                                        <label class="form-label">Gender</label>
                                        <select class="form-control py-3" name="gender"
                                            class="@error('gender') border border-danger @enderror">
                                            <option value="">Select a Gender</option>
                                            <option @selected(Auth::user()->gender == 'male') value="male">Male</option>
                                            <option @selected(Auth::user()->gender == 'female') value="female">Female</option>
                                        </select>
                                        @error('gender')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_info">
                                        <label class="form-label">About Me</label>
                                        <textarea rows="7" placeholder="Your text here" name="about"
                                            class="@error('about') border border-danger @enderror">{{ Auth::user()->bio }}</textarea>
                                        @error('about')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="wsus__dashboard_profile_update_btn">
                                        <button type="submit" class="common_btn">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!--===========================DASHBOARD OVERVIEW END============================-->
@endsection
