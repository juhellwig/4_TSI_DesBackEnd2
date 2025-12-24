@use Illuminate\Support\Str;

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
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

        img {
            width: 60px;
            height: auto;
        }
    </style>
</head>

<body>
    <h1>Usuários</h1>

    @if ($listUsuarios->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listUsuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ ucfirst($usuario->tipo_usuario) }}</td>
                        <td>
                            @if ($usuario->imagem)
                                @if (Str::startsWith($usuario->imagem, 'http'))
                                    <img src="{{ $usuario->imagem }}" alt="Imagem de {{ $usuario->name }}" width="80">
                                @else
                                    <img src="{{ asset('imagens/' . $usuario->imagem) }}" alt="Imagem de {{ $usuario->name }}" width="80">
                                @endif
                            @else
                                <em>Sem imagem</em>
                            @endif
                        </td>
                        <td>
                            <!-- Botão Editar -->
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-edit">Editar</a>

                            <!-- Botão Excluir -->
                            <form action="{{ route('usuarios.delete', $usuario->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete"
                                    onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum usuário encontrado!</p>
    @endif

    <br>
    <a href="usuarios/create">Criar novo usuário</a>
    <br>
    <br>
    <a href="/enderecos">Listagem de endereços</a>
    <br>
    <br>
    <a href="/monitoramentos">Listagem de monitoramentos</a>
    <br>
    <br>
    <a href="/">Voltar para a tela inicial/Login</a>

</body>

</html>