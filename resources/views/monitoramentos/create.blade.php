<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Monitoramento</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 500px; }
        label { display: block; margin-top: 10px; }
        input, select, textarea { width: 100%; padding: 6px; margin-top: 4px; }
        button { margin-top: 15px; padding: 8px 12px; }
        .error { color: red; font-size: 0.9em; }
    </style>
</head>
<body>
    <h1>Cadastrar Monitoramento</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('monitoramentos.store') }}" method="POST">
        @csrf

        <label>Data
            <input type="date" name="dt_monitoramento" value="{{ old('dt_monitoramento') }}">
        </label>

        <label>Hora
            <input type="time" name="hora_monitoramento" value="{{ old('hora_monitoramento') }}">
        </label>

        <label>Tipo
            <select name="tipo">
                <option value="Diabetes" {{ old('tipo')=='Diabetes' ? 'selected' : '' }}>Diabetes</option>
                <option value="Hipertensao" {{ old('tipo')=='Hipertensao' ? 'selected' : '' }}>Hipertensão</option>
                <option value="Outra" {{ old('tipo')=='Outra' ? 'selected' : '' }}>Outra</option>
            </select>
        </label>

        <label>Observações
            <textarea name="observacoes" rows="3">{{ old('observacoes') }}</textarea>
        </label>

        <button type="submit">Cadastrar</button>
    </form>

    <br>
    <a href="/monitoramentos">Voltar para a lista de monitoramentos</a>
</body>
</html>