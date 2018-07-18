@extends('seller.layouts')

@section('content')
<div class="centro_900">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="panel panel-default justificado_centrado m-t-20 m-b-20">
                <h1 class='m-t-30 m-b-30'>BIENVENIDO</h1>
                <div class="row justify-content-center align-items-center">
                	<div class="col-12 col-sm-5 m-t-30 m-b-30">
                		<a class="btn_pedorro btn-default" href="{{ route('seller_login') }}">
                			Iniciar Sesion
                		</a>
                	</div>
                	<div class="col-12 col-sm-5 m-t-30 m-b-30">
                		<a class="btn_pedorro" href="{{ route('seller_register') }}">
                			Registrate
                		</a>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection