<?php 
  require "src/conexao-bd.php";
  $sql1 = "SELECT * FROM produtos";
  $statement = $pdo->query($sql1);
  $produtosCupcake = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cupcakes</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php include('navbar.php'); ?>
    <div class="container py-5">
      <?php session_start(); ?>
      <h3 class="mb-4">Produtos Cupcakes</h3>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Editar ou Remover</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($produtosCupcake as $id => $cupcake): ?>
          <tr>
            <td>
              <img src="<?= "image/" . htmlspecialchars($cupcake['imagem']) ?>" class="img-fluid" alt="Imagem de <?= htmlspecialchars($cupcake['nome']) ?>" style="max-width: 100px;">
            </td>
            <td><?= htmlspecialchars($cupcake['nome']); ?></td>
            <td>R$ <?= number_format($cupcake['preco'], 2, ',', '.'); ?></td>
            <td>
                
            <!-- Formulário para editar -->
            <form method="GET" action="editar.php" class="d-inline">
                <input type="hidden" name="id" value="<?= $cupcake['id']; ?>">
                <button type="submit" class="btn btn-warning">Editar</button>
              </form>

              <!-- Formulário para remover -->
              <form method="POST" action="delete.php" class="d-inline">
                <input type="hidden" name="id" value="<?= $cupcake['id']; ?>">
                <button type="submit" name="delete" value="delete" class="btn btn-danger">Remover</button>
              </form>
           
            </td>

              
            
            
          </tr>
        <?php endforeach ?>
        </tbody>
      </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
