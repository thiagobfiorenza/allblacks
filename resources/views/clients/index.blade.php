@extends('clients.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>All Blacks</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('clients.create') }}"> Novo Torcedor</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Documento</th>
            <th>Cidade</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($clients as $client)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->document }}</td>
                <td>{{ $client->city . ' -' . $client->state}}</td>
                <td>{{ $client->telephone}}</td>
                <td>{{ $client->email}}</td>
                <td>{{ $client->active ? 'Ativo' : 'Inativo'}}</td>
                <td>
                    <form action="{{ route('clients.destroy',$client->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('clients.show',$client->id) }}">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>

                        <a class="btn btn-primary" href="{{ route('clients.edit',$client->id) }}">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                {!! $clients->links() !!}
            </div>
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('clients.import') }}">Importar XML</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('clients.export') }}">Exportar Excel</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-info" href="{{ route('clients.send') }}">Enviar Comunicado</a>
            </div>
        </div>
    </div>



@endsection