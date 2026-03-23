<?php
require_once 'Config/Database.php';

try {
    $db = (new Database())->getConnection();

    // Criar tabela se não existir
    $sql = "
    CREATE TABLE IF NOT EXISTS clientes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL UNIQUE,
        telefone VARCHAR(30) DEFAULT NULL,
        endereco VARCHAR(255) DEFAULT NULL,
        criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    $db->exec($sql);

    // Verificar e adicionar colunas se necessário
    $columns = $db->query("DESCRIBE clientes")->fetchAll(PDO::FETCH_ASSOC);
    $existingColumns = array_column($columns, 'Field');

    if (!in_array('telefone', $existingColumns)) {
        $db->exec("ALTER TABLE clientes ADD COLUMN telefone VARCHAR(30) DEFAULT NULL");
    }
    if (!in_array('endereco', $existingColumns)) {
        $db->exec("ALTER TABLE clientes ADD COLUMN endereco VARCHAR(255) DEFAULT NULL");
    }
    if (!in_array('criado_em', $existingColumns)) {
        $db->exec("ALTER TABLE clientes ADD COLUMN criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
    }

    // Limpar dados existentes e inserir novos
    $db->exec("DELETE FROM clientes");

    $seed = "
    INSERT INTO clientes (nome, email, telefone, endereco) VALUES
    ('Jorge','jorge@gmail.com','11111111111','Rua General Osório'),
    ('Maria','maria@gmail.com','22222222222','Avenida Coronel Theodomiro Porto da Fonseca'),
    ('Pedro','pedro@gmail.com','33333333333','Rua Sepé Tiaraju'),
    ('Carlos','carlos@gmail.com','44444444444','Rua Pirelli Sul'),
    ('Arthur','arthur@gmail.com','55555555555','Rua Canoas');
    ";
    $db->exec($seed);

    echo 'Configuração finalizada: tabela clientes criada/atualizada e dados inseridos.';
} catch (PDOException $e) {
    echo 'Erro no setup: ' . $e->getMessage();
}
