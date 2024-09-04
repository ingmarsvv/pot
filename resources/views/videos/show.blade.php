@extends('layouts.layout')

@section('content')
  <div class="mx-auto px-6 pb-6 lg:px-8">
    <div class="mx-auto mt-10 grid grid-cols-1 gap-x-12 gap-y-16 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-full lg:grid-cols-2">
      <article class="flex flex-col items-start justify-between w-full">
          <video class="w-full rounded-lg" controls="true" preload="auto" muted playsinline>
            <source src="{{ route('video.serve', basename($video->video_file)) }}" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          <div class="w-full">
            <div class="flex flex-row gap-5 w-full">
              <div class="w-full">
                <h3 class="mt-3 text-3xl font-semibold text-gray-900">           
                  {{$video->title}}
                </h3>
              </div> 
              <div class="">
                <form action="{{ route('video.storeLike', $video) }}" method="POST">
                  @csrf
                  <button type="submit" class="mt-3 w-28 text-grey-700 border border-grey-700 hover:bg-stone-200  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500">
                    <svg class="w-5 h-5" aria-hidden="true"  fill="currentColor" viewBox="0 0 18 18">
                    <path d="M3 7H1a1 1 0 0 0-1 1v8a2 2 0 0 0 4 0V8a1 1 0 0 0-1-1Zm12.954 0H12l1.558-4.5a1.778 1.778 0 0 0-3.331-1.06A24.859 24.859 0 0 1 6 6.8v9.586h.114C8.223 16.969 11.015 18 13.6 18c1.4 0 1.592-.526 1.88-1.317l2.354-7A2 2 0 0 0 15.954 7Z"/>
                    </svg>
                    @php
                      use App\Http\Controllers\LikeController;
                       (int) $likeCount = LikeController::countLikes($video); 
                    @endphp
                    <p class="ml-2 w-full text-center" > {{ 3 + $likeCount }} likes</p>
                  </button>
                </form>
                
              </div>
            </div>
            <p class="mt-5 text-sm text-justify leading-6 text-gray-600">{{$video->description}}</p>
          </div>
        </article>
        <div>
          <div class="flex justify-between items-center mb-6">
            <h2 class="text-base lg:text-2xl text-gray-900 dark:text-white">Leave a comment</h2>
          </div>
          <form class="mb-6" method="POST" action="{{ route('comment.store', $video->id) }}" >
            @csrf
              <div class="py-2 px-4 mb-4 w-3/4 lg:max-w-2xl bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                  <label for="comment" class="sr-only">Your comment</label>
                  <textarea rows="2" id="comment" name="comment" class=" w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800" placeholder="Pievienojiet komentāru..."
                  ></textarea>
                  @error('comment')
                  <p class="text-red-500">Aizpildiet šo lauku</p>
                  @enderror
              </div>
              <button type="submit"
                  class="inline-flex items-center py-2.5 px-4 text-s font-medium text-center text-black bg-stone-200 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-stone-400">
                  Post comment
              </button>
          </form>
          @foreach ($comments as $comment)
          <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900">
            <footer class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">{{ $comment->user->name }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mr-3">{{ $comment->created_at}}</p>
                    @commentAuthor($comment->user_id)
                    <form method="post" action="{{ route('comment.destroy', $comment)}}">
                      @csrf
                      @method('DELETE')
                      <button class="text-sm text-gray-600 dark:text-gray-400 p-1 rounded-lg hover:bg-stone-200">Delete comment</button>
                    </form>
                    @endcommentAuthor
                </div>
            </footer>
            <p class="text-gray-500 dark:text-gray-400">{{ $comment->text}}</p>
          </article>
          @endforeach
        </div>
        
    </div>
  </div>
@endsection