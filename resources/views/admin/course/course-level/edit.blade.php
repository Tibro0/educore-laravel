@extends('admin.layouts.master')

@section('page-title')
    Admin | Course Level
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Update Course Level</h4>
                        <div>
                            <a href="{{ route('admin.course-levels.index') }}"
                                class="btn btn-primary px-5 rounded">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.course-levels.update', $level->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ $level->name ?? old('name') }}"
                                    placeholder="Enter Language Name"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary px-5" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
