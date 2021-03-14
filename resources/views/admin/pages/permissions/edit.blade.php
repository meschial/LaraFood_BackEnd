@extends('adminlte::page')

@section('title', 'Editar plano')

@section('content_header')
    <h1>Editar permissão</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('permissions.update', $permission->id) }}" method="post" class="form">

        @method('PUT')

        @include('admin.pages.permissions._partials.form')
        
      </form>
    </div>
  </div>
@endsection