<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Monitoramentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #f3f3f3;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        h1 {
            color: #333;
        }

        .btn {
            padding: 4px 8px;
            text-decoration: none;
            border: 1px solid #333;
            border-radius: 3px;
            margin-right: 5px;
            font-size: 0.9em;
        }

        .btn-edit {
            background-color: #e7f3ff;
            color: #007bff;
        }

        .btn-delete {
            background-color: #ffe7e7;
            color: #d9534f;
            border-color: #d9534f;
        }

        .btn-delete:hover,
        .btn-edit:hover {
            opacity: 0.8;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body>
    <h1>Monitoramentos</h1>

    @if ($listMonitoramentos->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Tipo</th>
                    <th>Observações</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listMonitoramentos as $monitoramento)
                    <tr>
                        <td>{{ $monitoramento->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($monitoramento->dt_monitoramento)->format('d/m/Y') }}</td>
                        <td>{{ $monitoramento->hora_monitoramento }}</td>
                        <td>{{ $monitoramento->tipo }}</td>
                        <td>{{ $monitoramento->observacoes }}</td>
                        <td>
                            <!-- Botão Editar -->
                            <a href="{{ route('monitoramentos.edit', $monitoramento->id) }}" class="btn btn-edit">Editar</a>

                            <!-- Botão Excluir -->
                            <form action="{{ route('monitoramentos.destroy', $monitoramento->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete"
                                    onclick="return confirm('Tem certeza que deseja excluir este monitoramento?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum monitoramento encontrado!</p>
    @endif

    <br>
    <a href="/monitoramentos/create">Criar novo monitoramento</a>
    <br>
    <br>
    <a href="../usuarios">Voltar para a lista de Usuários</a>

</body>

</html>