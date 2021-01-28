@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center justify-content-md-end my-3">
            <a role="button" href="/adoption" class="btn btn-primary">Regresar</a>
        </div>
        <div class="h4 text-center">Mis solicitudes de adopcion</div>
        <div class="row justify-content-center mt-3">
            @foreach ($myRequests as $req)
                @php
                switch ($req->status) {
                case 'Solicitado':
                $bg = "bg-success";
                $text = "Se a notificado al dueño de la mascota.";
                break;
                case 'Proceso':
                $bg = "bg-info";
                $text = "El usuario a aceptado tu solicitud, para seguir con el proceso ponte en contacto con el usuario.";
                break;
                case 'Rechazado':
                $bg = "bg-danger";
                $text = "El dueño de la mascota decidio no continuar con el proceso.";
                break;
                case 'Cancelado':
                $bg = "bg-danger";
                $text = "Canselaste esta solicitud.";
                break;
                }
                @endphp

                <div class="col-12 col-md-7 mb-3 p-3 align-self-center {{ $bg }}">
                    <p>Nombre de la mascota: <b>{{ $req->adoption->name }}</b></p>
                    <p>Estado de la solicitud: <b>{{ $text }}</b></p>
                    <p>Perfil del usuario que publicó la mascota: <a
                            href="/profile/{{ $req->adoption->user->username }}"><b>{{ $req->adoption->user->name }}</b></p>
                    </a>
                </div>
                @if ($req->status == 'Cancelado' || $req->status == 'Rechazado' || $req->status == 'Proceso')
                @else
                    <div class="col-auto text-center align-self-center">
                        <button type="button" class="btn btn-danger" data-id="{{ $req->id }}" data-toggle="modal"
                            data-target="#cancelRequest">Cancelar</button>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cancelRequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body bg-dark text-light">
                    <form action="/adoption/requests/cancel" method="post" id="formCancelar">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="type" id="type" value="cancel">
                        <div class="row justify-content-center">
                            <div class="col-12 text-center my-3">
                                Cancelar solicitud?
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-sm btn-danger">Si, cancelar</button>
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
