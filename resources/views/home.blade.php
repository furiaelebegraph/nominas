@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="panel">
                <div class="panel-heading">Panel Administrador</div>

                @if(session()->has('mensaje'))
                    <div class="alert alert-primary"> 
                        {!! session('mensaje') !!}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-sm-6">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Crear Nomina</h5>
                                <p class="card-text">Genera una nueva nomina para un colaborador</p>
                                <a href=" {{ url('nomina/create') }} " class = 'btn btn-primary'>Crear Nomina</a>
                              </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title">Crear Colaborador</h5>
                                <p class="card-text">Crea una nueva nueva cuenta</p>
                                <a href=" {{ url('seller/create') }} " class = 'btn btn-primary'>Crear Colaborador</a>
                              </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center m-t-50">
                    <div class="col-11 col-sm-12">
                        <table class = "table table-hover" style = 'background:#fff'>
                            <thead>
                                <th>#</th>
                                <th>fecha</th>
                                <th>colaborador</th>
                                <th>actions</th>
                            </thead>
                            <tbody>
                                @foreach($nominis as $nomina) 
                                <tr>
                                    <td>{!!$nomina->id!!}</td>
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
                                        <a href = "{{ route('nomina.edit', $nomina->id)}}" class = 'viewEdit btn btn-primary btn-xs'><i class = 'fa fa-edit'> edit</i></a>
                                        <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/nomina/{!!$nomina->id!!}'><i class = 'fa fa-eye'> info</i></a>
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                           {{ $nominis->links()}}
                        </nav>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
