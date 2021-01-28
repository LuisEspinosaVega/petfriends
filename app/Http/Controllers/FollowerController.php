<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Consultar datos del usuario logeado
        $user = User::find(Auth::user()->id);

        //Usuarios seguidos
        $following = $user->following;
        $followers = $user->profile->followers;

        // dd($followers);

        return view('community.index', compact('following', 'followers'));
    }

    //Funcion para guardar follows y unfollows
    public function store(User $user)
    {
        return Auth::user()->following()->toggle($user->profile);
    }

    public function messages()
    {
        //mostrar los mensajes que aun no ha visto el usuario
        $messages = Auth::user()->profile->recivedMessages()->get(['user_id', 'seen']);

        return view('community.messages', compact('messages'));
    }

    public function send(Request $request)
    {
        // dd($request);

        $message = $request->message_content;
        $id_to = $request->id_to;

        $new_message = Message::create([
            'user_id' => Auth::user()->id,
            'profile_id' => $id_to,
            'message_content' => $message
        ]);

        return $new_message;
    }

    //Retornar la conversacion con el usuario seleccionado
    public function conversation($username)
    {
        $profile = User::select('id', 'name')->where([
            ['username', '=', $username]
        ])->first();

        $conversation = Message::where([
            ['messages.user_id', '=',  Auth::user()->id],
            ['messages.profile_id', '=', $profile->id]
        ])->orWhere([
            ['messages.user_id', '=',  $profile->id],
            ['messages.profile_id', '=', Auth::user()->id]
        ])->orderBy('created_at', 'asc')->get();

        foreach ($conversation as $message) {
            if ($message->profile->user->id == Auth::user()->id) {
                $message->seen = true;
                $message->save();
            }
        }

        return view('community.conversation', compact('conversation', 'profile'));
    }
}
