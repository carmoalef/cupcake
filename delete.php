<?php
include("src/conexao-bd.php");

if(isset($_POST['id']))
 {
    $del = "DELETE FROM produtos WHERE id = " . $_POST['id'];
    $delgo = $pdo->query($del) or die('Erro ao deletar');

    header("Location: editar_remover_cupcake.php");
}