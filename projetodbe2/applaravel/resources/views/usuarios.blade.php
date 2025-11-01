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
                    <th>Data Nasc.</th>
                    <th>Sexo</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Tipo Usuário</th>
                    <th>Data Cadastro</th>
                    <th>Imagem</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listUsuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nomeusuario }}</td>
                        <td>{{ \Carbon\Carbon::parse($usuario->dtnasc)->format('d/m/Y') }}</td>
                        <td>{{ $usuario->sexo }}</td>
                        <td>{{ $usuario->cpf }}</td>
                        <td>{{ $usuario->telefone }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ ucfirst($usuario->tipo_usuario) }}</td>
                        <td>{{ \Carbon\Carbon::parse($usuario->datacadastro)->format('d/m/Y H:i') }}</td>
                        <td>
                            @if ($usuario->imagem)
                                <img src="{{ asset('imagens/' . $usuario->imagem) }}" alt="Imagem de {{ $usuario->nomeusuario }}"
                                    width="60">
                            @else
                                <em>Sem imagem</em>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Nenhum usuário encontrado!</p>
    @endif

</body>

</html>
