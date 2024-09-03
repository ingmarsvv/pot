@extends('layouts.layout')

@section('content')

<div x-data="{            
  slides: [
    @foreach ($categories as $category)              
      {
          imgSrc: '{{ $category->image }}',
          imgAlt: 'Vibrant abstract painting with swirling blue and light pink hues on a canvas.',  
          title: '{{ $category->cat_name}}',
          description: '{{ $category->description}}',    
          ctaUrl: '{{ route('category.filter', $category->cat_name)}}',
          ctaText: 'Uzzini vairāk',          
      }, 
      @endforeach               
           
  ],            
  currentSlideIndex: 1,
  // Initialize the auto slide feature
  init() {
    this.startAutoSlide();
  },

  startAutoSlide() {
    setInterval(() => {
      this.next();
    }, 3000);  // Change slide every 3 seconds
  },
  previous() {                
      if (this.currentSlideIndex > 1) {                    
          this.currentSlideIndex = this.currentSlideIndex - 1                
      } else {   
          // If it's the first slide, go to the last slide           
          this.currentSlideIndex = this.slides.length                
      }            
  },            
  next() {                
      if (this.currentSlideIndex < this.slides.length) {                    
          this.currentSlideIndex = this.currentSlideIndex + 1                
      } else {                 
          // If it's the last slide, go to the first slide    
          this.currentSlideIndex = 1                
      }            
  },        
}" class="relative w-full overflow-hidden">

  <!-- previous button -->
  <button type="button" class="absolute left-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-neutral-600 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:outline-offset-0 dark:bg-neutral-950/40 dark:text-neutral-300 dark:hover:bg-neutral-950/60 dark:focus-visible:outline-white" aria-label="previous slide" x-on:click="previous()">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="3" class="size-5 md:size-6 pr-0.5" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
      </svg>
  </button>

  <!-- next button -->
  <button type="button" class="absolute right-5 top-1/2 z-20 flex rounded-full -translate-y-1/2 items-center justify-center bg-white/40 p-2 text-neutral-600 transition hover:bg-white/60 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:outline-offset-0 dark:bg-neutral-950/40 dark:text-neutral-300 dark:hover:bg-neutral-950/60 dark:focus-visible:outline-white" aria-label="next slide" x-on:click="next()">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="3" class="size-5 md:size-6 pl-0.5" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
      </svg>
  </button>
 
  <!-- slides -->
  <!-- Change min-h-[50svh] to your preferred height size -->
  <div class="relative min-h-[94.4svh] w-full">
      <template x-for="(slide, index) in slides">
          <div x-cloak x-show="currentSlideIndex == index + 1" class="absolute inset-0" x-transition.opacity.duration.1000ms>
              
              <!-- Title and description -->
              <div class="lg:px-32 lg:py-14 absolute inset-0 z-10 flex flex-col items-center justify-end gap-2 bg-gradient-to-t from-neutral-950/85 to-transparent px-16 py-12 text-center">
                  <h3 class="w-full lg:w-[80%] text-balance text-2xl lg:text-7xl uppercase font-bold text-white" x-text="slide.title" x-bind:aria-describedby="'slide' + (index + 1) + 'Description'"></h3>
                  <p class="lg:w-1/2 w-full text-pretty text-lg text-neutral-300" x-text="slide.description" x-bind:id="'slide' + (index + 1) + 'Description'"></p>
                  <button type="button" x-cloak x-show="slide.ctaUrl !== null" x-on:click="location.href = slide.ctaUrl" class="mt-2 mb-6 cursor-pointer whitespace-nowrap rounded-md border border-white bg-transparent px-4 py-2 text-center text-xs font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-onSurfaceDarkStrong active:opacity-100 active:outline-offset-0 md:text-xl" x-text="slide.ctaText"></button>
              </div>

              <img class="absolute w-full h-full inset-0 object-cover text-neutral-600 dark:text-neutral-300" x-bind:src="slide.imgSrc" x-bind:alt="slide.imgAlt" />
          </div>
      </template>
  </div>
  
  <!-- indicators -->
  <div class="absolute rounded-md bottom-3 md:bottom-5 left-1/2 z-20 flex -translate-x-1/2 gap-4 md:gap-3 px-1.5 py-1 md:px-2" role="group" aria-label="slides" >
      <template x-for="(slide, index) in slides">
          <button class="size-2 cursor-pointer rounded-full transition" x-on:click="currentSlideIndex = index + 1" x-bind:class="[currentSlideIndex === index + 1 ? 'bg-neutral-300' : 'bg-neutral-300/50']" x-bind:aria-label="'slide ' + (index + 1)"></button>
      </template>
  </div>
</div>

@endsection
