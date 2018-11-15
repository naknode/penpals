@extends('layouts.app')

@section('content')
<div class="container mx-auto wizard">
    <div class="flex flex-wrap justify-center">
        <div class="md:w-2/3 pr-4 pl-4">

            <h1 class="mb-3 title">Create your account</h1>
            <registration-wizard :step="0"></registration-wizard>
            <div class="bg-grey-lighter rounded">
                <div class="flex-auto p-6 mb-6">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4 flex flex-wrap">
                            <label for="name" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">Username</label>

                            <div class="md:w-1/2 pr-4 pl-4">
                                <input id="name" type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded {{ $errors->has('username') ? ' bg-red-dark' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="hidden mt-1 text-sm text-red">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4 flex flex-wrap">
                            <label for="email" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="md:w-1/2 pr-4 pl-4">
                                <input id="email" type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded{{ $errors->has('email') ? ' bg-red-dark' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="hidden mt-1 text-sm text-red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4 flex flex-wrap">
                            <label for="password" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal text-md-right">{{ __('Password') }}</label>

                            <div class="md:w-1/2 pr-4 pl-4">
                                <input id="password" type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded{{ $errors->has('password') ? ' bg-red-dark' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="hidden mt-1 text-sm text-red">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-4 flex flex-wrap mb-0">
                            <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                                <button type="submit" class="btn btn-primary hover:bg-yellow-light rounded">
                                    {{ __('Register') }}
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
