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
    <br>
    <br>
    <div class="row"></div>
    <h1>Cadastro de Cupcakes</h1>
    <form action="cadastro-script.php" method="POST">
    <div class="col-8 mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nome do Cupcake:</label>
        <input type="text" class="form-control" name="nome" placeholder="Informe o nome do Cupcake">
    </div>
    <div class="col-8 mb-3">
        <label for="exampleFormControlInput1" class="form-label">Preço do Cupcake:</label>
        <input type="text" class="form-control" name="preco" placeholder="Informe o preço do Cucpcake">
    </div>
    <div class="col-8 mb-3">
        <label for="formFile" class="form-label">Selecione a imagem do cupckae:</label>
        <input class="form-control" type="file" name="imagem">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" min="1" type="submit" value="Cadastrar">
    </div>
        
    </form>
    </div>
  </div>
    
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>