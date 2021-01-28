@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center justify-content-md-end my-3">
            <a role="button" href="/adoption" class="btn btn-primary">Regresar</a>
        </div>
        <h4 class="text-center">Detalles de {{ $adoption->name }} </h4>

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

        <div class="row">
            <div class="col-4 col-md-6 text-center align-self-center">
                @if ($adoption->image)
                    <img src="{{ asset('storage/' . $adoption->image) }}" alt="" class="img-fluid"
                        style="max-height: 500px;">
                @else
                    <img src="{{ asset('storage/adoptions/no-image.png') }}" alt="" class="img-fluid"
                        style="max-height: 500px;">
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

                <p class="text-left h5">
                    <span class="text-secondary">ESTATUS DE LA MASCOTA:</span>
                    <b>{{ $adoption->status == 'all' ? 'En adopción' : 'Adoptado' }}</b>
                </p>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            @if ($adoption->status == 'adopted')
                <div class="col-12 text-center h4 text-danger">Esta mascota ha sido adoptada 😺</div>
            @else
                @if ($adoption->user->id == Auth::user()->id)
                    <div class="col-auto text-center">
                        <form action="/adoption/{{ $adoption->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>

                    <div class="col-auto text-center">
                        <a role="button" href="/adoption/edit/{{ $adoption->id }}" class="btn btn-primary">Editar</a>
                    </div>
                @else
                    <div class="col-auto text-center">
                        <a role="button" href="/adoption/requests/create/{{ $adoption->id }}"
                            class="btn btn-primary">Solicitar
                            tramite de
                            adopción</a>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
