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
  <?php 
  include('navbar.php'); ?>
    <div class="album py-5 bg-body-tertiary">
      <?php  session_start(); ?>
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach ($produtosCupcake as $id => $cupcake):?>
          <div class="col">      
            <div class="card">
            <img src="<?= "image/" . $cupcake['imagem'] ?>"  class="card-img-top padronizar-imagem" alt="...">    
            <div class="card-body">
                 
             
                  <h5 class="card-title d-flex justify-content-center"><?php echo $cupcake['nome']; ?></h5>
                  <p class="card-text d-flex justify-content-center">Preço: R$ <?php echo number_format($cupcake['preco'], 2, ',', '.'); ?></p>
                  <form method="POST" action="adicionar.php">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="nome" value="<?php echo $cupcake['nome']; ?>">
                  <input type="hidden" name="preco" value="<?php echo $cupcake['preco']; ?>">
                  <div class="d-flex justify-content-center">
                    <input type="number" class="form-control text-center" name="qtd" id="qtd" value="1" min="1" required>
                  </div>
                  <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                  </div>
                  </form>
                </div>
              </div>
             
            </div>
            <?php endforeach ?>
          </div>     
         
            
        </div>
      </div>
    </div>
  
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>