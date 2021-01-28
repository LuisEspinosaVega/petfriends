@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center justify-content-md-end my-3">
            <a role="button" href="/adoption" class="btn btn-primary">Regresar</a>
        </div>
        <div class="h4 text-center mb-3">Datos de la mascota</div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <form action="/adoption" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row form-group">
                        <label for="name"
                            class="col-12 col-md-4 text-center text-md-right align-self-center">Nombre:</label>
                        <div class="col-12 col-md-8">
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Ingresa el nombre de la mascota" value="{{ old('name') }}">
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
                                <option value="Felino" @if (old('type') == 'Felino') selected @endif>Felino</option>
                                <option value="Canino" @if (old('type') == 'Canino') selected @endif>Canino</option>
                                <option value="Reptil" @if (old('type') == 'Reptil') selected @endif>Reptil</option>
                                <option value="Roedor" @if (old('type') == 'Roedor') selected @endif>Roedor</option>
                                <option value="Otro" @if (old('type') == 'Otro') selected @endif>Otro (Especificar en descripcioón)</option>
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
                                placeholder="Escribe una descripcion sobre la mascota">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="vaccines"
                            class="col-12 col-md-4 text-center text-md-right align-self-center">Vacunas:</label>
                        <div class="col-12 col-md-8">
                            <textarea name="vaccines" id="vaccines" rows="3"
                                class="form-control @error('vaccines') is-invalid @enderror"
                                placeholder="Especificar que vacunas tiene, en caso de no tener, solo poner NO">{{ old('vaccines') }}</textarea>
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
                                <option value=1 @if (old('sterilized') == 1) selected @endif>Si</option>
                                <option value=0 @if (old('sterilized') == 0) selected @endif>No</option>
                            </select>
                            @error('sterilized')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="weight"
                            class="col-12 col-md-4 text-center text-md-right align-self-center">Peso:</label>
                        <div class="col-11 col-md-7">
                            <input type="number" name="weight" id="weight"
                                class="form-control @error('weight') is-invalid @enderror" placeholder="No obligatorio"
                                value="{{ old('weight') }}" step=".01">
                            @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-1 text-left align-self-center">kg.</div>
                    </div>

                    <div class="row form-group">
                        <label for="height"
                            class="col-12 col-md-4 text-center text-md-right align-self-center">Altura:</label>
                        <div class="col-11 col-md-7">
                            <input type="number" name="height" id="height"
                                class="form-control @error('height') is-invalid @enderror" placeholder="No obligatorio"
                                value="{{ old('height') }}" step=".01">
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
                            <textarea name="reazon" id="reazon" rows="3"
                                class="form-control @error('reazon') is-invalid @enderror"
                                placeholder="Escribe brevemente el motivo del por que quieres dar en adopción a la mascota">{{ old('reazon') }}</textarea>
                            @error('reazon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right align-self-center">Foto de la
                            mascota</label>
                        <div class="col-md-6" style="overflow: hidden;">
                            <input type="file" name="image" id="image" accept="image/*" value="{{ old('image') }}">
                        </div>
                        @if ($errors->has('image'))
                            <div class="col-12 text-center text-danger"><b>{{ $errors->first('image') }}</b></div>
                        @endif
                    </div>

                    <div class="row justify-content-center form-group">
                        <label for="accept" class="col-auto text-center text-md-right align-self-center">Acepto compartir mi
                            información para proceso de adopción</label>
                        <div class="col-12 text-center col-md-auto">
                            <input type="checkbox" class="form-check-input @error('accept') is-invalid @enderror"
                                id="accept" name="accept">
                            @error('accept')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-auto text-center">
                            <a role="button" href="/adoption" class="btn btn-secondary">Cancelar</a>
                        </div>
                        <div class="col-auto text-center">
                            <button type="submit" class="btn btn-primary">Publicar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
