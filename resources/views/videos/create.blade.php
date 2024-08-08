@extends('layout')
@section('content')
@php
   
@endphp
<form method="POST" action="{{ route('video.store') }}" enctype="multipart/form-data" class="max-w-sm mx-auto mt-10">
    @csrf
    <div class="mb-5">
      <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Video title</label>
      <input type="text" name="title" value="{{ old('title') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>     
      @error('title')
        <p class="text-red-500">{{$message}}</p>
      @enderror
    </div>
    <div class="mb-5">
      <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
      <input type="text-area" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
      @error('description')
      <p class="text-red-500">{{$message}}</p>
      @enderror
    </div>
    <div class="mb-5">
      <label for="video_file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add video</label>
      <input type="file" name="video_file" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
      @error('video_file')
      <p class="text-red-500">{{$message}}</p>
      @enderror
    </div>
    <div class="mb-5">
      <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories</label>
        <select name="categories[]" id="categories" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" multiple>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
            @endforeach
        </select>
      </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Store</button>
  </form>





@endsection