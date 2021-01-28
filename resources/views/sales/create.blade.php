@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="h3 text-center my-3"><b>Publicar producto</b></div>
        <div class="alert alert-danger text-center h5" role="alert"><b>No ofrecer ni solicitar animales como producto.</b></div>
        <form action="/sales" method="post" id="createForm" enctype="multipart/form-data">
            @csrf

            <div class="row form-group">
                <label for="title" class="col-12 col-md-4 text-center text-md-right align-self-center">Titulo</label>
                <div class="col-12 col-md-7">
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}">
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
                        class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
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
                        class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
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
                        class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}">
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
                        <option value="Alimento">Alimento</option>
                        <option value="Accesorio">Accesorio</option>
                        <option value="Otro">Otro</option>
                    </select>
                    @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
                    <button type="submit" class="btn btn-sm btn-primary">Publicar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
