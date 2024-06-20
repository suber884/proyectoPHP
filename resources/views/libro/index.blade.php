@extends('layouts.app')
@section('content')
<div class="container">
    @if(@Session::has('mensaje'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>
            {{ Session::get('mensaje') }}
        </strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


<a href="{{ url('libro/create')}}" class="btn btn-success">Introducir nuevo libro</a>
<br><br>
<table class="table">
    <thead class="table-group-divider text-center">
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Categoria</th>
            <th>Editorial</th>
            <th>ISBN</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody class="table-group-divider text-center">
        @foreach ($libros as $libro)
         
        <tr>
            <td>{{ $libro->id}}</td>
            <td>
                    <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$libro->imagen}}" width="100" alt="">
                    {{-- {{ $libro->imagen}} --}}
            </td>
            <td>{{ $libro->titulo}}</td>
            <td>{{ $libro->autor}}</td>
            <td>{{ $libro->categoria}}</td>
            <td>{{ $libro->editorial}}</td>
            <td>{{ $libro->isbn}}</td>
            <td>{{ $libro->precio}}</td>
            <td>
            <a href="{{ url('/libro/'.$libro->id.'/edit')}}" class="btn btn-warning">EDITAR</a>
            <form action="{{url('/libro/'.$libro->id)}}" class="d-inline" method="post">
                    @csrf
                    {{ method_field('DELETE')}}
                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Desea borrar?')" value="BORRAR">
            </form>
            </td>
                </tr>
        @endforeach
        
    </tbody>
</table>
{!! $libros->links()!!}
</div>
@endsection