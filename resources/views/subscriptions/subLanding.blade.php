
@extends('layouts.layout')

@section('content')
@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
        <div class="bg-green-100 border border-green-400 text-center px-4 py-3 w-full rounded absolute">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
@endif
@if (session('Warning'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 7000)">
        <div class="bg-green-100 border border-green-400 text-center px-4 py-3 w-full rounded absolute">
            {{-- <strong class="font-bold">Success!</strong> --}}
            <span class="block sm:inline">{{ session('Warning') }}</span>
        </div>
    </div>
@endif


<div class= "w-1/2 mx-auto mt-20">
    <table class="table-fixed w-full border">
        <thead class="mb-6">
            <tr class="text-3xl">
                <th class="font-normal py-6">Category</th>
                <th class="font-normal py-6">Price</th>
                <th></th>
            </tr>
        </thead>
        <tbody >
            @foreach ($categories as $category)
                <tr>
                    <th class="font-normal py-2">{{ $category->cat_name }}</th>
                    <th class="text-orange-500 py-2">17.95$</th>
                    <th class=" py-2">  
                        @if ($user->categories()->where('category_id', $category->id)->exists())
                            <p class="text-black font-normal">Jūs esat abonējis šo kategoriju</p>
                        @else
                            <a href="{{ route('subscription.subscribe', $category->id) }}" class=" p-2 rounded-md bg-green-100 text-black font-normal">Abonēt kategoriju</a>
                        @endif
                    </th>
                </tr>
            
            @endforeach
        </tbody>
    </table>
</div>
    


@endsection
