<?php
require_once 'dao/ClienteDAO.php';
require_once 'models/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = new Cliente();
    $cliente->nome = $_POST['nome'] ?? '';
    $cliente->email = $_POST['email'] ?? '';
    $cliente->telefone = $_POST['telefone'] ?? '';
    $cliente->endereco = $_POST['endereco'] ?? '';

    $clienteDAO = new ClienteDAO();
    $clienteDAO->create($cliente);

    header('Location: clientes.php');
    exit;
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Cadastrar Novo Cliente</h1>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone">

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco">

        <button type="submit">Cadastrar</button>
    </form>
    <p><a href="clientes.php">Voltar para lista de clientes</a></p>
</body>
</html>