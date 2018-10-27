@extends('layouts.app')

@section('content')
<div class="container wizard">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1 class="mb-3 title">Let's start your profile.</h1>
            <registration-wizard :step="3"></registration-wizard>

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
                    <form method="POST" enctype="multipart/form-data" action="{{ route('post.register.profile') }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12">
                                <h3 class="mb-3 mt-0 pt-0 title">Biography</h3>
                                <textarea required name="biography" class="form-control resize-none"  id="" rows="5" placeholder="I like long walks on the beach, my favorite movie is Star Wars and I love to..."></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <wizard-add-language></wizard-add-language>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary rounded">
                                    Let's meet some people!
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