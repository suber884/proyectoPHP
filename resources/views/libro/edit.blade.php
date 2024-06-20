@extends('layouts.app')
@section('content')
<div class="container">

<form action="{{ url('/libro/'.$libro->id)}}" method="post" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }}

@include('libro.form',['modo'=>'MODIFICAR'])    

</form>
</div>
@endsection