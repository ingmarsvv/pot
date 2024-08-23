@extends('layouts.layout')

@section('content')
{{-- tailwind<h1>{{Virsraksts}}</h1> --}}
<div class="flex flex-row gap-x-2">
  <div class="w-1/6 bg-orange-50">
    <div class="mx-4">
      <div class="text-xl mb-3">Select your category</div>
      <div>
        <ul>
          @foreach($categories as $category)
          <li>
            <a href="{{ route('category.filter', $category->id) }}">{{ $category->cat_name }}</a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>

  </div>
  <div class="grow bg-slate-200">
    <div>
      <div class="bg-green-400 p-2 w-20 max-w-20 inline-block rounded-lg">
      <a href="{{ route('video.create')}}">Add new video</a>
    </div>
      <div class="bg-green-400 p-2 w-20 max-w-20 mt-3 inline-block rounded-lg">
        <a href="{{ route('category.create')}}">Add new category</a>
    </div>
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
