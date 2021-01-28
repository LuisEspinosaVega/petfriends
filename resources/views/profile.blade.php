@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3" id="crear-post">
            <div class="col-6" id="user-data">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 text-center text-md-right">
                        @if ($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" class="img-fluid rounded-circle"
                                style="height: 200px; widht: 200px;" alt="">
                        @else
                            <img src="{{ asset('storage/users/user-default.png') }}" class="img-fluid rounded"
                                style="height: 200px; widht: 200px;" alt="">
                        @endif
                    </div>
                    <div class="col-12 col-md-6 text-center align-self-center mt-2 mt-md-0">
                        <b>{{ $user->username }}</b>
                        @if ($user->id != Auth::user()->id)
                            <button class="btn btn-sm" data-userid="{{ $user->id }}" data-follows="{{ $follows }}"
                                id="btnFollow"></button>
                            <button class="btn btn-dark btn-sm" data-toggle="modal" data-idto="{{ $user->id }}"
                                data-target="#modalMessage" id="btnMensaje">Mensaje</button>
                        @endif
                        <div class="row justify-content-center mt-2">
                            <div class="col-auto text-center">
                                <b>{{ $user->posts->count() }}</b> Post <b>{{ $user->profile->followers->count() }}</b>
                                Seguidores
                                <b>{{ $user->following->count() }}</b> Seguidos
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($user->id == Auth::user()->id)
                <div class="col-6 " id="post-data" style="overflow: hidden;">
                    <form action="/post" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row form-group">
                            <label for="title"
                                class="col-12 col-md-4 text-center text-md-right font-weight-bold">Titulo</label>
                            <div class="col-12 col-md-7">
                                <input id="title" type="text"
                                    class="form-control form-control-sm @error('title') is-invalid @enderror" name="title"
                                    value="{{ old('title') }}" autocomplete="title">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="content"
                                class="col-12 col-md-4 text-center text-md-right font-weight-bold">Contenido</label>
                            <div class="col-12 col-md-7">
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                                    autocomplete="content" rows="2">{{ old('content') }}</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image"
                                class="col-12 col-md-4 col-form-label text-center text-md-right font-weight-bold">Imagen</label>
                            <div class="col-12 col-md-6">
                                <input type="file" name="image" id="image" accept="image/*">
                            </div>
                            @if ($errors->has('image'))
                                <div class="col-12 text-center text-danger"><b>{{ $errors->first('image') }}</b></div>
                            @endif
                        </div>

                        <div class="form-group justify-content-center row">
                            <div class="col-auto text-center">
                                <button type="submit" class="btn btn-primary">Publicar</button>
                            </div>
                        </div>

                    </form>
                </div>
            @endif
        </div>
        <div class="row justify-content-center mt-1 rounded" id="ver-posts">
            @foreach ($user->posts as $post)
                <div class="col-10 col-md-8 mt-4"
                    style="-webkit-box-shadow: 0px 10px 13px -7px #000000, -18px 11px 11px 7px rgba(10,10,9,0.41);"
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
                @if ($post->user->id == Auth::user()->id)
                    <div class="col-auto text-center align-self-center">
                        <a href="/post/{{ $post->id }}" class="btn btn-info">Detalle»</a>
                    </div>
                @endif

                {{-- @if ($user->id == Auth::user()->id)
                    <div class="col-2 text-center align-self-center">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                            data-idedit="{{ $post->id }}" data-target="#modalEdit">Editar</button>
                        <button type="button" class="btn btn-sm btn-danger mt-3 mt-md-0" data-toggle="modal"
                            data-iddel="{{ $post->id }}" data-target="#modalDelete">Eliminar</button>
                    </div>
                @endif --}}

            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="background-color:rgb(114,92,54,.4);">
                    <form action="" method="post" id="messageForm">
                        @csrf
                        <input type="hidden" name="id_to" id="id_to">
                        <div class="row justify-content center mt-2">
                            <div class="col-12 text-center">
                                <textarea name="message_content" id="message_content" rows="3" class="form-control"
                                    required></textarea>
                            </div>
                            <div class="col-12 text-center mt-3">
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary btn-sm" id="btnSend">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('js/follow.js') }}" defer></script>
@endpush
