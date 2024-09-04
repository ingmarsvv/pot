
@extends('layouts.layout')

@section('content')

<script src="{{ asset('/js/functions.js') }}"></script>

@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        <div class="bg-green-100 border border-green-400 text-center px-4 py-3 w-full rounded absolute">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
@endif
@if (session('info'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        <div class="bg-green-100 border border-green-400 text-center px-4 py-3 w-full rounded absolute">
            {{-- <strong class="font-bold">Success!</strong> --}}
            <span class="block sm:inline">{{ session('info') }}</span>
        </div>
    </div>
@endif

<div class="text-center mt-14">
    <h1 class="text-6xl font-extrabold tracking-tight text-[#2E3440] sm:text-5xl">
        This is all you need.
    </h1>
    <p class="mx-auto mt-3 max-w-md text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">This is a subscription page, once you subscribe to the specific category you can view all of its content.</p>
    <div class="mx-auto mt-5 flex max-w-md flex-col gap-y-3 gap-x-6 sm:flex-row sm:justify-center md:mt-8">
        
    </div>
  </div>

<div class="my-16 mx-auto w-5/6 lg:max-w-screen-lg">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8" x-data="highlightOnLoad()">
        @foreach ($categories as $category)
            <article class="flex flex-col" >
                <div><img src="{{ $category->image}}" alt="" ></div>
                <div> <a class="text-2xl font-extrabold" href="{{ route('category.filter', $category->cat_name)}}">{{ $category->cat_name}}</a></div>
                <div>{{ $category->description}}</div>
                @isSubscribed($category->id)
                <div class="bg-slate-400 flex w-full items-center justify-center rounded border border-transparent px-8 py-2.5 font-medium text-white transition-colors sm:w-auto">Subscribed</div>
                @else
                <div><a href="{{ route('subscription.subscribe', $category->id)}}" id="{{ $category->id }}" class="bg-cyan-600 hover:bg-cyan-700 flex w-full items-center justify-center rounded border border-transparent px-8 py-2.5 font-medium text-white transition-colors sm:w-auto">Subscribe for 4.95$</a></div>
                @endisSubscribed
            </article>
        @endforeach
         
    </div>
</div>




@endsection
