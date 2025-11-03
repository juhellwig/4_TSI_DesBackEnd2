<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Endereços</title>
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
    <h1>Endereços</h1>

    @if ($listEnderecos->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CEP</th>
                    <th>Logradouro</th>
                    <th>Número</th>
                    <th>Complemento</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>País</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listEnderecos as $endereco)
                    <tr>
                        <td>{{ $endereco->id }}</td>
                        <td>{{ $endereco->cep }}</td>
                        <td>{{ $endereco->logradouro }}</td>
                        <td>{{ $endereco->numero }}</td>
                        <td>{{ $endereco->complemento }}</td>
                        <td>{{ $endereco->bairro }}</td>
                        <td>{{ $endereco->cidade }}</td>
                        <td>{{ $endereco->estado }}</td>
                        <td>{{ $endereco->pais }}</td>
                        <td>
                            <!-- Botão Editar -->
                            <a href="{{ route('enderecos.edit', $endereco->id) }}" class="btn btn-edit">Editar</a>

                            <!-- Botão Excluir -->
                            <form action="{{ route('enderecos.destroy', $endereco->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete"
                                    onclick="return confirm('Tem certeza que deseja excluir este endereço?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum endereço encontrado!</p>
    @endif

    <br>
    <a href="/enderecos/create">Inserir novo endereco</a>
    <br>
    <br>
    <a href="/usuarios">Voltar para a lista de Usuarios</a>
</body>

</html>