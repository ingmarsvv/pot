@extends('layouts.layout')

@section('content')

<script src="{{ asset('/js/functions.js') }}"></script>

<div class="flex flex-row gap-x-2">
  <ul class="w-1/6 bg-orange-50 flex flex-col gap-3">
          <li class="bg-green-300 px-3 rounded-xl mt-3"><a href="{{ route('video.create')}}">Add new video</a></li>
          <li class="bg-green-300 px-3 rounded-xl"><a href="{{ route('category.create')}}">Add new category</a></li>
  </ul>
  <div class="grow bg-slate-200">
    <div class="flex justify-between mt-3">
      <div>
      </div>
      <ul class="flex gap-2" x-data="highlightCategory()">
          <li>Filter:</li>
        @foreach ($categories as $category)
          <li id="{{ $category->cat_name }}" class="flex items-center justify-center bg-black text-white px-3 rounded-xl "><a href="/admin?category={{ $category->cat_name }}">{{ $category->cat_name }}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="mx-auto max-w-7xl px-6 pb-6 lg:px-8">
      <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @foreach($videos as $video)
        <article class="flex max-w-xl flex-col items-start justify-between">
          <video class="mb-1 max-h-60 mx-auto" controls="true" preload="auto" muted playsinline>
            <source src="{{ route('video.serve', basename($video->video_file)) }}" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          <div class="group relative">
            <h3 class="mt-1 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
              <a href="{{ route('video.show', $video) }}">
                <span class="absolute inset-0"></span>
                {{$video->title}}
              </a>
            </h3>
            <p class="mt-2 line-clamp-3 text-sm leading-6 text-gray-600">{{$video->description}}</p>
          </div>
          <div>
            <div class="bg-red-400 p-2 w-20 max-w-20 inline-block text-center rounded-lg">
              <form method="post" action="{{ route('video.destroy', $video)}}">
                @csrf
                @method('DELETE')
                <button>Delete</button>
              </form>
            </div> 
            <div class="inline-block ml-3 w-20 max-w-20 p-2 bg-yellow-400 text-center rounded-lg">
              <a href="{{ route('video.edit', $video->id)}}">Edit</a>
            </div>
          </div>
        </article>
          
          {{-- {{ basename($video->video_file) }} --}}
        @endforeach
        <!-- More posts... -->
      </div>
    </div>
  </div>
</div>
@endsection
