@extends('master')



@section('content')
    <div class="container-fluid p-5 ">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">

                        <h2>Create a new blog</h2>




                    </div>

                    <div class="card-body">
                        <form id="create-blog-form" class="modal-content" method="POST" action="{{ route('blogs.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="user_id" value="{{ $user_id }}">

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" type="text" id="name"
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
                                        placeholder="Enter description"></textarea>
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
    </div>
@endsection
