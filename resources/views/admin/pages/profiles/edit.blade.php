@extends('adminlte::page')

@section('title', 'Editar plano')

@section('content_header')
    <h1>Editar perfil</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('profiles.update', $profile->id) }}" method="post" class="form">

        @method('PUT')

        @include('admin.pages.profiles._partials.form')
        
      </form>
    </div>
  </div>
@endsection