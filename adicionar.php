<?php
// Iniciar a sessão
session_start();

// Verificar se os dados do produto foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $qtd = $_POST['qtd'];
    
    // Se o carrinho não existir ainda, cria-lo
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Verificar se o produto já existe no carrinho
    if (isset($_SESSION['carrinho'][$id])) {
        // Se o produto já estiver no carrinho, aumenta a quantidade
        $_SESSION['carrinho'][$id]['qtd'] += $qtd;
    } else {
        // Caso contrário, adiciona o produto ao carrinho
        $_SESSION['carrinho'][$id] = [
            'nome' => $nome,
            'preco' => $preco,
            'qtd' => $qtd
        ];
    }
}

header('Location: carrinho.php');
exit;
