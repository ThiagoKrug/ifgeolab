<?php
function navbar($breadcrumb)
{
    if (isset($_SESSION['permissao'])) {
            include "topo.php";
    } else {
        header('Location: ../login.php');
    }
}
/* $bdServidor = "localhost";
$bdUsuario = "root";
$bdSenha = "";
$bdBanco = "ifgeolab";

// Criar uma conexão com o banco de dados
$conexao = [
    'host' => $bdServidor,
    'username' => $bdUsuario,
    'pass' => $bdSenha,
    'database' => $bdBanco
]; */
?>
<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/jpg" href="../img/icons8-rocha-48.png" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="../css/materialize.css">
<link rel="stylesheet" href="../css/navbar.css">
<link rel="stylesheet" href="../css/theme.css">
<link href="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/index.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.5.12/dist/cropper.min.js"></script>
<script src="..js/jquery.MultiFile.min"></script>
<script src="../js/materialize.js"></script>
<script src="../js/dark-light.js"></script>
<script src="../js/sweetalert.js"></script>
<title>IF GeoLab</title>