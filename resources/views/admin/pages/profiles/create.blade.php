@extends('adminlte::page')

@section('title', 'Cadastrar novo perfil')

@section('content_header')
    <h1>Cadastrar novo perfil</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('profiles.store') }}" method="post" class="form">
        
        @include('admin.pages.profiles._partials.form')
        
      </form>
    </div>
  </div>
@endsection