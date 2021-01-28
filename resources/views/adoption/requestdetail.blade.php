@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center justify-content-md-end my-3">
            <a role="button" href="/adoption/process" class="btn btn-primary">Regresar</a>
        </div>
        <h4 class="text-center">Detalles solicitudes para {{ $adoption->name }}</h4>

        @if ($arequest->count() != 0)
            <div class="row justify-content-center mt-3">
                @foreach ($arequest as $req)
                    @php
                    if($req->status == "Cancelado" || $req->status == "Rechazado"){
                    $bg = "bg-danger";
                    $text = "text-light";
                    }else if($req->status == "Solicitado"){
                    $bg = "bg-info";
                    $text = "text-dark";
                    }else{
                    $bg = "bg-success";
                    $text = "text-dark";
                    }
                    @endphp
                    <div class="col-9 col-md-7 border mb-3 p-2 align-self-center {{ $bg }} {{ $text }}">
                        <p>
                            Nombre del adoptante: <b>{{ $req->user->name }}</b>
                        </p>
                        <p>
                            Telefono: <b>{{ $req->user->profile->phone }}</b>
                        </p>
                        <p>
                            Correo electronico: <b>{{ $req->user->email }}</b>
                        </p>
                        <p>
                            Estatus de la solicitud: <b>{{ $req->status }}</b>
                        </p>
                        <p>
                            <a href="/profile/{{ $req->user->username }}" style="text-decoration: none;">Ir al perfil »</a>
                        </p>
                    </div>
                    @if ($req->status == 'Solicitado')
                        <div class="col-2 align-self-center">
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-data='{{ $req }}' data-target="#requestModal">Solicitud»</button>
                                </div>
                                <div class="col-12 mt-1">
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-idrechazar='{{ $req->id }}' data-target="#rechazarModal">Rechazar»</button>
                                </div>
                                <div class="col-12 mt-1">
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                                        data-idaceptar='{{ $req->id }}' data-target="#aceptarModal">Aceptar»</button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>


        @else
            <div class="h1 text-center mt-5">Aun no hay solicitudes de adopcion para {{ $adoption->name }} 😓</div>
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content bg-dark text-light">
                <div class="row justify-content-center">
                    <div class="col-12 p-5">
                        <p>
                            ¿Cual es tu edad? <span id="age" style="font-weight: bold;"></span>
                        </p>
                        <p>
                            ¿Cuantos miembros hay en tu familia? <span id="members" style="font-weight: bold;"></span>
                        </p>
                        <p>
                            ¿Estan de acuerdo en adoptar una mascota? <span id="agree" style="font-weight: bold;"></span>
                        </p>
                        <p>
                            ¿Tienes mas mascotas en tu hogar? <span id="more" style="font-weight: bold;"></span>
                        </p>
                        <p>
                            ¿Cuantas? <span id="many" style="font-weight: bold;"></span>
                        </p>
                        <p>
                            ¿Que tipo de espacio tienes en tu hogar? <span id="space" style="font-weight: bold;"></span>
                        </p>
                        <p>
                            ¿Por que quieres adoptar esta mascota? <span id="why" style="font-weight: bold;"></span>
                        </p>
                        <p>
                            Información que consideres importante compartir <span id="data"
                                style="font-weight: bold;"></span>
                        </p>
                        <hr>
                        <p>
                            Este formulario no tiene validez legal para las dos partes, sino mas bien moral. Es de saberse
                            que
                            en
                            México, el problema de abandono de animales es muy grave y tenemos la responsabilidad como
                            ciudadanos,
                            de concientizarnos unos a otros para tratar de erradicar este problema de nuestra sociedad en la
                            mayor
                            medida posible. Por eso apelamos a su conciencia y corazón, para que usted se encargue
                            responsablemente
                            del animal que esta adoptando, cumplir con los requisitos aquí mencionados y darle así las
                            condiciones
                            adecuadas para que la integridad física y emocional del animalito, sean siempre las ideales.
                        </p>
                        <p>
                            Siéntase orgulloso de haber apoyado esta labor altruista, en la que solo los animalitos serán
                            los
                            más
                            agradecidos y beneficiados. ¡FELICIDADES!
                        </p>
                    </div>
                    <div class="col-auto my-3">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="rechazarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body bg-dark text-light">
                    <form action="/adoption/requests/cancel" method="post" id="formRechazar">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id_rechazar" id="id_rechazar">
                        <input type="hidden" name="type" id="type" value="rechazar">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center my-3">
                                Rechazar solicitud?
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-sm btn-danger">Si, rechazar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="aceptarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body bg-dark text-light">
                    <form action="/adoption/requests/cancel" method="post" id="formAceptar">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id_acept" id="id_acept">
                        <input type="hidden" name="type" id="type" value="aceptar">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center my-3">
                                Aceptar solicitud? <br>
                                Esto no significa que la adopción es un hecho, deberás ponerte en contacto con el
                                adoptante
                                para detalles.
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-sm btn-success">Si, aceptar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('js/request.js') }}" defer></script>
@endpush
