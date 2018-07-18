@extends('layouts.app')
@section('title','Index')
@section('content')

<div class="centrado_900">
<section class="row justify-content-center align-items-center">
    <div class="col-11 col-sm-8">
    <h1>
        Colaboradores Index
    </h1>
    <a href='{!!url("seller")!!}/create' class = 'btn btn-success'><i class="fa fa-plus"></i> CREAR COLABORADOR</a>
    <a href="{!!url('/home')!!}" class = 'btn btn-primary'><i class="fa fa-home"></i> Panel Administrador</a>
    <br>
    @if(session()->has('mensaje'))
        <div class="alert alert-primary"> 
            {!! session('mensaje') !!}
        </div>
    @endif
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>Coloaborador</th>
            <th>Correo</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($sellers as $colaboradores)
            <tr>
                <td>{!!$colaboradores->nombre!!}</td>
                <td>{!!$colaboradores->correo!!}</td>
                <td>
                    <form action="{{ route('seller.destroy', ['id' => $colaboradores->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Eliminar</button>
                        </div>
                    </form>
                    <a href="{{ route('seller.edit', $colaboradores->id)}}" class = 'viewEdit btn btn-primary btn-xs'><i class = 'fa fa-edit'> edit</i></a>
                    <a href='#' class = 'viewShow btn btn-warning btn-xs' data-link = '/seller/{!!$colaboradores->id!!}'><i class = 'fa fa-eye'> info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $sellers->render() !!}

</div>
</section>
    
</div>
@endsection