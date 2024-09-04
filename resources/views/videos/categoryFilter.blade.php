@extends('layouts.layout')

@section('content')
  <div class="grow ">
    <h1 class="mx-auto text-center font-extrabold tracking-tight text-[#2E3440] text-4xl sm:text-9xl">
      {{ $category->cat_name }}
    </h1>
    @isSubscribed($category->id)
      <div class="text-center mt-14">
        <h1 class="text-6xl font-extrabold tracking-tight text-[#2E3440] sm:text-5xl">
            Explore.
        </h1>
        <p class="mx-auto mt-3 max-w-md text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">You have subscribed to this category. Enjoy!</p>
        
      </div>
    @else
    <div class="text-center mt-14">
      <h1 class="text-6xl font-extrabold tracking-tight text-[#2E3440] sm:text-5xl">
          Do amazing things.
      </h1>
      <p class="mx-auto mt-3 max-w-md text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">We've done the hard work, so you can just copy and paste them into your life and spend less time re-inventing the wheel. You get one for free.</p>
      <div class="mx-auto mt-5 flex max-w-md flex-col gap-y-3 gap-x-6 sm:flex-row sm:justify-center md:mt-8">
          <a href="#components" class="flex w-full items-center justify-center rounded border border-transparent bg-[#EFF3F4] px-8 py-2.5 font-medium text-gray-800 transition-colors hover:bg-[#dfe4e6] sm:w-auto">Learn more</a>
          <a href="{{ route('subscription.index', ['category' => $category->id])}}" class="bg-cyan-600 hover:bg-cyan-700 flex w-full items-center justify-center rounded border border-transparent px-8 py-2.5 font-medium text-white transition-colors sm:w-auto">Get access</a>
      </div>
    </div>
    @endisSubscribed
    <div class="mx-auto max-w-7xl px-6 pb-6 lg:px-8">
      <div class="mx-auto mt-10 grid grid-cols-1 gap-x-12 gap-y-16 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-2">
        {{-- Show first video without limits --}}
        @if(isset($videos[0]))
          <article class="flex max-w-2xl flex-col items-start justify-between">
            <video class="w-full max-h-96 rounded-lg" controls="true" preload="auto" playsinline>
              <source src="{{ route('video.serve', basename($videos[0]->video_file)) }}" type="video/mp4">
              Your browser does not support the video tag.
            </video>
            <div class="group relative">
              <h3 class="mt-3 text-3xl font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                <a href="{{ route('video.show', $videos[0]) }}">
                  <span class="absolute inset-0"></span>
                  {{$videos[0]->title}}
                </a>
              </h3>
              <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">{{$videos[0]->description}}</p>
            </div>
          </article>
        @endif
        {{-- All other video depends on subscription --}}
        @php 
          $isFirst = true;
          $user=Auth::user(); 
          $categoryID=$category->id;
        @endphp
        @foreach($videos as $video)
          @if ($isFirst == true)
            @php $isFirst = false; @endphp
          @else
            @isSubscribed($categoryID)
              <article class="flex max-w-2xl flex-col justify-between">
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
                  <p class="mt-5 text-sm leading-6 text-gray-600">{{$video->description}}</p>
                </div>
              </article>
            @else
              <article class="flex max-w-2xl flex-col justify-between">
                <img source src="/images/play-button.png" class="max-w-80 mx-auto rounded-lg">
                <div class="group relative">
                  <h3 class="mt-3 text-3xl font-semibold leading-6 text-gray-900 group-hover:text-gray-600">                 
                    <span class="absolute inset-0"></span>
                    {{$video->title}}
                  </h3>
                  <p class="mt-5 text-sm leading-6 text-gray-600">{{$video->description}}</p>
                </div>
              </article>             
            @endisSubscribed                
          @endif
        @endforeach

      </div>
    </div>
  </div>
@endsection
