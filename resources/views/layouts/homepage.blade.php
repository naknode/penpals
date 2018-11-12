@extends('layouts.app')

@section('content')
<div class="py-8 px-4 bg-grey-lighter hero-bg rounded-none flex items-center justify-center flex-row-reverse">
	<img class="hidden md:block w-auto lg:w-1/2" src="{{ asset('svg/hangout.svg')}}" alt="Hangout" />
	<div>
		<h1 class="md:text-5xl text-white font-black text-2xl">
            Old fashioned friendships for the digital age.
        </h1>
		<p class="subtext text-white my-5 text-3xl">
            Exchange cultures. Learn languages. Create friendships.
        </p>
		<p>
			<a href="{{ route('register') }}" class="btn btn-primary hover:bg-yellow-dark" href="#" role="button">Get Started</a>
		</p>
	</div>
</div>

<div class="container mx-auto py-8">
    <div class="flex flex-wrap features">
        <div class="md:w-1/3 pr-4 pl-4">
            <h2 class="flex items-center uppercase">
                <span class="homepage-icon key">@svg('key', ['width' => '20', 'height' => '20'])</span>
                Free and always.
            </h2>
            <p class="my-3 text-justify text-grey-darker">We pride ourselves in never charging a dime for <em>all</em> of our wonderful features. No hidden fees; no cost. Find your penpals in less than a minute after!</p>
        </div>
        <div class="md:w-1/3 pr-4 pl-4">
            <h2 class="flex items-center uppercase">
                <span class="homepage-icon code">@svg('code', ['width' => '20', 'height' => '20'])</span>
                Cloud Technology.
            </h2>
            <p class="my-3 text-justify text-grey-darker">We utilize high-calibre cloud technology to keep your account safe from spam &amp; harmful content while also using it to improve user experience.</p>
        </div>
        <div class="md:w-1/3 pr-4 pl-4">
            <h2 class="flex items-center uppercase">
                <span class="homepage-icon road">@svg('road', ['width' => '20', 'height' => '20'])</span>
                Aväntˈ gärd.
            </h2>
            <p class="my-3 text-justify text-grey-darker">We are next-generation for a reason. We stand out by trying unique experiences in the UI to fix the problems that have plagued other sites for years.</p>
        </div>
    </div>
    <div class="flex flex-wrap features">
        <div class="md:w-1/3 pr-4 pl-4">
            <h2 class="flex items-center uppercase">
                <span class="homepage-icon photo-album">@svg('photo-album', ['width' => '20', 'height' => '20'])</span>
                No photos.
            </h2>
            <p class="my-3 text-justify text-grey-darker">You cannot upload any photos. Back in the day, it was all about the <em>self</em> rather than the <em>selfie</em>. You can always share photos via email or other mediums.</p>
        </div>
        <div class="md:w-1/3 pr-4 pl-4">
            <h2 class="flex items-center uppercase">
                <span class="homepage-icon lock">@svg('lock', ['width' => '20', 'height' => '20'])</span>
                Privacy-locked.
            </h2>
            <p class="my-3 text-justify text-grey-darker">Lock down your profile to very specific set of criteria. That way, you can only choose to interact with who you want to without hassle.</p>
        </div>
        <div class="md:w-1/3 pr-4 pl-4">
            <h2 class="flex items-center uppercase">
                <span class="homepage-icon bubble-question">@svg('bubble-question', ['width' => '20', 'height' => '20'])</span>
                Feedback driven.
            </h2>
            <p class="my-3 text-justify text-grey-darker">What better way to improve the user experience than by those who use it. We listen to the community and implement ideas and feedback.</p>
        </div>
    </div>
</div>
@endsection