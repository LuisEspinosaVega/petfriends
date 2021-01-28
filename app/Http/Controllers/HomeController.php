<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //obtener los usuarios que sigo (yo logeado)
        $users = Auth::user()->following()->pluck('profiles.user_id');

        //Agregarme en el arreglo de usuarios para tambien ver mis post
        $users->push(Auth::user()->id);

        //Obtener los post de los usuarios que sigo y los mios
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->simplePaginate(10);

        return view('home', compact('posts'));
    }

    public function account()
    {
        //Consultar los datos de quien esta logeado
        $user = User::find(Auth::user()->id);
        return view('account', compact('user'));
    }


    public function update(Request $request)
    {
        //dd($request->image->store('users', 'public'));
        // consultar el id del usuario logeado
        $user = User::find(Auth::user()->id);
        //Verificar si cambio la contraseña
        if ($request->password || $request->image) {
            // validar la request
            if ($request->password) {
                $request->validate([
                    'password' => ['required', 'string', 'min:8', 'confirmed']
                ]);

                $user->password = Hash::make($request->password);
                //Verificar si viene una imagen en el request
            }

            if ($request->image) {
                $request->validate([
                    'image' => ['image']
                ]);

                //Guardar la imagen en el servidor
                $path = $request->image->store('users', 'public');
                //Reajustar imagen para que no llegue tan pesada
                // $image = Image::make(public_path("storage/{$path}"))->resize(400, 400);
                // $image->save();

                // eliminar la imagen anterior
                if ($user->image) {
                    unlink("storage/{$user->image}");
                }
                //Guardar el path de la imagen
                $user->image = $path;
            }

            $user->save();
            $passChanged = true;
            return view('account', compact('user', 'passChanged'));
        }
        return view('account', compact('user'));
    }

    public function profile($username)
    {
        $user = User::where([
            ['username', '=', $username]
        ])->first();

        if (isset($user->id)) {
            //Verificar si el perfil en el que estoy no es del usuario logeado
            if ($user->id != Auth::user()->id) {
                $follows = Auth::user()->following->contains($user->id);
            } else {
                $follows = false;
            }

            return view('profile', compact('user', 'follows'));
        } else {
            abort(404);
        }
    }

    //Completar el perfil
    public function completeProfile(Request $request)
    {
        //Validar los datos
        $request->validate([
            'phone' => ['required', 'digits:10'],
            'address' => ['required', 'string', 'min:10'],
            'description' => ['required', 'string', 'min:8'],
            'sex' => ['required'],
            'accept' => ['accepted']
        ]);
        //Buscar el profil para editarlo
        $profile = Profile::find(Auth::user()->profile->id);
        //Editar el perfile
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        $profile->sex = $request->sex;
        $profile->description = $request->description;
        $profile->accept = true;

        $profile->save();

        $from = $request->from;
        return redirect("/{$from}");
    }

    //Buscar usuarios
    public function search(Request $request)
    {
        $value = $request->value;
        if ($value == "") {
            $users = User::select('name','username')->orderBy('name', 'asc')->get();
        } else {
            $users = User::select('name','username')->where('name', 'LIKE', '%' . $value . '%')->orWhere('username', 'LIKE', '%' . $value . '%')->orderBy('name', 'asc')->get();
        }

        return json_encode($users);
    }
}
