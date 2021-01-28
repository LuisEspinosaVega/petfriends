@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center justify-content-md-end my-3">
            <a role="button" href="/adoption" class="btn btn-primary">Regresar</a>
        </div>
        <div class="h4 text-center">Processos de adopción</div>

        <div class="row justify-content-center mt-3">
            @foreach ($process as $pro)
                <div class="col-9 col-md-6 mb-3 p-3 border bg-light">
                    <p>Nombre de la mascota <b>{{ $pro->name }}</b></p>
                    <p>
                        Numero de solicitudes: <b>{{ $pro->arequest()->count() }}</b>
                    </p>
                    <p>
                        Estatus: <b>{{ $pro->status == 'all' ? 'En adopción' : 'Adoptado' }}</b>
                    </p>
                </div>
                <div class="col-auto align-self-center">
                    <a role="button" class="btn btn-primary" href="/adoption/process/{{ $pro->id }}">
                        Detalle
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
