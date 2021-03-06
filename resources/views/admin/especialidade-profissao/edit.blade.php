@extends('adminlte::page')

@section('title', 'Atualizar uma especialidade a uma profissão')

@section('content_header')
    <h1>Atualizar uma especialidade a uma profissão</h1>
@stop

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <form method="POST" action="{{-- url('especialidade', [$especialidade->id]) --}}">
        {!! csrf_field() !!}
        {{ method_field('PUT') }}
        <div class="form-group">
            <div class=" row">
                <div class="col-sm-3">
                    <label for="name">Nome</label>
                    <input type="text" value="" name="nome" placeholder="Nome" class="form-control">
                </div>
                <div class="col-sm-3">
                    <label for="name">Descrição</label>
                    <input type="text" value="" name="descricao" placeholder="Descrição" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">Atualizar</button>
        </div>
    </form>


@stop