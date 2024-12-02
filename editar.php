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
include("navbar.php");
include('src/conexao-bd.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar o produto pelo ID
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        echo "Produto não encontrado!";
        exit;
    }

    // Processar o formulário de atualização
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coletando os dados enviados pelo formulário
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $preco = str_replace(',', '.', $preco);
    $imagem = $_POST['imagem'];  // Aqui você pode tratar o upload de imagem se necessário

     // Verificar se o arquivo de imagem foi enviado
     if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        // Realizar o upload da nova imagem
        $imagemPath = 'image/' . $_FILES['imagem']['name'];
        move_uploaded_file($_FILES['imagem']['tmp_name'], $imagemPath);

        // Atualizar a imagem no banco
        $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, imagem = ? WHERE id = ?");
        $stmt->execute([$nome, $preco, $imagemPath, $id]);
    } else {
        // Caso a imagem não tenha sido modificada
        $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, preco = ? WHERE id = ?");
        $stmt->execute([$nome, $preco, $id]);
    }

    // Redirecionar para a página de produtos (ou mostrar uma mensagem de sucesso)
    header("Location: editar_remover_cupcake.php");
    exit;
}
?>
    <div class="container">
    <br>
    <br>
    <div class="row"></div>
    <h1>Editar Cupcakes</h1>
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="id" value="<?php echo $produto['id']?>">
    <div class="col-8 mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nome do Cupcake:</label>
        <input type="text" class="form-control" name="nome" value="<?php echo $produto['nome']?>">
    </div>
    <div class="col-8 mb-3">
        <label for="exampleFormControlInput1" class="form-label">Preço do Cupcake:</label>
        <input type="text" class="form-control" name="preco" value="<?php echo $produto['preco']?>">
    </div>
    <div class="col-8 mb-3">
    <label for="imagem" class="form-label">Imagem do Cupcake:</label>
                <input class="form-control" type="file" name="imagem">
                <!-- Caso o produto já tenha uma imagem, exiba a imagem atual -->
                <?php if (!empty($produto['imagem'])): ?>
                    <p>Imagem Atual:</p>
                    <img src="image/<?php echo htmlspecialchars($produto['imagem']); ?>" alt="Imagem do cupcake" style="max-width: 100px;">
                <?php endif; ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" min="1" type="submit" value="Editar">
    </div>
        
    </form>
    </div>
  </div>
<?php
} else {
    echo "ID do produto não fornecido.";
}
?>
