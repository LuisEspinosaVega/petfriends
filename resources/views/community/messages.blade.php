@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Conversaciones</h1>

        <div class="row justify-content-center mt-3">
            <div class="col-10 text-center">
                @foreach ($messages as $message)
                    <div class="row justify-content-center">
                        <div class="col-10 col-md-5 text-center my-3"
                            style="-webkit-box-shadow: 0px 10px 13px -7px #000000, -18px 11px 11px 7px rgba(10,10,9,0.41);">
                            <a href="/community/messages/{{ $message->user->username }}">
                                <div class="row">
                                    <div class="col-4 text-center align-self-center">
                                        @if ($message->user->image)
                                            <img src="{{ asset('storage/' . $message->user->image) }}"
                                                class="img-fluid rounded-circle" alt=""
                                                style="height:110px; widht: 110px;">
                                        @else
                                            <img src="{{ asset('storage/users/user-default.png') }}"
                                                class="img-fluid rounded-circle" alt=""
                                                style="min-height:110px; max-height: 120px;">
                                        @endif
                                    </div>
                                    <div class="col-auto align-self-center text-center">
                                        {{$message->user->name}}
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-2 text-center align-self-center">
                            @if ($message->seen)
                                <span class="badge bg-success">Leido</span>
                            @else
                                <span class="badge bg-warning">Nuevos</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
