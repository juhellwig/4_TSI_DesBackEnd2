<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            text-align: center;
            background-color: #f9f9f9;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            font-size: 1.1em;
            margin-bottom: 30px;
        }

        .links {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            border: 1px solid #333;
            border-radius: 5px;
            font-size: 1em;
            color: #007bff;
            background-color: #e7f3ff;
            transition: all 0.2s ease;
        }

        a:hover {
            opacity: 0.8;
        }

        footer {
            margin-top: 40px;
            font-size: 0.9em;
            color: #777;
        }
    </style>
</head>

<body>
    <h1>Bem-vindo ao Sistema de Monitoramento de Saúde</h1>
    <p>Escolha uma das opções abaixo para acessar os cadastros e monitoramentos:</p>

    <div class="links">
        <a href="/usuarios">Lista de Usuários</a>
        <a href="/enderecos">Lista de Endereços</a>
        <a href="/monitoramentos">Lista de Monitoramentos</a>
    </div>

    <footer>
        <p>© {{ date('Y') }} Sistema de Saúde Integrado</p>
    </footer>
</body>

</html>
