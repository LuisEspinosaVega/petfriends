@extends('layouts.app')

@php
$imageUrl = $user->image ?? "users/user-default.png";
@endphp

@section('content')
    <div class="container">
        <h2 class="text-center">Mi cuenta</h2>
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-header text-center h3 fw-bold">{{ $user->name }}</div>
                    <div class="card-img-top text-center mt-2">
                        <img class="img-fluid rounded-circle" src="storage/{{ $imageUrl }}" alt="" style="max-height: 400px">
                    </div>
                    <div class="card-body">
                        <form action="/account" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="form-group row">
                                <div class="col-12 col-md-6 h5 text-center text-md-right">Nombre de usuario:</div>

                                <div class="col-12 col-md-6 h5 text-center text-md-left">
                                    {{ $user->username }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12 col-md-6 h5 text-center text-md-right">Correo electrónico:</div>

                                <div class="col-12 col-md-6 h5 text-center text-md-left">
                                    {{ $user->email }}
                                </div>
                            </div>

                            <div class="h4 mb-3 text-center">Editar tus datos</div>

                            @if (isset($passChanged))
                                <div class="alert alert-success text-center"><b>Tu perfil ha sido modificado!</b></div>
                            @endif

                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Foto de perfil</label>
                                <div class="col-md-6" style="overflow: hidden;">
                                    <input type="file" name="image" id="image" accept="image/*">
                                </div>
                                @if ($errors->has('image'))
                                    <div class="col-12 text-center text-danger"><b>{{ $errors->first('image') }}</b></div>
                                @endif
                            </div>


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar
                                    contraseña</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group justify-content-center row">
                                <div class="col-auto text-center">
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
