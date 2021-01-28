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
                <input type="hidden" name="from" id="from" value="sales">
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
            <div class="row justify-content-center justify-content-md-around mt-2">
                <div class="col-auto text-center">
                    <a href="/sales/list/{{Auth::user()->username}}" class="btn btn-primary">Mis publicaciones</a>
                </div>
                <div class="col-auto text-center">
                    <a href="/sales/create" class="btn btn-primary">Ofrecer producto</a>
                </div>
            </div>
            <hr>

            <div class="row justify-content-center mt-3">
                @foreach ($sales as $sale)
                    @php
                    switch($sale->status){
                        case "all":
                            $bg = "bg-success";
                            $status = "Disponible";
                            break;
                        case "sold":
                            $bg = "bg-secondary";
                            $status = "Vendido";
                            break;
                    }
                    @endphp

                    <div class="col-12 col-md-7 mb-4 {{ $bg }}"
                        style="-webkit-box-shadow: 0px 20px 0px -10px #FFFFFF, 0px -20px 0px -10px #FFFFFF, 20px 0px 0px -10px #FFFFFF, -20px 0px 0px -10px #FFFFFF, 0px 0px 0px 10px #725c36, 5px 5px 15px 5px rgba(0,0,0,0);
                            box-shadow: 0px 20px 0px -10px #FFFFFF, 0px -20px 0px -10px #FFFFFF, 20px 0px 0px -10px #FFFFFF, -20px 0px 0px -10px #FFFFFF, 0px 0px 0px 10px #725c36, 5px 5px 15px 5px rgba(0,0,0,0);">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center text-md-left">
                                @if ($sale->user->image)
                                    <img src="{{ asset('storage/' . $sale->user->image) }}" alt="" style="width: 40px"
                                        height="40px" class="rounded-circle img-fluid">
                                @else
                                    <img src="{{ asset('storage/users/user-default.png') }}" alt="" style="width: 40px"
                                        height="40px" class="rounded-circle img-fluid">
                                @endif
                                <a href="/profile/{{ $sale->user->username }}">{{ $sale->user->name }}</a>
                                {{ $sale->created_at }}

                            </div>
                            <div class="col-8">
                                <p class="text-center"><b>{{ $sale->title }}</b></p>
                                <p class="text-center">
                                    @if ($sale->image)
                                        <img src="{{ asset('storage/' . $sale->image) }}" class="img-fluid" alt=""
                                            style="width: auto; height:300px;">
                                    @else
                                        <img src="{{ asset('storage/posts/no-image-post.png') }}" class="img-fluid" alt=""
                                            style="width: auto; height:300px;">
                                    @endif
                                </p>
                                <p class="text-center text-md-left">
                                    {{ $sale->description }}
                                </p>
                            </div>
                            <div class="col-4 align-self-center">
                                <p class="text-center text-md-left">
                                    Cantidad <b class="text-primary">{{ $sale->amount }}</b>
                                </p>
                                <p class="text-center text-md-left">
                                    Precio <b class="text-primary">${{ $sale->price }}</b>
                                </p>
                                <p class="text-center text-md-left">
                                    Categoria <b class="text-primary">{{ $sale->category }}</b>
                                </p>
                                <p class="text-center text-md-left mt-5">
                                    Estado: <b class="text-primary">{{ $status }}</b>
                                </p>
                                <p class="text-center text-md-left mt-5">
                                    <a href="/sales/list/{{ $sale->user->username }}" role="button"
                                        class="btn btn-sm btn-info">Mensaje »</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
