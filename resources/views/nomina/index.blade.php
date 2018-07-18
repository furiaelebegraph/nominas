@extends('layouts.app')
@section('title','Index')
@section('content')

<div class="centrado_900">
<section class="row justify-content-center align-items-center">
    <div class="col-11 col-sm-8">
    <h1>
        Nomina Index
    </h1>
    <a href='{!!url("nomina")!!}/create' class = 'btn btn-success'><i class="fa fa-plus"></i> CREAR NOMINA</a>
    <a href="{!!url('/home')!!}" class = 'btn btn-primary'><i class="fa fa-home"></i> Panel Administrador</a>
    <br>
    <br>
    @if(session()->has('mensaje'))
        <div class="alert alert-primary"> 
            {!! session('mensaje') !!}
        </div>
    @endif


    <div class="col-11">
        <div class='form-inline w-100' >
            <div class="form-group row">
                <div class="col-12">
                    <input type="text" class="form-control" :value='potato' @input="potato" >
                </div>
            </div>
            <button type="button" class="btn btn-primary mb-2" v-on:click="buscador" v-if="!loading">Buscar</button>
            <button type="button" class="btn btn-primary mb-2" disabled="disabled" v-if="loading">Buscar</button>
        </div>
    </div>
    <div class="col-11" id="app-2">
        <div class="alert alert-danger" role="alert" v-if='error'>
            <div aria-hidden=true> 
            </div>
            @{{error}}
        </div>
        <div class="row list-group" id="nominas">
            <div class="item col-12" v-for="nominaa in nominaas">
                <div class="row">
                    <div class="col-4">
                        @{{nominaa.fecha}}
                    </div>
                    <div class="col-4">
                        <a class='viewEdit btn btn-primary btn-xs'><i class = 'fa fa-edit'> Editar</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>fecha</th>
            <th>Colaborador</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($nominas as $nomina) 
            <tr>
                <td>{!!$nomina->fecha!!}</td>
                <td>{!!$nomina->seller['nombre']!!}</td>
                <td>
                    <form action="{{ route('nomina.destroy', ['id' => $nomina->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Eliminar</button>
                        </div>
                    </form>
                    <a href = "{{ route('nomina.edit', $nomina->id)}}" class = 'viewEdit btn btn-primary btn-xs'><i class = 'fa fa-edit'> Editar</i></a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/nomina/{!!$nomina->id!!}'><i class = 'fa fa-eye'> info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
    {!! $nominas->render() !!}
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="{{ asset('js/apps.js') }}"></script>

</div>
</section>
    
</div>
@endsection