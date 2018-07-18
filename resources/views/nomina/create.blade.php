@extends('layouts.app')
@section('content')

<div class="centrado_900">
    <section class="row justify-content-center align-items-center  alineado_centro">
        <div class="col-11 col-sm-8">
            <h1>
                Crear Nomina
            </h1>
            <a href="{!!url('nomina')!!}" class = 'btn btn-success'><i class="fa fa-home"></i>VER LAS NOMINAS</a>
    <a href="{!!url('/home')!!}" class = 'btn btn-primary'><i class="fa fa-home"></i> Panel Administrador</a>
            <br>
            <form class="form-horizontal m-t-30" role="form" method="POST" action="{{ url('/nomina') }}" enctype="multipart/form-data" >
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('seller_id') ? ' has-error' : '' }}">
                    <label for="seller_id" class="col-md-12 control-label">Colaborador</label>
                    
                    <div class="col-12">
                        <select id='seller_id' class="form-control" name="seller_id">
                            <option value="" selected disabled style="display:none">Seleciona una colaborador</option>
                            @foreach($selers as $colaborador)
                                <option value="{{$colaborador->id}}">{{$colaborador->nombre}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('seller_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('seller_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                    <label for="fecha" class="col-md-12 control-label">FECHA</label>

                    <div class="col-12">
                        <input type="date" class="form-control" name="fecha" value="{{ old('fecha') }}" required autofocus>

                        @if ($errors->has('fecha'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fecha') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('pdf') ? ' has-error' : '' }}">
                    <label for="pdf" class="col-md-12 control-label">PDF</label>

                    <div class="col-12">
                        <input id="pdf" type="file" class="form-control" name="pdf" value="{{ old('pdf') }}" required>

                        @if ($errors->has('pdf'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pdf') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('xml') ? ' has-error' : '' }}">
                    <label for="xml" class="col-md-12 control-label">XML</label>

                    <div class="col-12">
                        <input id="xml" type="file" class="form-control" name="xml" value="{{ old('xml') }}" required>

                        @if ($errors->has('xml'))
                        <span class="help-block">
                            <strong>{{ $errors->first('xml') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>



                <div class="form-group">
                    <div class="col-md-12">
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