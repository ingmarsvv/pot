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
    <div class="bg-green-400 p-2 w-20 max-w-20">
      <a href="{{ route('video.create')}}">Add new video</a>
    </div>
    <div class="mx-auto max-w-7xl px-6 pb-6 lg:px-8">
      
    </div>
  </div>
</div>
@endsection
