<?php
require_once "classes/Cliente.php";
require_once "classes/Produto.php";
require_once "classes/Pedido.php";

// 2. Criar cliente
$cliente = new Cliente(1, "João Silva", "joao@email.com");

// 3. Criar produtos
$produto1 = new Produto(1, "Notebook", 3500.00);
$produto2 = new Produto(2, "Mouse Gamer", 150.00);
$produto3 = new Produto(3, "Headset", 280.00);

// 4. Criar pedido
$pedido = new Pedido(1001, $cliente);

// 5. Adicionar produtos ao pedido
$pedido->adicionarProduto($produto1);
$pedido->adicionarProduto($produto2);
$pedido->adicionarProduto($produto3);

// 6. Calcular total
$totalPedido = $pedido->calcularTotal();
?>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>🛒 Projeto Integrador em PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>🛒 Projeto Integrador em PHP</h1>
        <p>📌 Sistema de Pedidos de uma Loja</p>
    </header>

    <section class="resumo">
        <h2>Pedido Nº <?= htmlspecialchars($pedido->getNumero()) ?></h2>
        <div class="box">
            <h3>Cliente</h3>
            <p><strong>Nome:</strong> <?= htmlspecialchars($cliente->getNome()) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($cliente->getEmail()) ?></p>
        </div>

        <div class="box">
            <h3>Produtos</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Preço</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedido->getProdutos() as $produto) : ?>
                    <tr>
                        <td><?= htmlspecialchars($produto->getId()) ?></td>
                        <td><?= htmlspecialchars($produto->getNome()) ?></td>
                        <td>R$ <?= number_format($produto->getPreco(), 2, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="box total">
            <h3>Total do Pedido</h3>
            <p>R$ <?= number_format($totalPedido, 2, ',', '.') ?></p>
        </div>

        <div class="box resumo-texto">
            <h3>Resumo Gerado</h3>
            <pre><?= nl2br(htmlspecialchars($pedido->exibirResumo())) ?></pre>
        </div>
    </section>

    <footer>
        <p>Desenvolvido com PHP orientado a objetos e CSS responsivo.</p>
    </footer>
</body>
</html>