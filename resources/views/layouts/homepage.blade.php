@extends('layouts.app')

@section('content')
<div class="py-8 px-4 bg-grey-lighter hero-bg rounded-none">
  <h1 class="lg:w-1/2 md:text-5xl text-white font-black sm:text-2xl">
      Next-generation internet penpal website for everyone.
  </h1>
  <p class="subtext text-white my-5 text-3xl lg:w-1/2">
      Exchange cultures. Learn languages. Create friendships.
  </p>
  <p>
      <a href="{{ route('register') }}" class="btn btn-primary hover:bg-yellow-dark" href="#" role="button">Get Started</a>
  </p>
</div>

<div class="container mx-auto py-8">
  <div class="flex flex-wrap features">
      <div class="md:w-1/3 pr-4 pl-4">
          <h2 class="flex items-center uppercase">@svg('key', 'homepage-icon mr-3') Free and always.</h2>
          <p class="my-3 text-justify text-grey-darker">We pride ourselves in never charging a dime for <em>all</em> of our wonderful features. No hidden fees, no cost. Just sign up and get to writing!</p>
      </div>
      <div class="md:w-1/3 pr-4 pl-4">
          <h2 class="flex items-center uppercase">@svg('code', 'homepage-icon mr-3') Cloud  Technology.</h2>
          <p class="my-3 text-justify text-grey-darker">We utilize high-calibre cloud technology to keep your account safe from spam &amp; harmful content while also using it to improve user experience.</p>
      </div>
      <div class="md:w-1/3 pr-4 pl-4">
          <h2 class="flex items-center uppercase">@svg('road', 'homepage-icon mr-3') Aväntˈ gärd.</h2>
          <p class="my-3 text-justify text-grey-darker">We are next-generation for a reason. We stand out by trying unique experiences in the UI to fix the problems that have plagued other sites for years.</p>
      </div>
  </div>
</div>
@endsection