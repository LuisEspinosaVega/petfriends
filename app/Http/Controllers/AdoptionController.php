<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Arequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdoptionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $adoptions = Adoption::all();

        return view('adoption.index', compact('adoptions'));
    }

    public function create()
    {
        return view('adoption.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'description' => ['required', 'string', 'min:5'],
            'type' => ['required'],
            'vaccines' => ['required', 'string', 'min:2'],
            'sterilized' => ['required'],
            'weight' => ['max:4'],
            'height' => ['max:4'],
            'reazon' => ['required', 'min:10'],
            'accept' => ['accepted']
        ]);

        if ($request->image) {
            //Guardar la imagen en el servidor
            $path = $request->image->store('adoptions', 'public');
        } else {
            $path = null;
        }

        $adoption = Adoption::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'vaccines' => $request->vaccines,
            'sterilized' => $request->sterilized,
            'weight' => $request->weight,
            'height' => $request->height,
            'reazon' => $request->reazon,
            'accept' => true,
            'image' => $path,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/adoption');
    }

    public function detail(Adoption $adoption)
    {
        return view('adoption.detail', compact('adoption'));
    }

    //Eliminar la publicacion
    public function destroy(Adoption $adoption)
    {
        $adoption->delete();

        return redirect('/adoption');
    }

    public function edit(Adoption $adoption)
    {
        return view('adoption.edit', compact('adoption'));
    }

    //Actualizar el registro
    public function update(Adoption $adoption, Request $request)
    {
        // dd($adoption);

        // Validar el formulario
        $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'description' => ['required', 'string', 'min:5'],
            'type' => ['required'],
            'vaccines' => ['required', 'string', 'min:2'],
            'sterilized' => ['required'],
            'weight' => ['max:4'],
            'height' => ['max:4'],
            'reazon' => ['required', 'min:10'],
        ]);

        if ($request->image) {
            if ($adoption->image) {
                unlink('storage/' . $adoption->image);
            }
            //Guardar la imagen en el servidor
            $path = $request->image->store('adoptions', 'public');

            $adoption->image = $path;
        }

        $adoption->name = $request->name;
        $adoption->description = $request->description;
        $adoption->type = $request->type;
        $adoption->vaccines = $request->vaccines;
        $adoption->sterilized = $request->sterilized;
        $adoption->weight = $request->weight;
        $adoption->height = $request->height;
        $adoption->reazon = $request->reazon;

        $adoption->save();

        return redirect('/adoption');
    }

    //Mostrar las peticiones del usuario logeado
    public function requests()
    {
        $myRequests = Auth::user()->arequests;

        return view('adoption.requests', compact('myRequests'));
    }

    //Handle request
    public function createRequest(Adoption $adoption)
    {
        return view('adoption.createrequest', compact('adoption'));
    }

    //Guardar la solicitud
    public function storeRequest(Request $request)
    {
        $request->validate([
            'age' => ['required'],
            'members' => ['required'],
            'agree' => ['required'],
            'more' => ['required'],
            'space' => ['required'],
            'why' => ['required'],
            'data' => ['required'],
            'accept' => ['accepted']
        ]);

        $arequest = Arequest::create([
            'user_id' => Auth::user()->id,
            'adoption_id' => $request->adoption_id,
            'age' => $request->age,
            'members' => $request->members,
            'agree' => $request->agree,
            'more' => $request->more,
            'many' => $request->many,
            'space' => $request->space,
            'why' => $request->why,
            'data' => $request->data,
            'accept' => true
        ]);

        return redirect('/adoption/requests');
    }

    //Cancelar o rechazar tramite
    public function cancelRequest(Request $request)
    {
        if ($request->type == "cancel") {
            $arequest = Arequest::find($request->id);
            $arequest->status = "Cancelado";
        } else if ($request->type == "rechazar") {
            $arequest = Arequest::find($request->id_rechazar);
            $arequest->status = "Rechazado";
        } else if ($request->type == "aceptar") {
            $arequest = Arequest::find($request->id_acept);
            $arequest->status = "Proceso";

            $adoption = Adoption::find($arequest->adoption_id);
            $adoption->status = 'adopted';
            $adoption->save();
        }

        $arequest->save();

        return redirect('/adoption');
    }

    //Mirar las solicitudes de las publicaciones del usuario logeado
    public function process()
    {
        $process = Auth::user()->adoptions;

        return view('adoption.process', compact('process'));
    }

    //Detalle especifico
    public function processDetail(Adoption $adoption)
    {
        $arequest = $adoption->arequest;

        return view('adoption.requestdetail', compact('adoption', 'arequest'));
    }
}
