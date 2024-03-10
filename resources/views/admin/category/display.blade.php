@extends('layouts.dash')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Manage Categories</div>

                    <div class="card-body">
                        <h4>Categories</h4>
                        <button type="button" class="px-8 py-3 font-semibold rounded bg-violet-400 dark:text-gray-800" onclick="showCreateModal()">Create Category</button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr data-id="{{ $category->id }}">
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="populateUpdateModal({{ $category->toJson() }})">
                                                Update
                                            </button>

                                            <form style="display: inline-block;" method="POST" action="{{ route('admin.categories.destroy', $category->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="fixed z-10 inset-0 overflow-y-auto" id="updateModal" style="display: none;">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
    
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Update Category</h3>
                            <div class="mt-2">
                                <form id="updateForm">
                                    <div class="form-group">
                                        <label for="update_name" class="block text-sm font-medium text-gray-700">New Category Name</label>
                                        <input type="text" class="mt-1 p-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" id="update_name" name="name">
                                    </div>
                                    <button type="button" class="mt-4 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" onclick="updateCategory()">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed z-10 inset-0 overflow-y-auto" id="createModal" style="display: none;">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10"></div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Create Category</h3>
                            <div class="mt-2">
                                <form id="createCategoryForm" method="POST" action="{{ route('admin.categories.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="create_name" class="block text-sm font-medium text-gray-700">Category Name</label>
                                        <input type="text" class="mt-1 p-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm" id="create_name" name="name">
                                    </div>
                                    <button type="submit" class="mt-4 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function showCreateModal() {
            $('#createModal').show();
        }

        function hideCreateModal() {
            $('#createModal').hide();
        }

        var selectedCategory;

        function populateUpdateModal(category) {
            selectedCategory = category;
            $('#update_name').val(category.name);
            $('#updateModal').show(); 
            console.log(category);
        }

        function updateCategory() {
            var newName = $('#update_name').val();

            $.ajax({
                url: '/admin/categories/' + selectedCategory.id,
                type: 'PUT',
                data: {
                    name: newName,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Update success:', response);
                    $('#updateModal').hide();
                    $('td:eq(1)', $('tr[data-id="' + selectedCategory.id + '"]')).text(newName);
                },
                error: function(xhr) {
                    console.error('Update error:', xhr.responseText);
                }
            });
        }
    </script>
@endsection
