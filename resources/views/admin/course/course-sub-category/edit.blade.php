@extends('admin.layouts.master')

@section('page-title')
    Admin | Course Sub Category
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Update Course Sub Category</h4>
                        <div>
                            <a href="{{ route('admin.course-sub-categories.index', $categories->id) }}"
                                class="btn btn-primary px-5 rounded">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form
                        action="{{ route('admin.course-sub-categories.update', [
                            'categoryId' => $categories->id,
                            'subCategoryId' => $subCategories->id,
                        ]) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-12">
                                <img src="{{ asset($subCategories->image) }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Image <span class="text-danger">* (width:38px, height:38px) 2MB
                                        Maximum</span></label>
                                <input type="file" name="image"
                                    class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') ?? $subCategories->name }}"
                                    placeholder="Enter Sub Category Name"
                                    class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror">
                                    <option @selected($subCategories->status === 1) value="1">Active</option>
                                    <option @selected($subCategories->status === 0) value="0">InActive</option>
                                </select>
                                @error('status')
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
