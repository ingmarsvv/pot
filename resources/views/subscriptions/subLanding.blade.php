
@extends('layouts.layout')

@section('content')

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
