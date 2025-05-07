<!DOCTYPE html>
<html lang="pt-br">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="shortcut icon" type="image/jpg" href="img/icons8-rocha-48.png" />
<link rel="stylesheet" href="css/materialize.css">
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="css/theme.css">
<script src="js/materialize.js"></script>
<script src="js/dark-light.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/index.css">
<title>IF GeoLab</title>
<?php
function navbar($breadcrumb)
{
    if (isset($_SESSION['permissao'])) {
        include "topo.php";
    } else {
        header('Location: login.php');
    }
}
?>