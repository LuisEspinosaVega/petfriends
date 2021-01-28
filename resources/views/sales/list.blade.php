@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="h4 text-center">Productos listados por {{ $sales[0]->user->name }}
            @if (Auth::user()->id != $sales[0]->user->id)
                <a href="/profile/{{ $sales[0]->user->username }}" role="button" class="btn-sm btn-dark">Contactar</a>
            @endif

        </div>
        <div class="row justify-content-center my-5">
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

                            <div class="row mt-2 justify-content-around">
                                <div class="col-auto text-center">
                                    {{ $sale->created_at }}
                                </div>
                                @if (Auth::user()->id == $sale->user->id)
                                    <div class="col-auto text-center">
                                        <a role="button" href="/sales/list/product/{{ $sale->id }}"
                                            class="btn btn-sm btn-primary">Editar</a>
                                    </div>
                                    <div class="col-auto text-center">
                                        <form action="/sales/destroy/{{ $sale->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="col-8 mt-3">
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
