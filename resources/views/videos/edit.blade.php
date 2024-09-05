@extends('layouts.layout')

@section('content')
<header>
    <h2 class="text-2xl font-bold uppercase mb-6 text-center">Edit Video</h2>
    <p class="mb-4 text-center">Edit: {{ $video->title}}</p>
</header>
<form method="POST" action="{{ route('video.update', $video->id) }}" enctype="multipart/form-data" class="max-w-sm mx-auto my-10">
    @csrf
    @method('PUT')
    <div class="mb-5">
      <label for="title" class="block mb-2 text-l font-medium text-gray-900">Video title</label>
      <input type="text" name="title" value="{{ $video->title }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>     
      @error('title')
        <p class="text-red-500">{{$message}}</p>
      @enderror
    </div>
    <div class="mb-5">
      <label for="description" class="block mb-2 text-l font-medium text-gray-900">Description</label>
      <input type="text-area" name="description" value="{{ $video->description}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
      @error('description')
      <p class="text-red-500">{{$message}}</p>
      @enderror
    </div>
    <div class="mb-5">
      <label for="video_file" class="block mb-2 text-l font-medium text-gray-900">Add video</label>
      <input type="file" name="video_file" class="bg-gray-50 border border-gray-300 mb-2 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"/>
      <video class="mb-1 max-h-60 mx-auto" controls="true" preload="auto" muted playsinline>
        <source src="{{ route('video.serve', basename($video->video_file)) }}" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
    <div class="mb-5">
        <label for="categories" class="block  text-l font-medium text-gray-900">Categories</label>
        @foreach($belongToCategories as $belongToCategory)
                <span class="text-green-500 text-sm">{{ $belongToCategory->cat_name }}</span>
        @endforeach
        <select name="categories[]" id="categories" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" multiple>
            @foreach($categories as $category)

                <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                
            @endforeach
        </select>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Store</button>
    <a class="ml-2" href="{{ route('video.admin') }}">Back</a>
</form>

@endsection