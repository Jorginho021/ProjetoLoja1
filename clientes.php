<?php
require_once 'dao/ClienteDAO.php';

$clienteDAO = new ClienteDAO();
$clientes = $clienteDAO->getAll();
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Clientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Clientes</h1>
<p><a href="cadastro_cliente.php">Cadastrar Novo Cliente</a></p>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Endereço</th>
        <th>Criado</th>
    </tr>
    <?php foreach ($clientes as $c): ?>
    <tr>
        <td><?= htmlspecialchars($c['nome']) ?></td>
        <td><?= htmlspecialchars($c['email']) ?></td>
        <td><?= htmlspecialchars($c['telefone'] ?? '') ?></td>
        <td><?= htmlspecialchars($c['endereco'] ?? '') ?></td>
        <td><?= htmlspecialchars($c['criado_em'] ?? '') ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
