    <h3 class="text-center fw-bold">{{ $modo }} LIBRO</h3>

    @if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach( $errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row justify-content-md-center">
            <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input class="form-control" type="text" name="titulo" 
                value="{{ isset($libro->titulo)? $libro->titulo:old('titulo') }}" id="titulo">
               
            </div>
            <div class="form-group">
                <label for="autor">Autor</label>
                <input class="form-control" type="text" name="autor" 
                value="{{ isset($libro->autor)? $libro->autor:old('autor') }}" id="autor">
             
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <input class="form-control" type="text" name="categoria" 
                value="{{ isset($libro->categoria)? $libro->categoria:old('categoria') }}" id="categoria">
            
            </div>
                <div class="form-group">
                <label for="editorial">Editorial</label>
                <input class="form-control" type="text" name="editorial" 
                value="{{ isset($libro->editorial)? $libro->editorial:old('editorial') }}" id="editorial">
             
            </div>
                <div class="form-group">
                <label for="isbn">ISBN</label>
                {{-- <input class="form-control" type="text" name="isbn"  --}}
                {{-- value="{{ isset($libro->isbn)? $libro->isbn:old('isbn') }}" disabled id="isbn"> --}}
              {{-- deshabilita el isbn cuando se esta editando --}}
                @if(isset($libro))
                <input class="form-control" type="text" name="isbn" value="{{ old('isbn', $libro->isbn) }}" disabled>
            @else
                <input class="form-control" type="text" name="isbn" value="{{ old('isbn') }}">
            @endif
            </div>
            <div class="form-group row g-3">
                <div class="col-auto">
                <label for="imagen"></label>
                {{-- {{ $libro->imagen }} --}}
                @if(isset($libro->imagen))
                <img src="{{asset('storage').'/'.$libro->imagen}}" class="img-thumbnail img-fluid" width="75" alt="">
                @endif
                </div>
                <div class="col-auto">
                    <label for="formFile" class="form-label"></label>
                    <input class="form-control" name="imagen" type="file" id="imagen">
                </div>
                             
                    {{-- <input type="file" name="imagen" class="btn btn-light" value="" id="imagen"> --}}
            </div>
            <div class="form-group mb-2">
                <label for="precio">Precio</label>
                <input class="form-control" type="number" name="precio" 
                value="{{ isset($libro->precio)? $libro->precio:old('precio') }}" id="precio">
             
            </div>
                <input class="btn btn-success" type="submit" value="{{ $modo }} LIBRO" id="guardar">
            
                <a class="btn btn-primary" href="{{ url('libro/')}}">VOLVER</a>
        </div>
      
    </div>
