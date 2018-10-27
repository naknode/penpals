@extends('layouts.app')

@section('content')
<div class="container wizard">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="mb-3 title">Let's get a good profile photo.</h1>
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

            <div class="bg-grey-lighter rounded">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('post.register.photo') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6 avatar-form">
                                <img src="{{ auth()->user()->avatar_path }}" alt="Avatar" class="user-avatar">
                                <input type="file" name="avatar" class="mt-4" />
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('view.register.profile') }}" class="btn btn-link">Skip</a>
                                <button type="submit" class="btn btn-primary rounded">
                                    This looks good. Here's my photo!
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