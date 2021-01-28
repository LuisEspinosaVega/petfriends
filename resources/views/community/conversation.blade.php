@extends('layouts.app')

@section('content')
    <div class="container my-3">
        <div class="h4 text-center">Conversación con {{ $profile->name }}</div>
        <div class="row justify-content-center">
            @foreach ($conversation as $message)
                <div class="col-12 col-md-7 mb-3 text-center @if (Auth::user()->id ==
                $message->user->id) bg-light text-dark @else bg-dark text-light @endif"
                    style="-webkit-box-shadow: 0px 10px 13px -7px #000000, -18px 11px 11px 7px rgba(10,10,9,0.41);">
                    <div class="row justify-content-center">
                        <div class="col-2 align-self-center mt-3 text-center">
                            @if ($message->user->image)
                                <img src="{{ asset('storage/' . $message->user->image) }}" alt=""
                                    class="img-fluid rounded-circle" style="width: 60px; height:60px;">
                            @else
                                <img src="{{ asset('storage/users/user-default.png') }}" alt=""
                                    class="img-fluid rounded-circle" style="width: 60px; height:60px;">
                            @endif
                        </div>
                        <div class="col-10 text-center align-self-center">
                            {{ $message->message_content }}
                        </div>
                        <div class="col-12 text-right">
                            <small>{{ $message->created_at }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-10 col-md-6 text-center">
                <textarea name="message_content" id="message_content" rows="3" class="form-control"
                    placeholder="Escribe tu mensaje..."></textarea>
                <input type="hidden" name="profile_id" id="profile_id" value="{{ $profile->id }}">
            </div>
            <div class="col-1 align-self-end mb-2">
                <button type="button" id="btnSendConversarion" class="btn btn-sm btn-primary">Enviar</button>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('js/conversation.js') }}" defer></script>
@endpush
