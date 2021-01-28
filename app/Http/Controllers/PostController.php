<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //No se puede acceder si no esta logeado
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'string'],
            'content' => ['required', 'string'],
            'image' => ['image']
        ]);

        if ($request->image) {
            //Guardar la imagen en el servidor
            $path = $request->image->store('posts', 'public');
            //Reajustar imagen para que no llegue tan pesada
            // $image = Image::make(public_path("storage/{$path}"))->resize(400, 400);
            // $image->save();

        } else {
            $path = null;
        }


        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
            'image' => $path
        ]);

        return redirect('home');
    }

    //Eliminar un post {no uso un id identificador por que el id viene dentro del request}
    public function destroy(Request $request)
    {
        $id = $request->id_delete;

        $post = Post::find($id);

        if ($post->user->id != Auth::user()->id) {
            abort(403, 'No estas autorizado.');
        }

        //Eliminar la imagen del post
        if ($post->image) {
            unlink('storage/' . $post->image);
        }
        $post->delete();

        return redirect('/profile/' . Auth::user()->username);
    }

    //mostrar un post en especifico
    public function detail($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user->id != Auth::user()->id) {
            abort(403, 'No estas autorizado.');
        }

        return view('post.detail', compact('post'));
    }

    public function edit(Request $request)
    {
        // dd($request);
        $id = $request->id_edit;

        $post = Post::find($id);

        //Evitar que alguien que no sea el creador del post lo modifique
        if ($post->user->id != Auth::user()->id) {
            abort(403, 'No estas autorizado.');
        }

        // validar los datos
        $request->validate([
            'title' => ['required', 'min:5', 'string'],
            'content' => ['required', 'string'],
            'image' => ['image']
        ]);

        //Validar si viene una imagen
        if ($request->image) {
            $path = $request->image->store('posts', 'public');
            //Eliminar la anterior imagen si existe
            if ($post->image) {
                unlink('storage/' . $post->image);
            }

            $post->image = $path;
        }

        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();

        return redirect('/profile/' . Auth::user()->username);
    }
}
