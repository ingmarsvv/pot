@extends('layouts.layout')

@section('content')

<div class="bg-slate-200 py-24 sm:py-32">
  <div class="bg-green-400 p-2 w-20 max-w-20">
  </div>
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        <article class="flex max-w-xl flex-col items-start justify-between">
            <div class="group relative">
              <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                <a href="#">
                  <span class="absolute inset-0"></span>
                  {{ $video->title }}
                </a>
              </h3>
              <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{ $video->description }}</p>
            </div>
            <video width="600" controls="true" muted playsinline>
              <source src="{{ route('video.serve', basename($video->video_file)) }}" type="video/mp4">
              Your browser does not support the video tag.
            </video>
          </article>
        <!-- More posts... -->
      </div>
    </div>
  </div>

@endsection