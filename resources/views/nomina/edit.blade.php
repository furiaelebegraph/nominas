@extends('layouts.app')
@section('title','Edit')
@section('content')
<div class="centrado_900">
<section class="row justify-content-center align-items-center alinado_centro">
    <div class="col-11 col-sm-8">
    <h1>
        Edit nomina
    </h1>
    <a href="{!!url('nomina')!!}" class = 'btn btn-primary'><i class="fa fa-home"></i> Nomina Index</a>
    <br>
    <form class='m-t-30' method = 'POST' action = '{!! url("nomina")!!}/{!!$nomina->id!!}/update' enctype="multipart/form-data"> 
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('seller_id') ? ' has-error' : '' }}">
                <label for="seller_id" class="col-md-12 control-label">Colaborador</label>
                
                <div class="col-12">
                    <select id='seller_id' class="form-control" name="seller_id">
                        <option selected="selected" value="{{$nomina->seller_id}} selected disabled style="display:none">{{$nomina->seller->nombre}}</option>
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
                    <input type="date" class="form-control" name="fecha" value="{!!$nomina->fecha!!}" autofocus>

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
                    <input id="pdf" type="file" class="form-control" name="pdf" value="{!!$nomina->pdf!!}">

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
                    <input id="xml" type="file" class="form-control" name="xml" value="{!!$nomina->xml!!}" required>

                    @if ($errors->has('xml'))
                    <span class="help-block">
                        <strong>{{ $errors->first('xml') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button class = 'btn_pedorro btn-default' type ='submit'><i class="fa fa-floppy-o"></i> Actualizar</button>
                </div>
            </div>
    </form>
</div>
</section>
    
</div>
@endsection