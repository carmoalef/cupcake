<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cupcakes</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
<?php
include('navbar.php'); 
include('src/conexao-bd.php');
// Iniciar a sessão
session_start();

$nome_cliente = $_POST['nome'];
$email_cliente = $_POST['email'];
$carrinho = $_SESSION['carrinho'];
foreach ($carrinho as $id => $item) {
    // Verificar se o produto existe
    $sql1 = "SELECT * FROM produtos";
    $stmt = $pdo->query($sql1);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
  
    if ($produto) {
        // Inserir o item no carrinho
   
        $stmt = $pdo->prepare("INSERT INTO itens_carrinho (id_produto, nome_produto, preco, quantidade) 
        VALUES (?, ?, ?, ?)");
        $stmt->execute([$produto['id'], $item['nome'], $item['preco'], $item['qtd']]);
     
    } else {
        // Produto não encontrado
        echo "Produto com ID $id não encontrado!";
    }
}
 
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "<p>Seu carrinho está vazio. Não foi possível concluir a compra.</p>";
    echo '<a href="index.php">Voltar para a loja</a>';
    exit;
}
?>

<br>
<div class="container">
    <br>
<h2>Resumo do Pedido, <?=$nome_cliente?> </h2>
<table border="1" class="table" cellpadding="10">
    <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Preço Unitário</th>
        <th>Total</th>
    </tr>
    <?php
    $total = 0;
    foreach ($_SESSION['carrinho'] as $id => $item) {
        echo "<tr>";
        echo "<td>" . $item['nome'] . "</td>";
        echo "<td>" . $item['qtd'] . "</td>";
        echo "<td>R$ " . number_format($item['preco'], 2, ',', '.') . "</td>";
        echo "<td>R$ " . number_format($item['preco'] * $item['qtd'], 2, ',', '.') . "</td>";
        echo "</tr>";
        $total += $item['preco'] * $item['qtd'];
    }
    ?>
</table>
    <div class="d-flex justify-content-end">
        <h3>Total do Pedido: R$ <?php echo number_format($total, 2, ',', '.'); ?></h3>
    </div>
    <br>
    <div class="alert alert-success" role="alert">
        Obrigada por Comprar Conosco! <a href="index.php" class="alert-link">Experimente mais cupcakes</a>
    </div>
</div>
<?php
session_unset();
session_destroy();
?>