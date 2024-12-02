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
include('src/conexao-bd.php');
// Iniciar a sessão
session_start();

// Verificar se o carrinho existe
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    include('navbar.php');
    echo "<br>";
    echo "<div class='container'>";
        echo "<div class='alert alert-warning'>";
        echo "<p>Seu carrinho está vazio!</p>";
        echo '<a href="index.php">Voltar para a loja</a>';
    echo "</div>";
    exit;
}
if (isset($_GET['remover'])) {
    $id_remover = $_GET['remover'];
    unset($_SESSION['carrinho'][$id_remover]);
    // Redireciona para a mesma página para atualizar o carrinho
    header('Location: carrinho.php');
    exit;
}

// Calcular o valor total
$total = 0;
?>


  <?php 
  include('navbar.php'); 
   
  ?>
<body>

<br>
<div  class="container">
<h3>Carrinho de Compras</h3>
<br>
<form action="finaliza_compra.php" method="POST">

<table border="1" class="table" cellpadding="10">
    <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Preço Unitário</th>
        <th>Total</th>
        <th>Deletar</th>
    </tr>
 
   
    <?php 
    foreach ($_SESSION['carrinho'] as $id => $item): 
        
       ?>
       
        <input type="hidden" name="carrinho[<?php echo $id; ?>][nome]" value="<?php echo $item['nome']; ?>">
            <input type="hidden" name="carrinho[<?php echo $id; ?>][qtd]" value="<?php echo $item['qtd']; ?>">
            <input type="hidden" name="carrinho[<?php echo $id; ?>][preco]" value="<?php echo $item['preco']; ?>">
            
        <tr>
            <td><?php echo $item['nome']; ?></td>
            <td><?php echo $item['qtd']; ?></td>
            <td>R$ <?php echo $item['preco']; ?></td>
            <td>R$ <?php echo number_format($item['preco'] * $item['qtd'], 2, ',', '.'); ?></td>
            <td><a href="?remover=<?php echo $id; ?>">Remover</a></td> <!-- Link para remover o item -->
            
        </tr>
        <?php $total += $item['preco'] * $item['qtd']; ?>
        </form>
    <?php      
    endforeach; ?>

</table>
<div class="d-flex justify-content-end">
<h5>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></h5>
</div>
<hr>
<h3>Finalização da Compra</h3>

<div class="mb-3 col-sm-6">
    <label for="nome" class="form-label">Nome:</label>
    <input type="text" class="form-control form-control-sm" id="nome" name="nome" required>
</div>

<div class="mb-3 col-sm-6">
    <label for="email" class="form-label">Email:</label>
    <input type="email" class="form-control form-control-sm" id="email" name="email" required>
</div>
    <div class="mb-3 col-sm-6 d-flex justify-content-end" >
        <input type="submit" class="btn btn-primary" value="Finalizar Compra">
    </div>
</form>
</div>
<a href="index.php" class="btn btn-link">
  <i class="bi bi-arrow-left"></i> Voltar à Vitrine
</a>
</body>
</html>

