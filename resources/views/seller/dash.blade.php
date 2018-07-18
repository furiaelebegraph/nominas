@extends('seller.layouts')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="row justify-content-center panel panel-success">
                <div class="col-12">
                    @if($nominis->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">PDF</th>
                                <th scope="col">XML</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($nominis->nominas as $supernomina)
                            <tr>
                                <td> {{ $supernomina->id }} </td>
                                <td> {{ $supernomina->fecha }} </td>
                                <td> <a download href="{{ asset('img/'.$supernomina->pdf) }}">Descargar PDF</a></td>
                                <td> <a download href="{{ asset('img/'.$supernomina->xml) }}"> Descargar XML</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        @else
                        <div class="panel-heading">
                            No sea encontrado ningun elemento
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection