@extends('layouts.app')

@section('content')
    <div class="container">

        @if (!Auth::user()->profile->accept)
            <div class="h3 text-center">Para acceder a esta funcion debes completar tu perfil.</div>
            <div class="row justify-content-center my-3">
                <div class="col-12 text-center h4">
                    Nombre completo: <b>{{ Auth::user()->name }}</b>
                </div>
                <div class="col-12 text-center h4">
                    Correo electronico: <b>{{ Auth::user()->email }}</b>
                </div>
                <div class="col-12 text-center h4">
                    Nombre de usuario: <b>{{ Auth::user()->username }}</b>
                </div>
            </div>
            <form action="/completeprofile" method="post">
                @csrf
                <input type="hidden" name="from" id="from" value="adoption">
                <div class="row form-group">
                    <label for="phone" class="col-12 col-md-4 text-center text-md-right align-self-center">Numero
                        telefonico</label>
                    <div class="col-12 col-md-7">
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone') }}" placeholder="10 digitos">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <label for="address"
                        class="col-12 col-md-4 text-center text-md-right align-self-center">Dirección</label>
                    <div class="col-12 col-md-7">
                        <input type="text" name="address" id="address"
                            class="form-control @error('address') is-invalid @enderror" placeholder="Direccion"
                            value="{{ old('address') }}">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <label for="description" class="col-12 col-md-4 text-center text-md-right align-self-center">Sobre
                        mi</label>
                    <div class="col-12 col-md-7">
                        <textarea name="description" id="description" rows="3"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Escribe una breve descripcion sobre ti">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <label for="sex" class="col-12 col-md-4 text-center text-md-right align-self-center">Genero</label>
                    <div class="col-12 col-md-7">
                        <select name="sex" id="sex" class="custom-select @error('sex') is-invalid @enderror">
                            <option value="">Elige una opción...</option>
                            <option value="male">Masculino</option>
                            <option value="female">Femenino</option>
                            <option value="other">Prefiero no decirlo</option>
                        </select>
                        @error('sex')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center form-group">
                    <label for="accept" class="col-auto text-center text-md-right align-self-center">Acepto dar esta
                        información</label>
                    <div class="col-auto">
                        <input type="checkbox" class="form-check-input @error('accept') is-invalid @enderror" id="accept"
                            name="accept">
                        @error('accept')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row justify-content-center form-group">
                    <div class="col-auto text-center">
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </div>
            </form>
        @else
            <div class="h4 text-center">Lista de mascotas en adopción</div>
            <div class="row justify-content-center justify-content-md-end">
                <a role="button" href="/adoption/create" class="btn btn-primary">Ofrecer mascota en adopción</a>
            </div>

            <div class="row justify-content-center mt-3">
                @foreach ($adoptions as $adoption)
                    @php
                    //Algunas variables
                    if($adoption->sterilized){
                    $esterilizado = "Si";

                    }else{
                    $esterilizado = "No";
                    }

                    if($adoption->status == "all"){
                    $bg = "bg-light";
                    $text = "text-dark";
                    }else{
                    $bg = "bg-dark";
                    $text = "text-light";
                    }

                    @endphp

                    <div class="col-10 col-md-8 text-center p-2 {{ $bg }} {{ $text }} mb-3">
                        <a href="/adoption/detail/{{ $adoption->id }}" style="text-decoration:none;">
                            <div class="row">
                                <div class="col-4 col-md-6 align-self-center">
                                    @if ($adoption->image)
                                        <img src="{{ asset('storage/' . $adoption->image) }}" alt="" class="img-fluid"
                                            style="max-widht:300px;">
                                    @else
                                        <img src="{{ asset('storage/adoptions/no-image.png') }}" alt="" class="img-fluid"
                                            style="max-widht:300px;">
                                    @endif

                                </div>
                                <div class="col-8 col-md-6 align-self-center">
                                    <p class="text-left h6">
                                        <span class="text-secondary">NOMBRE:</span> <b>{{ $adoption->name }}</b>
                                    </p>
                                    <p class="text-left h6">
                                        <span class="text-secondary">DESCRIPCION:</span> <b>{{ $adoption->description }}</b>
                                    </p>
                                    <p class="text-left h6">
                                        <span class="text-secondary">ESTERLIZIADO:</span> <b>{{ $esterilizado }}</b>
                                    </p>
                                    <p class="text-left h6">
                                        <span class="text-secondary">VACUNAS:</span> <b>{{ $adoption->vaccines }}</b>
                                    </p>
                                    <p class="text-left h6">
                                        <span class="text-secondary">PESO:</span> <b>{{ $adoption->weight }} kg.</b>
                                    </p>
                                    <p class="text-left h6">
                                        <span class="text-secondary">ESTATURA:</span> <b>{{ $adoption->height }} cm.</b>
                                    </p>
                                    <p class="text-left h6">
                                        <span class="text-secondary">MOTIVO DE DARLO EN ADOPCION:</span>
                                        <b>{{ $adoption->reazon }}</b>
                                    </p>
                                </div>
                            </div>
                        </a>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
