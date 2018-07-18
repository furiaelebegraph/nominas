@extends('layouts.app')
@section('title','Edit')
@section('content')

<div class="centrado_900">
<section class="row justify-content-center align-items-center alineado_centro">
    <div class="col-11 col-sm-8">
    <h1>
        Editar Colaboradores
    </h1>
    <a href="{!!route('seller.index')!!}" class = 'btn btn-danger'><i class="fa fa-home"></i> Index Colaboradores </a>
    <a href="{!!url('/home')!!}" class = 'btn btn-primary'><i class="fa fa-home"></i> Panel Administrador</a>
    <br>
<form class="form-horizontal" role="form" method="POST" action='{!! url("seller")!!}/{!!$colaborador->id!!}/update'>
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
            <label for="nombre" class="col-md-12 control-label">Nombre</label>

            <div class="col-12">
                <input id="nombre" type="text" class="form-control" name="nombre" value="{!!$colaborador->nombre!!}" required autofocus>

                @if ($errors->has('nombre'))
                <span class="help-block">
                    <strong>{{ $errors->first('nombre') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('correo') ? ' has-error' : '' }}">
            <label for="correo" class="col-md-12 control-label">Correo Electronico</label>

            <div class="col-12">
                <input id="correo" type="email" class="form-control" name="correo" value="{!!$colaborador->correo!!}" required>

                @if ($errors->has('correo'))
                <span class="help-block">
                    <strong>{{ $errors->first('correo') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
            <label for="telefono" class="col-md-12 control-label">Telefono</label>

            <div class="col-12">
                <input id="telefono" type="tel" class="form-control" name="telefono" value="{!!$colaborador->telefono!!}" required>

                @if ($errors->has('telefono'))
                <span class="help-block">
                    <strong>{{ $errors->first('telefono') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
            <label for="direccion" class="col-md-12 control-label">Direccion</label>

            <div class="col-12">
                <input id="direccion" type="text" class="form-control" name="direccion" value="{!!$colaborador->direccion!!}" required>

                @if ($errors->has('direccion'))
                <span class="help-block">
                    <strong>{{ $errors->first('direccion') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('nss') ? ' has-error' : '' }}">
            <label for="nss" class="col-md-12 control-label">Numero de Seguro Social</label>
            <div class="col-12">
                <input id="nss" type="text" class="form-control" name="nss" value="{!!$colaborador->nss!!}" required>

                @if ($errors->has('nss'))
                <span class="help-block">
                    <strong>{{ $errors->first('nss') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-12">
                <button type="submit" class="btn_pedorro btn-default">
                    Registrar
                </button>
            </div>
        </div>
</form>
</div>
</section>
    
</div>
@endsection