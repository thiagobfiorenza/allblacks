@extends('torcedores.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Visualizar Torcedor</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('torcedores.index') }}"> Voltar</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {{ $torcedor->nome }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Documento:</strong>
                {{ $torcedor->documento }}
            </div>
        </div>
    </div>
@endsection