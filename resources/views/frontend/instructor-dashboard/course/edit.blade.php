@extends('frontend.instructor-dashboard.course.course-app')

@section('course_content')
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
        <div class="add_course_basic_info">
            <form action="{{ route('instructor.courses.update') }}" method="POST" class="basic_info_update_form course-form"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $course->id }}">
                <input type="hidden" name="current_step" value="1">
                <input type="hidden" name="next_step" value="2">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput">
                            <label>Title <code>*</code></label>
                            <input type="text" placeholder="Title" name="title"
                                value="{{ old('title') ?? $course->title }}"
                                class="@error('title') border border-danger @enderror">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput">
                            <label>Seo description</label>
                            <input type="text" placeholder="Seo description" name="seo_description"
                                value="{{ old('seo_description') ?? $course->seo_description }}"
                                class="@error('seo_description') border border-danger @enderror">
                            @error('seo_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-10">
                        <div class="add_course_basic_info_imput">
                            <label>Thumbnail</label>
                            <input type="file" name="thumbnail"
                                class="@error('thumbnail') border border-danger @enderror">
                            @error('thumbnail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-2">
                        <img src="{{ asset($course->thumbnail) }}" width="100">
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_imput">
                            <label for="#">Demo Video Storage <b>(optional)</b></label>
                            <select class="select_js storage" name="demo_video_storage">
                                <option value=""> Please Select </option>
                                <option @selected($course->demo_video_storage == 'upload') value="upload"> Upload </option>
                                <option @selected($course->demo_video_storage == 'youtube') value="youtube"> Youtube </option>
                                <option @selected($course->demo_video_storage == 'vimeo') value="vimeo"> Vimeo </option>
                                <option @selected($course->demo_video_storage == 'external_link') value="external_link"> External Link </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div
                            class="add_course_basic_info_imput upload_source {{ $course->demo_video_storage == 'upload' ? '' : 'd-none' }}">
                            <label for="#">Path</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control source_input" type="text" name="file"
                                    value="{{ $course->demo_video_source }}">
                            </div>
                        </div>
                        <div
                            class="add_course_basic_info_imput external_source {{ $course->demo_video_storage != 'upload' ? '' : 'd-none' }}">
                            <label for="#">Path</label>
                            <input type="text" name="url" class="source_input"
                                value="{{ $course->demo_video_source }}">
                        </div>


                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_imput">
                            <label>Price <code>*</code></label>
                            <input type="text" placeholder="Price" name="price"
                                value="{{ $course->price ?? old('price') }}"
                                class="@error('price') border border-danger @enderror">
                            <p>Put 0 for free</p>
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_basic_info_imput">
                            <label>Discount Price</label>
                            <input type="text" placeholder="Discount Price" name="discount"
                                value="{{ $course->discount ?? old('discount') }}"
                                class="@error('discount') border border-danger @enderror">
                            @error('discount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="add_course_basic_info_imput mb-0">
                            <label>Description</label>
                            <textarea rows="8" placeholder="Description" name="description" class="editor"
                                class="@error('description') border border-danger @enderror">{!! $course->description ?? old('description') !!}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="common_btn mt_20">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js-link')
    {{-- Laravel file Manager Start --}}
    <script script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm').filemanager('file');
    </script>
    {{-- Laravel file Manager End --}}

    <script>
        $(document).ready(function() {
            $('.basic_info_update_form').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.border-danger').removeClass('border-danger');
                $('.text-danger').remove();

                let formData = new FormData(this);

                let submitBtn = $(this).find('button[type="submit"]');
                let originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Saving...');

                $.ajax({
                    method: "POST",
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message || 'Saved Successfully!');

                            if (response.redirect) {
                                setTimeout(() => {
                                    window.location.href = response.redirect;
                                }, 1500);
                            }
                        } else {
                            toastr.error(response.message || 'Failed to save');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Clear previous errors
                        $('.border-danger').removeClass('border-danger');
                        $('.text-danger').remove();

                        // Handle validation errors (422)
                        if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;

                            // Display errors for each field
                            $.each(errors, function(field, messages) {
                                let inputElement = $('[name="' + field + '"]');

                                // Find the parent container
                                let parentDiv = inputElement.closest(
                                    '.add_course_basic_info_imput');

                                // Add border to input
                                if (inputElement.length) {
                                    inputElement.addClass('border border-danger');
                                }

                                // Add error message
                                if (parentDiv.length && messages[0]) {
                                    parentDiv.append(
                                        '<div class="text-danger mt-1 small">' +
                                        messages[0] + '</div>');
                                }
                            });

                            // Focus on first error field
                            let firstError = Object.keys(errors)[0];
                            if (firstError) {
                                $('[name="' + firstError + '"]').focus();
                            }

                        } else {
                            // Other errors
                            let errorMessage = 'An error occurred. Please try again.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            toastr.error(errorMessage);
                        }
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).text(originalText);
                    }
                });
            });

            // show hide path input depending on source
            $(document).on('change', '.storage', function() {
                let value = $(this).val();
                $('.source_input').val('');

                if (value == 'upload') {
                    $('.upload_source').removeClass('d-none');
                    $('.external_source').addClass('d-none');
                } else {
                    $('.upload_source').addClass('d-none');
                    $('.external_source').removeClass('d-none');
                }
            });
        });
    </script>
@endpush
