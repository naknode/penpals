@extends('layouts.app')

@section('content')
<div class="container mx-auto wizard">
    <div class="flex flex-wrap justify-center">
        <div class="md:w-2/3 pr-4 pl-4">

            <h1 class="mb-3 title">You're human, right?</h1>
            <registration-wizard :step="1"></registration-wizard>

            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ __('validation.recaptcha') }}
                </div>
            @endif

            <div class="bg-grey-lighter rounded mb-5">
                <div class="flex-auto p-6">
                    <form method="POST" action="{{ route('post.register.robot') }}">
                        @csrf

                        <div class="mb-4 flex flex-wrap">
                            <div class="pr-4 pl-4 w-full flex justify-center">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>

                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="hidden mt-1 text-sm text-red">
                                        <strong>{{ __('validation.recaptcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="flex flex-wrap mb-0">
                            <div class="pr-4 pl-4 md:mx-1/3 flex justify-center w-full">
                                <button type="submit" class="btn btn-secondary">
                                    Beep boop, I am human.
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