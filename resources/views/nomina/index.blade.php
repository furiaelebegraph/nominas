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


    <div class="col-11">
        <form class='formularioBusqueda' action="{{ url('buscanomina') }}" method="GET" >
            <div class="form-group row">
                <div class="col-10">
                    <input type="text" class="form-control" name="buscador" >
                </div>
                <div class="col-2">
                    <input type="submit" value="Buscar" class='btn btn-primary'>
                </div>

            </div>
        </form>
    </div>
    <div class="col-11" id="app-2">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        @if(count($buscaNomina) > 0)
            <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
                <thead>
                    <th>fecha</th>
                    <th>Colaborador</th>
                    <th>actions</th>
                </thead>
                <tbody>
                        @foreach($buscaNomina as $empleado)
                        <tr>
                            <td>{!!$empleado->fecha!!}</td>
                            <td>{!!$empleado->seller['nombre']!!}</td>
                            <td>
                                <form action="{{ route('nomina.destroy', ['id' => $empleado->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Eliminar</button>
                                    </div>
                                </form>
                                <a href = "{{ route('nomina.edit', $empleado->id)}}" class = 'viewEdit btn btn-primary btn-xs'><i class = 'fa fa-edit'> Editar</i></a>
                                <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/nomina/{!!$empleado->id!!}'><i class = 'fa fa-eye'> info</i></a>
                            </td>
                        </tr>
                        @endforeach  
                        
            
                </tbody>
            </table>      
        @else
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
        @endif 
    </div>


    <script src="{{ asset('js/apps.js') }}"></script>

</div>
</section>
    
</div>
@endsection