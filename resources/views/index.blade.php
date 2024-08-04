@extends('master')



@section('content')
    <div class="container-fluid p-5 ">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h2>BLOG</h2>

                            <a href="{{ route('blogs.create') }}" class="btn btn-primary">


                                Add new blog
                            </a>
                        </div>


                    </div>

                    <div class="card-body">

                        <table id="tasks-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">User_id</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Images</th>

                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($blogs as $blog)
                                    <tr>

                                        <td class="text-center">{{ $blog->id }}</td>
                                        <td class="text-center">{{ $blog->name }}</td>

                                        <td class="text-center">{{ $blog->user_id }}</td>



                                        <td class="text-center">{{ $blog->description }}</td>

                                        <td class="text-center">
                                            @foreach ($blog->images as $image)
                                                <img src="{{ asset('storage/' . $image->image) }}" alt=""
                                                    style="width: 50px; height: auto;">
                                            @endforeach
                                        </td>
                                        <td class="text-center">
                                            <!-- Edit Button -->
                                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-info">
                                                Edit
                                            </a>
                                            |
                                            <!-- Delete Button -->
                                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
