<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Cupcakes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php include('navbar.php'); ?>
  <div class="container">
    <div class="row"></div>
    <h1>Cadastro de Cupcakes</h1>
    <div class="container">
        <div class="row">
            <?php
            include "src/conexao-bd.php";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $nome = $_POST["nome"];
                $imagem = $_POST["imagem"];
                $preco = $_POST["preco"];
                $preco = str_replace(',', '.', $preco);
                $insertDados = "INSERT INTO produtos (nome, imagem, preco) VALUES ('$nome', '$imagem', '$preco')";
              
                $pdo->exec($insertDados);
            }
            
            header('Location: index.php');
            ?>


        </div>
    </div>

    </div>
  </div>
    
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>