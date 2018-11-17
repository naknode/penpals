@extends('layouts.app')

@section('content')
<div class="container mx-auto wizard">
    <div class="flex flex-wrap justify-center">
        <div class="md:w-2/3 pr-4 pl-4">
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

            <div class="bg-grey-lighter rounded mb-5">
                <div class="flex-auto p-6">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('post.register.profile') }}">
                        @csrf

                        <div class="mb-4 flex flex-wrap">
                            <div class="md:w-full pr-4 pl-4">
                                <h3 class="mb-3 mt-0 pt-0 title">Biography</h3>
                                <textarea required name="biography" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-grey-darker border border-grey rounded resize-none"  id="" rows="5" placeholder="I like long walks on the beach, my favorite movie is Star Wars and I love to..."></textarea>
                            </div>
                        </div>

                        <div class="mb-4 flex flex-wrap">
                            <div class="md:w-full pr-4 pl-4">
                                <manage-language type="learning" />
                            </div>
                        </div>

                        <div class="mb-4 flex flex-wrap">
                            <div class="md:w-full pr-4 pl-4">
                                <manage-language type="speaks" />
                            </div>
                        </div>

                        <div class="mb-4 flex flex-wrap mb-0">
                            <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                                <button type="submit" class="btn btn-secondary">
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