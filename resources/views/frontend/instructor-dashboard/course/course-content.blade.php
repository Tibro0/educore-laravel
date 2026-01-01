@extends('frontend.instructor-dashboard.course.course-app')

@section('course_content')
    <div class="tab-pane fade show active" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
        <form action="{{ route('instructor.courses.update') }}" method="POST" class="course-form more_info_form">
            @csrf
            <input type="hidden" name="id" value="{{ request()?->id }}">
            <input type="hidden" name="current_step" value="3">
            <input type="hidden" name="next_step" value="4">
        </form>
        <div class="add_course_content">
            <div class="add_course_content_btn_area d-flex flex-wrap justify-content-between">
                <a class="common_btn dynamic-modal-btn" href="javascript:;" data-id="{{ $courseId }}">Add New
                    Chapter</a>
                <a class="common_btn" href="javascript:;">Short Chapter</a>
            </div>
            <div class="accordion" id="accordionExample">
                @foreach ($chapters as $chapter)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{$chapter->id}}" aria-expanded="true" aria-controls="collapse-{{$chapter->id}}">
                                <span>{{ $chapter->title }}</span>
                            </button>
                            <div class="add_course_content_action_btn">
                                <div class="dropdown">
                                    <div class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="far fa-plus"></i>
                                    </div>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#">Add Lesson</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Add Document</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Add Quiz</a></li>
                                    </ul>
                                </div>
                                <a class="edit" href="#"><i class="far fa-edit"></i></a>
                                <a class="del" href="#"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </h2>
                        <div id="collapse-{{$chapter->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul class="item_list">
                                    <li>
                                        <span>Aut autem dolorem debitis mollitia.</span>
                                        <div class="add_course_content_action_btn">
                                            <a class="edit" href="#"><i class="far fa-edit"></i></a>
                                            <a class="del" href="#"><i class="fas fa-trash-alt"></i></a>
                                            <a class="arrow" href="#"><i class="fas fa-arrows-alt"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Aut autem dolorem debitis mollitia.</span>
                                        <div class="add_course_content_action_btn">
                                            <a class="edit" href="#"><i class="far fa-edit"></i></a>
                                            <a class="del" href="#"><i class="fas fa-trash-alt"></i></a>
                                            <a class="arrow" href="#"><i class="fas fa-arrows-alt"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Aut autem dolorem debitis mollitia.</span>
                                        <div class="add_course_content_action_btn">
                                            <a class="edit" href="#"><i class="far fa-edit"></i></a>
                                            <a class="del" href="#"><i class="fas fa-trash-alt"></i></a>
                                            <a class="arrow" href="#"><i class="fas fa-arrows-alt"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Aut autem dolorem debitis mollitia.</span>
                                        <div class="add_course_content_action_btn">
                                            <a class="edit" href="#"><i class="far fa-edit"></i></a>
                                            <a class="del" href="#"><i class="fas fa-trash-alt"></i></a>
                                            <a class="arrow" href="#"><i class="fas fa-arrows-alt"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Aut autem dolorem debitis mollitia.</span>
                                        <div class="add_course_content_action_btn">
                                            <a class="edit" href="#"><i class="far fa-edit"></i></a>
                                            <a class="del" href="#"><i class="fas fa-trash-alt"></i></a>
                                            <a class="arrow" href="#"><i class="fas fa-arrows-alt"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                <span>Accordion Item #1</span>
                                            </button>
                                            <div class="add_course_content_action_btn">
                                                <div class="dropdown">
                                                    <div class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="far fa-plus"></i>
                                                    </div>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="#">Add Lesson</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Add Document</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="#">Add Quiz</a></li>
                                                    </ul>
                                                </div>
                                                <a class="edit" href="#"><i class="far fa-edit"></i></a>
                                                <a class="del" href="#"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">Placeholder content for
                                                this accordion, which is intended to demonstrate
                                                the <code>.accordion-flush</code> class. This is
                                                the first item's accordion body.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <!-- Modal -->
    <div class="modal fade" id="dynamic-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg dynamic-modal-content">

        </div>
    </div>
@endpush

@push('js-link')
    <script>
        $(document).ready(function() {
            $('.more_info_form').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    method: "POST",
                    url: $(this).attr('action'),
                    processData: false,
                    contentType: false,
                    data: formData,
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
                    }
                });
            });
        });
    </script>
    <script>
        var loader = `
        <div class="modal-content text-center p-3" style="display:inline">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>`;
    </script>
    <script>
        /** Course Contents */
        $('.dynamic-modal-btn').on('click', function(e) {
            e.preventDefault();
            $('#dynamic-modal').modal('show');

            let course_id = $(this).data('id');

            $.ajax({
                method: "GET",
                url: "{{ route('instructor.course-content.create-chapter', ':id') }}".replace(':id',
                    course_id),
                data: {},
                beforeSend: function() {
                    $('.dynamic-modal-content').html(loader);
                },
                success: function(data) {
                    $('.dynamic-modal-content').html(data);
                },
                error: function(xhr, status, error) {
                    $('#dynamic-modal').modal('show');
                }
            });
        })
    </script>
@endpush
