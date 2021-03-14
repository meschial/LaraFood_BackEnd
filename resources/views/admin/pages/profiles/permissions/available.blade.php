@extends('adminlte::page')

@section('title', "Permissões disponiceis para o perfil {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
    </ol>

      <h1>Permissões disponiceis para o perfil {{$profile->name}}

    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('profiles.permissions.available', $profile->id) }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Buscar" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Fitrar</button>
            </form>
        </div>
        <div class="card-body">
          
          @include('admin.includes.alerts')

            <table class="table table-condensed">
                <thead>
                    <tr>
                      <th width="50px">#</th>
                      <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{route('profiles.permissions.attach', $profile->id)}}" method="post">
                      @csrf
                      @foreach ($permissions as $permission)
                        <tr>
                          <td>
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}">
                          </td>
                          <td>
                            {{ $permission->name }}
                          </td>
                        </tr>
                      @endforeach
                      <tr>
                        <td colspan="500">
                          <button type="submit" class="btn btn-dark">Enviar</button>
                        </td>
                      </tr>
                    </form>
                </tbody>
            </table>
            <div class="card-footer">
                @if (isset($filters))
                    {!! $permissions->appends($filters)->links() !!}
                @else
                    {!! $permissions->links() !!}
                @endif
            </div>
        </div>
    </div>
@stop