@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Detalles del post <b>{{ $post->title }}</b> </h1>
        <form action="{{ route('post.edit') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <input type="hidden" name="id_edit" id="id_edit" value="{{ $post->id }}">
            <div class="row justify-content-center mt-5">
                <div class="col-12 col-md-5 text-center">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt=""
                            style="overflow: hidden;">
                    @else
                        <img src="{{ asset('storage/posts/no-image-post.png') }}" class="img-fluid" alt=""
                            style="overflow: hidden;">
                    @endif
                    <div class="row form-group mt-2">
                        <label for="image" class="col-12 text-center"><b>Cambiar imagen</b></label>
                        <div class="col-12" style="overflow: hidden;">
                            <input type="file" name="image" id="image" accept="image/*">
                            @if ($errors->has('image'))
                                <div class="col-12 text-center text-danger"><b>{{ $errors->first('image') }}</b></div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-7 align-self-center">
                    <div class="row form-group">
                        <label for="title" class="col-12 col-md-5 text-center text-md-right"><b>Titulo</b></label>
                        <div class="col-12 col-md-7">
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') ?? $post->title }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="content" class="col-12 col-md-5 text-center text-md-right"><b>Contenido</b></label>
                        <div class="col-12 col-md-7">
                            <textarea name="content" id="content" rows="4"
                                class="form-control @error('content') is-invalid @enderror">{{ old('content') ?? $post->content }}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-auto-text-center">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </div>
        </form>

        {{-- form para eliminar --}}
        <form action="{{ route('post.destroy') }}" method="post">
            @csrf
            @method('delete')
            <input type="hidden" name="id_delete" id="id_delete" value="{{ $post->id }}">
            <div class="row justify-content-center mt-3">
                <div class="col-auto">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </form>

    </div>
@endsection
