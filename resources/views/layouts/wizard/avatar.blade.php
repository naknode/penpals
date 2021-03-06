@extends('layouts.app')

@section('content')
<div class="container mx-auto wizard">
    <div class="flex flex-wrap justify-center">
        <div class="md:w-2/3 px-4">

            <h1 class="mb-3 title text-center lg:text-left">Let's select your website avatar.</h1>
            <registration-wizard :step="2"></registration-wizard>

            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <div role="alert" class="alert alert-info">
                <strong>Where are the uploads?</strong> Here, we only see what you put out and write. Because in the end, what matters is how you connect and not what you look like. We are old-fashioned for a reason.
            </div>


            <div class="bg-grey-lighter rounded mb-5">
                <div class="flex-auto p-6">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('post.register.avatar') }}">
                        @csrf

                        <p class="text-center">Select an avatar to represent you.</p>

                        <div class="mb-4 flex flex-wrap">
                            -- Avatar gallery --
                        </div>

                        <div class="mb-4 flex flex-wrap mb-0">
                            <div class="pr-4 pl-4 md:mx-1/3 flex justify-center w-full">
                                <a href="{{ route('view.register.profile') }}" class="btn btn-link">Skip</a>
                                <button type="submit" class="btn btn-secondary">
                                    Continue
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection