@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3 h4">Editar publicación</div>

        {{-- form --}}
        <div class="alert alert-danger text-center h5" role="alert"><b>No ofrecer ni solicitar animales como producto.</b>
        </div>
        <form action="/sales/list/{{ $sale->id }}/edit" method="post" id="createForm" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row form-group">
                <label for="title" class="col-12 col-md-4 text-center text-md-right align-self-center">Titulo</label>
                <div class="col-12 col-md-7">
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') ?? $sale->title }}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row form-group">
                <label for="description"
                    class="col-12 col-md-4 text-center text-md-right align-self-center">Descripción</label>
                <div class="col-12 col-md-7">
                    <textarea name="description" id="description" rows="3"
                        class="form-control @error('description') is-invalid @enderror">{{ old('description') ?? $sale->description }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row form-group">
                <label for="price" class="col-12 col-md-4 text-center text-md-right align-self-center">Precio</label>
                <div class="col-11 col-md-6">
                    <input type="number" name="price" id="price" step=".01"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price') ?? $sale->price }}">
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-1 text-left align-self-center">$</div>
            </div>

            <div class="row form-group">
                <label for="amount" class="col-12 col-md-4 text-center text-md-right align-self-center">Cantidad</label>
                <div class="col-12 col-md-7">
                    <input type="number" name="amount" id="amount"
                        class="form-control @error('amount') is-invalid @enderror"
                        value="{{ old('amount') ?? $sale->amount }}">
                    @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row form-group">
                <label for="category" class="col-12 col-md-4 text-center text-md-right align-self-center">Categoria</label>
                <div class="col-12 col-md-7">
                    <select name="category" id="category" class="custom-select @error('category') is-invalid @enderror">
                        <option value="">Selecciona una categoria...</option>
                        <option value="Alimento" @if ($sale->category == 'Alimento') selected @endif>Alimento</option>
                        <option value="Accesorio" @if ($sale->category == 'Accesorio') selected @endif>Accesorio</option>
                        <option value="Otro" @if ($sale->category == 'Otro') selected @endif>Otro</option>
                    </select>
                    @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row form-group">
                <label for="status" class="col-12 col-md-4 text-center text-md-right align-self-center">Estatus</label>
                <div class="col-12 col-md-7">
                    <select name="status" id="status" class="custom-select @error('status') is-invalid @enderror">
                        <option value="">Selecciona una categoria...</option>
                        <option value="all" @if ($sale->status == 'all') selected @endif>Disponible</option>
                        <option value="sold" @if ($sale->status == 'sold') selected @endif>Vendido</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row justify-content-center">
                <div class="col-8 text-center">
                    @if ($sale->image)
                        <img src="{{ asset('/storage/' . $sale->image) }}" alt="" class="img-fluid"
                            style="height: 200px; widht:auto;">
                    @else
                        <img src="{{ asset('/storage/posts/no-image-post.png') }}" alt="" class="img-fluid"
                            style="height: 200px; widht:auto;">
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-12 col-md-4 text-center text-md-right align-self-center">Imagen</label>
                <div class="col-12 col-md-7">
                    <input type="file" name="image" id="image" style="overflow: hidden;">
                </div>
            </div>

            <div class="row form-group justify-content-center">
                <div class="col-auto">
                    <a role="button" href="/sales" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</a>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
