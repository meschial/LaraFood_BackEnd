@extends('adminlte::page')

@section('title', 'Cadastrar nova permissão')

@section('content_header')
    <h1>Cadastrar novo perfil</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('permissions.store') }}" method="post" class="form">
        
        @include('admin.pages.permissions._partials.form')
        
      </form>
    </div>
  </div>
@endsection