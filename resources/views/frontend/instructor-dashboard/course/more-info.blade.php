@extends('frontend.instructor-dashboard.course.course-app')

@section('course_content')
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <div class="add_course_more_info">
            <form action="{{ route('instructor.courses.update') }}" class="more_info_form course-form">
                <input type="hidden" name="id" value="{{ request()?->id }}">
                <input type="hidden" name="current_step" value="2">
                <input type="hidden" name="next_step" value="3">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="add_course_more_info_input">
                            <label>Capacity</label>
                            <input type="text" placeholder="Capacity" name="capacity">
                            <div class="text-danger capacity"></div>
                            <p>leave blank for unlimited</p>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_more_info_input">
                            <label>Course Duration (Minutes)<code>*</code></label>
                            <input type="text" placeholder="300" name="duration">
                            <div class="text-danger duration"></div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="add_course_more_info_checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="qna" value="1"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Q&A</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="certificate" value="1"
                                    id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">Completion Certificate</label>
                            </div>
                            <div class="text-danger qna"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="add_course_more_info_input">
                            <label>Category <code>*</code></label>
                            <select class="select_2" name="category">
                                <option value=""> Please Select </option>
                                @foreach ($categories as $category)
                                    @if ($category->subCategories->isNotEmpty())
                                        <optgroup label="{{ $category->name }}">
                                            @foreach ($category->subCategories as $subCategory)
                                                <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endif
                                @endforeach
                            </select>
                            <div class="text-danger category"></div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="add_course_more_info_radio_box">
                            <h3>Level</h3>
                            @foreach ($levels as $level)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="{{ $level->id }}"
                                        name="level" id="id-{{ $level->id }}">
                                    <label class="form-check-label" for="id-{{ $level->id }}">
                                        {{ $level->name }}
                                    </label>
                                </div>
                            @endforeach
                            <div class="text-danger level"></div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="add_course_more_info_radio_box">
                            <h3>Language</h3>
                            @foreach ($languages as $language)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="{{ $language->id }}"
                                        name="language" id="id-{{ $language->id }}">
                                    <label class="form-check-label" for="id-{{ $language->id }}">
                                        {{ $language->name }}
                                    </label>
                                </div>
                            @endforeach
                            <div class="text-danger language"></div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <button type="submit" class="common_btn">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js-link')
    <script>
        $(document).ready(function() {
            $('.more_info_form').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.text-danger').text('');
                $('input, select').removeClass('border border-danger');

                let formData = new FormData(this);

                let submitBtn = $(this).find('button[type="submit"]');
                let originalText = submitBtn.text();
                submitBtn.prop('disabled', true).text('Saving...');

                $.ajax({
                    method: "POST",
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {

                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            toastr.success(data.message || 'Saved Successfully!');

                            if (data.redirect) {
                                setTimeout(() => {
                                    window.location.href = data.redirect;
                                }, 1500);
                            }
                        } else {
                            toastr.error(data.message || 'Failed to save');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Check if errors exist
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            // capacity error
                            if (errors.capacity && errors.capacity[0]) {
                                $("input[name='capacity']").addClass('border border-danger');
                                $('.capacity').text(errors.capacity[0]);
                            }
                            // duration error
                            if (errors.duration && errors.duration[0]) {
                                $("input[name='duration']").addClass('border border-danger');
                                $('.duration').text(errors.duration[0]);
                            }
                            // qna error
                            if (errors.qna && errors.qna[0]) {
                                $("checkbox[name='qna']").addClass('border border-danger');
                                $('.qna').text(errors.qna[0]);
                            }

                            // category error
                            if (errors.category && errors.category[0]) {
                                $("select[name='category']").addClass('border border-danger');
                                $('.category').text(errors.category[0]);
                            }

                            // level error
                            if (errors.level && errors.level[0]) {
                                $("radio[name='level']").addClass('border border-danger');
                                $('.level').text(errors.level[0]);
                            }

                            // language error
                            if (errors.language && errors.language[0]) {
                                $("radio[name='language']").addClass('border border-danger');
                                $('.language').text(errors.language[0]);
                            }

                        }
                        // If no validation errors but general error
                        else if (xhr.responseJSON && xhr.responseJSON.message) {
                            toastr.error(xhr.responseJSON.message);
                        }
                        // Unknown error
                        else {
                            toastr.error('Something Went Wrong. Please Try Again Later.');
                        }
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).text(originalText);
                    }
                })

            });
        });
    </script>
@endpush
