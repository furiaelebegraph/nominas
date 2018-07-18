@extends('seller.layouts')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel alineado_centro">
                @if($errors->any())
                <h4>{{$errors->first()}}</h4>
                @endif
               @if (session('mensaje'))
                    <div class="alert alert-success">
                            <strong>{{ session('mensaje') }}</strong> 
                    </div>
               @endif
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/seller_login') }}">
                        {{ csrf_field() }}
                        <div class="row justify-content-center">
                            
                            <div class="col-12 form-group{{ $errors->has('correo') ? ' has-error' : '' }}">
                                                        <label for="correo" class="col-md-4 control-label">E-Mail</label>

                                                        <div class="col-md-6">
                                                            <input id="correo" type="correo" class="form-control" name="correo" value="{{ old('correo') }}" required autofocus>

                                                            @if ($errors->has('correo'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('correo') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-12 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                        <label for="password" class="col-md-4 control-label">Password</label>

                                                        <div class="col-md-6">
                                                            <input id="password" type="password" class="form-control" name="password" required>

                                                            @if ($errors->has('password'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>



                                                    <div class="col-12 form-group p-t-20">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn_pedorro btn-default">
                                                                Inicar Sesión
                                                            </button>

                                                        </div>
                                                    </div>                        
                                                    <div class="col-12 form-group  alineado_centro">
                                                        <div class="col-md-12">

                                                            <a class="btn btn-link" href="{{ url('/seller_password/reset') }}">
                                                                ¿Olvidaste tu Password?
                                                            </a>
                                                        </div>
                                                    </div>


                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
