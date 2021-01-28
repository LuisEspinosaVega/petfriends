<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sales = Sale::latest()->simplePaginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        if (!Auth::user()->profile->accept) {
            abort('403', '(SIN AUTORIZACIÓN) Necesitas completar tu perfil');
        } else {
            return view('sales.create');
        }
    }

    public function store(Request $request)
    {
        //Validar los datos
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:200'],
            'description' => ['required', 'string', 'min:5'],
            'price' => ['required', 'max:7', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'amount' => ['required', 'max:4'],
            'category' => ['required'],
            'image' => ['image']
        ]);

        if ($request->image) {
            //Guardar la imagen en el servidor
            $path = $request->image->store('sales', 'public');
            //Reajustar imagen para que no llegue tan pesada
            // $image = Image::make(public_path("storage/{$path}"))->resize(400, 400);
            // $image->save();

        } else {
            $path = null;
        }

        $sale = Sale::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'amount' => $request->amount,
            'category' => $request->category,
            'user_id' => Auth::user()->id,
            'image' => $path
        ]);

        return redirect('/sales');
    }

    //Sale especifica
    public function sale(Sale $sale)
    {
        // dd($sale);
        return view('sales.sale', compact('sale'));
    }

    //ventas por usuario
    public function list($username)
    {

        $user = User::where([
            ['username', '=', $username]
        ])->first();

        $sales = $user->sales;

        return view('sales.list', compact('sales'));
    }

    //Editar ventas
    public function edit(Sale $sale)
    {
        if ($sale->user->id != Auth::user()->id) {
            abort('403', 'Sin autorizacion');
        }
        return view('sales.edit', compact('sale'));
    }

    //Editar
    public function update($id, Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:200'],
            'description' => ['required', 'string', 'min:5'],
            'price' => ['required', 'max:7', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
            'amount' => ['required', 'max:4'],
            'category' => ['required'],
            'image' => ['image'],
            'status' => ['required']
        ]);

        $sale = Sale::find($id);

        if ($request->image) {
            //Guardar la imagen en el servidor
            $path = $request->image->store('sales', 'public');
            //Reajustar imagen para que no llegue tan pesada

            //Borrar la imagen anterior si ya existia
            if ($sale->image) {
                unlink('storage/' . $sale->image);
            }

            $sale->image = $path;
        }

        //Guardar la informacion
        $sale->title = $request->title;
        $sale->description = $request->description;
        $sale->price = $request->price;
        $sale->amount = $request->amount;
        $sale->category = $request->category;
        $sale->status = $request->status;

        $sale->save();

        return redirect('/sales/list/' . Auth::user()->username);
    }

    // Eliminar una venta
    public function destroy(Sale $sale)
    {
        if ($sale->image) {
            unlink('storage/' . $sale->image);
        }
        $sale->delete();
        return redirect('/sales/list/' . Auth::user()->username);
    }
}
