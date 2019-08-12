@extends('clients.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Editar Torcedor - All Blacks</h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('clients.index') }}"> Voltar</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Houve algum problema.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="name">Nome*:</label>
                    <input type="text" name="name" value="{{ $client->name }}" class="form-control" placeholder="Nome">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="document">Documento*:</label>
                    <input type="text" name="document" value="{{ $client->document }}" class="form-control" placeholder="Documento">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="postcode">CEP*:</label>
                    <input type="text" name="postcode" value="{{ $client->postcode }}" class="form-control" placeholder="CEP">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="address">Endereço*:</label>
                    <input type="text" name="address" value="{{ $client->address }}" class="form-control" placeholder="Endereço">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="district">Bairro*:</label>
                    <input type="text" name="district" value="{{ $client->district }}" class="form-control" placeholder="Bairro">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="city">Cidade*:</label>
                    <input type="text" name="city" value="{{ $client->city }}" class="form-control" placeholder="Cidade">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="state">UF*:</label>
                    <select name="state" class="form-control" title="UF">
                        <option value="">Selecione</option>
                        <option value="AC"{{ $client->state == 'AC' ? ' selected' : ''}}>Acre</option>
                        <option value="AL"{{ $client->state == 'AL' ? ' selected' : ''}}>Alagoas</option>
                        <option value="AP"{{ $client->state == 'AP' ? ' selected' : ''}}>Amapá</option>
                        <option value="AM"{{ $client->state == 'AM' ? ' selected' : ''}}>Amazonas</option>
                        <option value="BA"{{ $client->state == 'BA' ? ' selected' : ''}}>Bahia</option>
                        <option value="CE"{{ $client->state == 'CE' ? ' selected' : ''}}>Ceará</option>
                        <option value="DF"{{ $client->state == 'DF' ? ' selected' : ''}}>Distrito Federal</option>
                        <option value="ES"{{ $client->state == 'ES' ? ' selected' : ''}}>Espírito Santo</option>
                        <option value="GO"{{ $client->state == 'GO' ? ' selected' : ''}}>Goiás</option>
                        <option value="MA"{{ $client->state == 'MA' ? ' selected' : ''}}>Maranhão</option>
                        <option value="MT"{{ $client->state == 'MT' ? ' selected' : ''}}>Mato Grosso</option>
                        <option value="MS"{{ $client->state == 'MS' ? ' selected' : ''}}>Mato Grosso do Sul</option>
                        <option value="MG"{{ $client->state == 'MG' ? ' selected' : ''}}>Minas Gerais</option>
                        <option value="PA"{{ $client->state == 'PA' ? ' selected' : ''}}>Pará</option>
                        <option value="PB"{{ $client->state == 'PB' ? ' selected' : ''}}>Paraíba</option>
                        <option value="PR"{{ $client->state == 'PR' ? ' selected' : ''}}>Paraná</option>
                        <option value="PE"{{ $client->state == 'PE' ? ' selected' : ''}}>Pernambuco</option>
                        <option value="PI"{{ $client->state == 'PI' ? ' selected' : ''}}>Piauí</option>
                        <option value="RJ"{{ $client->state == 'RJ' ? ' selected' : ''}}>Rio de Janeiro</option>
                        <option value="RN"{{ $client->state == 'RN' ? ' selected' : ''}}>Rio Grande do Norte</option>
                        <option value="RS"{{ $client->state == 'RS' ? ' selected' : ''}}>Rio Grande do Sul</option>
                        <option value="RO"{{ $client->state == 'RO' ? ' selected' : ''}}>Rondônia</option>
                        <option value="RR"{{ $client->state == 'RR' ? ' selected' : ''}}>Roraima</option>
                        <option value="SC"{{ $client->state == 'SC' ? ' selected' : ''}}>Santa Catarina</option>
                        <option value="SP"{{ $client->state == 'SP' ? ' selected' : ''}}>São Paulo</option>
                        <option value="SE"{{ $client->state == 'SE' ? ' selected' : ''}}>Sergipe</option>
                        <option value="TO"{{ $client->state == 'TO' ? ' selected' : ''}}>Tocantins</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="telephone">Telefone:</label>
                    <input type="text" name="telephone" value="{{ $client->telephone }}" class="form-control" placeholder="Telefone">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="text" name="email" value="{{ $client->email }}" class="form-control" placeholder="E-mail">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="active">Status:</label>
                    <select name="active" value="{{ $client->active }}" class="form-control" title="Status">
                        <option value="1"{{ $client->active ? ' selected' : ''}}>Ativo</option>
                        <option value="0"{{ !$client->active ? ' selected' : ''}}>Inativo</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>

    </form>
@endsection