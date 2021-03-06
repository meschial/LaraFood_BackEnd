@extends('adminlte::page')

@section('title', "Editando detalhe do plano {{ $plan->name}}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.index', $plan->url) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('details.plan.edit', [$plan->url, $detail->id]) }}">Editar</a></li>
    </ol>

    <h1>Editando detalhe do plano {{ $plan->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.plan.update', [$plan->url, $detail->id]) }}" method="post">

              @method('PUT')
              @include('admin.pages.plans.details._partials.form')

            </form>
        </div>
    </div>
@stop