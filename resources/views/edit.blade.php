@extends('master')

@section('content')
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">
                        <h2>Edit Blog</h2>
                    </div>

                    <div class="card-body">
                        <form id="edit-blog-form" method="POST" action="{{ route('blogs.update', $blog->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" type="text" id="name" value="{{ old('name', $blog->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Enter name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Enter description">{{ old('description', $blog->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="images" class="form-label">Images</label>
                                    <input name="images[]" type="file" id="images"
                                        class="form-control @error('images') is-invalid @enderror" multiple>
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
