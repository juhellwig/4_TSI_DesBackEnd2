<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Endereço</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 500px; }
        label { display: block; margin-top: 10px; }
        input { width: 100%; padding: 6px; margin-top: 4px; }
        button { margin-top: 15px; padding: 8px 12px; }
        .error { color: red; font-size: 0.9em; }
    </style>
</head>
<body>
    <h1>Editar Endereço</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('enderecos.update', $endereco->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>CEP
            <input type="text" name="cep" value="{{ old('cep', $endereco->cep) }}" maxlength="8">
        </label>

        <label>Logradouro
            <input type="text" name="logradouro" value="{{ old('logradouro', $endereco->logradouro) }}" maxlength="100">
        </label>

        <label>Número
            <input type="number" name="numero" value="{{ old('numero', $endereco->numero) }}">
        </label>

        <label>Complemento
            <input type="text" name="complemento" value="{{ old('complemento', $endereco->complemento) }}" maxlength="50">
        </label>

        <label>Bairro
            <input type="text" name="bairro" value="{{ old('bairro', $endereco->bairro) }}" maxlength="50">
        </label>

        <label>Cidade
            <input type="text" name="cidade" value="{{ old('cidade', $endereco->cidade) }}" maxlength="50">
        </label>

        <label>Estado
            <input type="text" name="estado" value="{{ old('estado', $endereco->estado) }}" maxlength="2">
        </label>

        <label>País
            <input type="text" name="pais" value="{{ old('pais', $endereco->pais) }}" maxlength="30">
        </label>

        <button type="submit">Atualizar</button>
    </form>

    <br>
    <a href="/enderecos">Voltar para a lista de Enderecos</a>
</body>
</html>