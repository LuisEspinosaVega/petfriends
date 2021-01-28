@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-end mt-3">
            <div class="col-auto text-center">
                <a class="btn btn-primary" href="/profile/{{ Auth::user()->username }}">Crear publicación</a>
            </div>
        </div>

        <div class="row justify-content-center mt-2">
            @foreach ($posts as $post)
                <div class="col-10 col-md-8 mt-4"
                    style="-webkit-box-shadow: 0px 10px 13px -7px #000000, -18px 11px 11px 7px rgba(10,10,9,0.41);
                                                                                                                                                                                                        box-shadow: 0px 10px 13px -7px #000000, -18px 11px 11px 7px rgba(10,10,9,0.41);">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center text-md-left">
                            @if ($post->user->image)
                                <img src="{{ asset('storage/' . $post->user->image) }}"
                                    class="rounded-circle border border-dark" width="50px" height="50px" alt="">
                            @else
                                <img src="{{ asset('storage/users/user-default.png') }}"
                                    class="rounded-circle border border-dark" width="50px" height="50px" alt="">
                            @endif
                            <a href="/profile/{{ $post->user->username }}"><b>{{ $post->user->name }}</b></a>
                        </div>
                        <div class="col-10 col-md-8 text-center">

                            {{ $post->title }} <br>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid"
                                    style="max-height: 250px;" alt="">
                            @else
                                <img src="{{ asset('storage/posts/no-image-post.png') }}" class="img-fluid"
                                    style="max-height: 250px;" alt="">
                            @endif
                        </div>
                        <div class="col-12 text-left mt-1">
                            {{ $post->content }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-12 text-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
