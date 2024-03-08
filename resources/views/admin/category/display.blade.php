@extends('layouts.dash')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Manage Categories</div>

                    <div class="card-body">
                        <h4>Categories</h4>
                        <ul>
                            @foreach($categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>

                        <h4>Create Category</h4>
                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>

                        <h4>Update Category</h4>
                        <form method="POST" action="{{ route('categories.update', $categoryToUpdate) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="update_name">New Category Name</label>
                                <input type="text" class="form-control" id="update_name" name="name">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                        <h4>Delete Category</h4>
                        <form method="POST" action="{{ route('categories.destroy', $categoryToDelete) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
