<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { max-width: 500px; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 6px; margin-top: 4px; }
        button { margin-top: 15px; padding: 8px 12px; }
    </style>
</head>

<body>
    <h1>Cadastrar Usuário</h1>

    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nome
            <input type="text" name="name">
        </label>

        <label>Data de Nascimento
            <input type="date" name="dtnasc">
        </label>

        <label>Sexo
            <select name="sexo">
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
            </select>
        </label>

        <label>CPF
            <input type="text" name="cpf" maxlength="11">
        </label>

        <label>Telefone
            <input type="text" name="telefone">
        </label>

        <label>Email
            <input type="email" name="email">
        </label>

        <label>Tipo de Usuário
            <select name="tipo_usuario">
                <option value="paciente">Paciente</option>
                <option value="profissional">Profissional</option>
                <option value="administrador">Administrador</option>
            </select>
        </label>

        <label>Senha
            <input type="text" name="password">
        </label>

        <label>Data de Cadastro
            <input type="datetime-local" name="datacadastro" id="datacadastro"
            value="{{ old('datacadastro', \Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}">

        </label>


        <label>Imagem
            <input type="file" name="imagem" accept="image/*">
        </label>

        <button type="submit">Cadastrar</button>
    </form>

    <br>
    <a href="/usuarios">Voltar para a listagem de usuarios</a>
</body>

</html>