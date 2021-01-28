@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center justify-content-md-end my-3">
            <a role="button" href="/adoption/process" class="btn btn-primary">Regresar</a>
        </div>
        <h4 class="text-center">Editar datos de {{ $adoption->name }}</h4>

        <div class="row justify-content-center mb-3">
            <div class="col-12 col-md-7 text-center">
                @if ($adoption->image)
                    <img src="{{ asset('storage/' . $adoption->image) }}" alt="" class="img-fluid"
                        style="max-height: 300px; width:auto;">
                @else
                    <img src="{{ asset('storage/adoptions/no-image.png') }}" alt="" class="img-fluid"
                        style="max-height: 300px; width:auto;">
                @endif
            </div>
        </div>
        <form action="/adoption/{{ $adoption->id }}/edit" method="post" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('patch')
            <div class="row form-group">
                <label for="name" class="col-12 col-md-4 text-center text-md-right align-self-center">Nombre:</label>
                <div class="col-12 col-md-8">
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Ingresa el nombre de la mascota" value="{{ old('name') ?? $adoption->name }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row form-group">
                <label for="type" class="col-12 col-md-4 text-center text-md-right align-self-center">Tipo de
                    mascota:</label>
                <div class="col-12 col-md-8">
                    <select name="type" id="type" class="custom-select @error('type') is-invalid @enderror">
                        <option value="">Selecciona una opción...</option>
                        <option value="Felino" @if ($adoption->type == 'Felino') selected @endif>Felino</option>
                        <option value="Canino" @if ($adoption->type == 'Canino') selected @endif>Canino</option>
                        <option value="Reptil" @if ($adoption->type == 'Reptil') selected @endif>Reptil</option>
                        <option value="Roedor" @if ($adoption->type == 'Roedor') selected @endif>Roedor</option>
                        <option value="Otro" @if ($adoption->type == 'Otro') selected @endif>Otro (Especificar en descripcioón)</option>
                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row form-group">
                <label for="description"
                    class="col-12 col-md-4 text-center text-md-right align-self-center">Descripción:</label>
                <div class="col-12 col-md-8">
                    <textarea name="description" id="description" rows="3"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Escribe una descripcion sobre la mascota">{{ old('description') ?? $adoption->description }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row form-group">
                <label for="vaccines" class="col-12 col-md-4 text-center text-md-right align-self-center">Vacunas:</label>
                <div class="col-12 col-md-8">
                    <textarea name="vaccines" id="vaccines" rows="3"
                        class="form-control @error('vaccines') is-invalid @enderror"
                        placeholder="Especificar que vacunas tiene, en caso de no tener, solo poner NO">{{ old('vaccines') ?? $adoption->vaccines }}</textarea>
                    @error('vaccines')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row form-group">
                <label for="sterilized"
                    class="col-12 col-md-4 text-center text-md-right align-self-center">Esterilizado:</label>
                <div class="col-12 col-md-8">
                    <select name="sterilized" id="sterilized"
                        class="custom-select @error('sterilized') is-invalid @enderror">
                        <option value="">Selecciona una opción...</option>
                        <option value=1 @if ($adoption->sterilized == 1) selected @endif>Si</option>
                        <option value=0 @if ($adoption->sterilized == 0) selected @endif>No</option>
                    </select>
                    @error('sterilized')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row form-group">
                <label for="weight" class="col-12 col-md-4 text-center text-md-right align-self-center">Peso:</label>
                <div class="col-11 col-md-7">
                    <input type="number" name="weight" id="weight"
                        class="form-control @error('weight') is-invalid @enderror" placeholder="No obligatorio"
                        value="{{ old('weight') ?? $adoption->weight }}" step=".01">
                    @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-1 text-left align-self-center">kg.</div>
            </div>

            <div class="row form-group">
                <label for="height" class="col-12 col-md-4 text-center text-md-right align-self-center">Altura:</label>
                <div class="col-11 col-md-7">
                    <input type="number" name="height" id="height"
                        class="form-control @error('height') is-invalid @enderror" placeholder="No obligatorio"
                        value="{{ old('height') ?? $adoption->height }}" step=".01">
                    @error('height')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-1 text-left align-self-center">cm.</div>
            </div>

            <div class="row form-group">
                <label for="reazon" class="col-12 col-md-4 text-center text-md-right align-self-center">Motivo de la
                    adopción:</label>
                <div class="col-12 col-md-8">
                    <textarea name="reazon" id="reazon" rows="3" class="form-control @error('reazon') is-invalid @enderror"
                        placeholder="Escribe brevemente el motivo del por que quieres dar en adopción a la mascota">{{ old('reazon') ?? $adoption->reazon }}</textarea>
                    @error('reazon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-md-4 col-form-label text-center text-md-right align-self-center">Foto de la
                    mascota</label>

                <div class="col-md-6" style="overflow: hidden;">
                    <input type="file" name="image" id="image" accept="image/*" value="{{ old('image') }}">
                </div>
                @if ($errors->has('image'))
                    <div class="col-12 text-center text-danger"><b>{{ $errors->first('image') }}</b></div>
                @endif
            </div>

            {{-- <div class="row justify-content-center form-group">
                <label for="accept" class="col-auto text-center text-md-right align-self-center">Acepto compartir mi
                    información para proceso de adopción</label>
                <div class="col-12 text-center col-md-auto">
                    <input type="checkbox" class="form-check-input @error('accept') is-invalid @enderror" id="accept"
                        name="accept">
                    @error('accept')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div> --}}

            <div class="form-group row justify-content-center">
                <div class="col-auto text-center">
                    <a role="button" href="/adoption" class="btn btn-secondary">Cancelar</a>
                </div>
                <div class="col-auto text-center">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </div>

        </form>
    </div>
@endsection
