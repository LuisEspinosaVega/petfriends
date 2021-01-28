@extends('layouts.app')

@section('content')
    <div class="h3 text-center">Solicitud para adoptar a {{ $adoption->name }}</div>

    <div class="container bg-light">
        <div class="row mt-3">
            <div class="col-12 h4 text-center">Datos de la mascota</div>
            <div class="col-6">
                <p>Nombre: <b>{{ $adoption->name }}</b></p>
                <p>Tipo: <b>{{ $adoption->type }}</b></p>
                <p>Descripción: <b>{{ $adoption->description }}</b></p>
                <p>Vacunas: <b>{{ $adoption->vaccines }}</b></p>
                <p>Esterilizado: <b>{{ $adoption->sterilized == 1 ? 'Si' : 'No' }}</b></p>
            </div>
            <div class="col-6 text-center">
                <img src="{{ asset('storage/' . $adoption->image) }}" alt="" class="img-fluid"
                    style="max-height: 200px; width:auto;">
            </div>
        </div>
        <div class="h4 text-center mt-3">Por favor llenar el siguiente formulario para solicitar la adopción</div>
        <div class="row h5 m-3">
            <form action="/adoption/requests" method="post">
                @csrf
                <input type="hidden" name="adoption_id" id="adoption_id" value="{{ $adoption->id }}">
                <p>
                    Nombre del responsable de la adopción: <b>{{ Auth::user()->name }}</b>, con direccion:
                    <b>{{ Auth::user()->profile->address }}</b>,
                    numero telefonico: <b>{{ Auth::user()->profile->phone }}</b>, direccion de correo electronico:
                    <b>{{ Auth::user()->email }}</b> hace la siguiente
                    solicitud para iniciar un tramite de adopcion del animal <b>{{ $adoption->name }}.</b>
                </p>
                <p>
                    ¿Cual es tu edad? <input type="number" name="age" id="age"
                        class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}">
                    @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    ¿Cuantos miembros hay en tu familia? <input type="number" name="members" id="members"
                        class="form-control @error('members') is-invalid @enderror" value="{{ old('members') }}">
                    @error('members')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    ¿Estan de acuerdo en adoptar una mascota? <input type="text" name="agree" id="agree"
                        class="form-control  @error('agree') is-invalid @enderror" value="{{ old('agree') }}">
                    @error('agree')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    ¿Tienes mas mascotas en tu hogar? <input type="text" name="more" id="more"
                        class="form-control  @error('more') is-invalid @enderror" value="{{ old('more') }}">
                    @error('more')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    ¿Cuantas? <input type="number" name="many" id="many"
                        class="form-control  @error('many') is-invalid @enderror" value="{{ old('many') }}">
                    @error('many')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    ¿Que tipo de espacio tienes en tu hogar? <input type="text" name="space" id="space"
                        class="form-control  @error('space') is-invalid @enderror" placeholder="Patio, jardin etc..."
                        value="{{ old('space') }}">
                    @error('space')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    ¿Por que quieres adoptar esta mascota? <input type="text" name="why" id="why"
                        class="form-control  @error('why') is-invalid @enderror" value="{{ old('why') }}">
                    @error('why')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    Información que consideres importante compartir <input type="text" name="data" id="data"
                        class="form-control  @error('data') is-invalid @enderror" value="{{ old('data') }}">
                    @error('data')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    Acepto mostrar esta informacion al dueño de la mascota. <input type="checkbox" name="accept" id="accept"
                        class="@error('accept') is-invalid @enderror">
                    @error('accept')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p class="text-center">
                    <a href="/adoption" role="button" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Aceptar</button>
                </p>
                <p>
                    Este formulario no tiene validez legal para las dos partes, sino mas bien moral. Es de saberse que en
                    México, el problema de abandono de animales es muy grave y tenemos la responsabilidad como ciudadanos,
                    de concientizarnos unos a otros para tratar de erradicar este problema de nuestra sociedad en la mayor
                    medida posible. Por eso apelamos a su conciencia y corazón, para que usted se encargue responsablemente
                    del animal que esta adoptando, cumplir con los requisitos aquí mencionados y darle así las condiciones
                    adecuadas para que la integridad física y emocional del animalito, sean siempre las ideales.
                </p>
                <p>
                    Siéntase orgulloso de haber apoyado esta labor altruista, en la que solo los animalitos serán los más
                    agradecidos y beneficiados. ¡FELICIDADES!
                </p>
            </form>
        </div>
    </div>
@endsection
