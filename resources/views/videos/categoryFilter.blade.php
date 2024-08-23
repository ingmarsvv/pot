@extends('layouts.layout')

@section('content')
{{-- tailwind<h1>{{Virsraksts}}</h1> --}}
{{-- <div class="flex flex-row gap-x-4"> --}}
  <div class="grow h-screen">
    <h1 class="mx-auto text-center text-5xl font-sans">
      {{ $category->cat_name }}
    </h1>
    <div class="mx-auto max-w-7xl px-6 pb-6 lg:px-8">
      <div class="mx-auto mt-10 grid grid-cols-1 gap-x-12 gap-y-16 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
        @foreach($videos as $video)
        <article class="flex max-w-2xl flex-col items-start justify-between">
            <video class="w-full max-h-96 rounded-lg" controls="true" preload="auto" muted playsinline>
              <source src="{{ route('video.serve', basename($video->video_file)) }}" type="video/mp4">
              Your browser does not support the video tag.
            </video>
            <div class="group relative">
              <h3 class="mt-3 text-3xl font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                <a href="{{ route('video.show', $video) }}">
                  <span class="absolute inset-0"></span>
                  {{$video->title}}
                </a>
              </h3>
              <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{$video->description}}</p>
            </div>
            
          </article>
          
          {{-- {{ basename($video->video_file) }} --}}
        @endforeach
        <!-- More posts... -->
      </div>
    </div>
  </div>
{{-- </div> --}}
@endsection
