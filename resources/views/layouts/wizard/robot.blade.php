@extends('layouts.app')

@section('content')
<div class="container wizard">
    <div class="row justify-content-center">
        <div class="col-md-8">

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

            <div class="bg-grey-lighter rounded">
                <div class="card-body">
                    <form method="POST" action="{{ route('post.register.robot') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>

                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="invalid-feedback">
                                        <strong>{{ __('validation.recaptcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary rounded">
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