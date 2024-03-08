@extends('layouts.dash')

@section('content')
<div class="mt-4">
    <h1 class="sr-only">Edit Event</h1>
    <div class="max-w-lg mx-auto">
        <form action="{{ route('organizer.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4" >
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                <input type="text" name="title" id="title" class="form-input w-full @error('title') border-red-500 @enderror" value="{{ $event->title }}">
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" class="form-textarea w-full @error('description') border-red-500 @enderror" rows="3">{{ $event->description }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                <input type="date" name="date" id="date" class="form-input w-full @error('date') border-red-500 @enderror" value="{{ $event->date }}">
                @error('date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="location" class="block text-gray-700 text-sm font-bold mb-2">Location</label>
                <input type="text" name="location" id="location" class="form-input w-full @error('location') border-red-500 @enderror" value="{{ $event->location }}">
                @error('location')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="availableSeats" class="block text-gray-700 text-sm font-bold mb-2">Available Seats</label>
                <input type="number" name="availableSeats" id="availableSeats" class="form-input w-full @error('availableSeats') border-red-500 @enderror" value="{{ $event->availableSeats }}">
                @error('availableSeats')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Reservation Method</label>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="reservationMethod" value="automatic" {{ $event->reservationMethod === 'automatic' ? 'checked' : '' }}>
                        <span class="ml-2">Automatic</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="reservationMethod" value="manual" {{ $event->reservationMethod === 'manual' ? 'checked' : '' }}>
                        <span class="ml-2">Manual</span>
                    </label>
                </div>
                @error('reservationMethod')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <select name="category_id" id="category" class="form-select w-full @error('category_id') border-red-500 @enderror">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $event->category_id === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <fieldset class="w-full space-y-1 dark:text-gray-100">
                    <label for="picture" class="block text-gray-700 text-sm font-bold mb-2">Event Picture</label>
                    <div class="flex">
                        <input name="image" id="picture" type="file" accept="image/*" class="px-8 py-12 border-2 border-dashed rounded-md dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800" onchange="displaySelectedPicture()">
                    </div>
                    <div id="preview" class="mt-2">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="w-40 h-40 object-cover rounded-md">
                        @endif
                    </div>
                </fieldset>
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
            </div>
        </form>
    </div>
</div>
<script>
    function displaySelectedPicture() {
        const preview = document.getElementById('preview');
        const fileInput = document.getElementById('picture');
        const files = fileInput.files;
        if (files.length > 0) {
            const file = files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('w-40', 'h-40', 'object-cover', 'rounded-md');
                preview.innerHTML = '';
                preview.appendChild(img);
            }
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    }
</script>
@endsection
