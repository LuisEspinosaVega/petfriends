@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center mt-3">
            </div>
            {{-- seguidos --}}
            <div class="col-md-6 ">
                <h1 class="text-center">Seguidos</h1>
                @foreach ($following as $item)
                    <div class="row justify-content-center mt-5 mx-3" style="-webkit-box-shadow: 5px 5px 15px 5px #000000;
                        box-shadow: 5px 5px 15px 5px #000000;">
                        <div class="col-4 text-center align-self-center" style="height: 150px;">
                            @if ($item->user->image)
                                <img src="{{ asset('storage/' . $item->user->image) }}" class="img-fluid rounded-circle align-self-center"
                                    alt="" style="min-height:150px; max-height: 150px;">
                            @else
                                <img src="{{ asset('storage/users/user-default.png') }}" class="img-fluid rounded-circle"
                                    alt="" style="max-height: 150px;">
                            @endif
                        </div>
                        <div class="col-8 align-self-center">
                            <div class="row">
                                <div class="col-12">
                                    <a href="/profile/{{ $item->user->username }}">{{ $item->user->name }}</a>
                                </div>
                                <div class="col-12">
                                    <b>{{$item->user->posts->count()}}</b> Publicaciones
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- seguidores --}}
            <div class="col-md-6 mt-5 mt-md-0">
                <h1 class="text-center">Seguidores</h1>
                @foreach ($followers as $item)
                    <div class="row justify-content-center mt-5 mx-3" style="-webkit-box-shadow: 5px 5px 15px 5px #000000;
                        box-shadow: 5px 5px 15px 5px #000000;">
                        <div class="col-4 text-center align-self-center" style="height: 150px;">
                            @if ($item->profile->user->image)
                                <img src="{{ asset('storage/' . $item->profile->user->image) }}" class="img-fluid rounded-circle"
                                    alt="" style="min-height:150px; max-height: 150px;">
                            @else
                                <img src="{{ asset('storage/users/user-default.png') }}" class="img-fluid rounded-circle"
                                    alt="" style="max-height: 150px;">
                            @endif
                        </div>
                        <div class="col-8 align-self-center">
                            <div class="row">
                                <div class="col-12">
                                    <a href="/profile/{{ $item->profile->user->username }}">{{ $item->profile->user->name }}</a>
                                </div>
                                <div class="col-12">
                                    <b>{{$item->profile->user->posts->count()}}</b> Publicaciones
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
