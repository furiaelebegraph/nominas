@extends('seller.layouts')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="row justify-content-center panel panel-success">
                <div class="col-12">
                    @if($lolo->count() > 0)
                        @foreach($lolo->nomina as $supernomina)
                        potato
                        @endforeach
                    @else
                        <div class="panel-heading">
                            No sea encontrado ningun elemento
                        </div>
                    @endif
                    
                </div>

                <div class="panel-body">
                   Holis
                </div>
            </div>
        </div>
    </div>
</div>
@endsection