<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            max-width: 500px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 6px;
            margin-top: 4px;
            box-sizing: border-box;
        }

        button {
            margin-top: 15px;
            padding: 6px 12px;
            border: none;
            border-radius: 3px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        img {
            margin-top: 5px;
            max-width: 100px;
            height: auto;
            display: block;
        }
    </style>
</head>

<body>
    <h1>Editar Usuário</h1>

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="nomeusuario">Nome</label>
        <input type="text" name="nomeusuario" id="nomeusuario" value="{{ $usuario->nomeusuario }}" required>

        <label for="dtnasc">Data de Nascimento</label>
        <input type="date" name="dtnasc" id="dtnasc" value="{{ $usuario->dtnasc }}" required>

        <label for="sexo">Sexo</label>
        <select name="sexo" id="sexo" required>
            <option value="M" {{ $usuario->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
            <option value="F" {{ $usuario->sexo == 'F' ? 'selected' : '' }}>Feminino</option>
        </select>

        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" value="{{ $usuario->cpf }}" required>

        <label for="telefone">Telefone</label>
        <input type="text" name="telefone" id="telefone" value="{{ $usuario->telefone }}" required>

        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" value="{{ $usuario->email }}" required>

        <label for="tipo_usuario">Tipo de Usuário</label>
        <select name="tipo_usuario" id="tipo_usuario" required>
            <option value="paciente" {{ $usuario->tipo_usuario == 'paciente' ? 'selected' : '' }}>Paciente</option>
            <option value="profissional" {{ $usuario->tipo_usuario == 'profissional' ? 'selected' : '' }}>Profissional</option>
            <option value="administrador" {{ $usuario->tipo_usuario == 'administrador' ? 'selected' : '' }}>Administrador</option>
        </select>

        <label for="password">Senha</label>
        <input type="text" name="password" id="password" value="{{ $usuario->password }}" required>

        <label for="datacadastro">Data de Cadastro</label>
        <input type="datetime-local" name="datacadastro" id="datacadastro"
            value="{{ \Carbon\Carbon::parse($usuario->datacadastro)->format('Y-m-d\TH:i') }}" required>

        <label for="imagem">Imagem</label>
        <input type="file" name="imagem" id="imagem">
        @if ($usuario->imagem)
            <img src="{{ asset('imagens/' . $usuario->imagem) }}" alt="Imagem de {{ $usuario->nomeusuario }}">
        @endif

        <button type="submit">Salvar Alterações</button>
    </form>

    <br>
    <a href="{{ route('usuarios.lista') }}">Voltar à lista de usuários</a>
</body>

</html>