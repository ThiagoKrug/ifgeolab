<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="img/icons8-mineral-48.png" />
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
    <title>Document</title>

    <head>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            .img1 {
                align-items: left;
                margin-top: 60px;
                margin-right: 0px;
                margin-bottom: 10px;
                margin-left: 15px;
                max-width: 100px;
            }

            .img2 {
                margin-top: 30px;
                margin-left: 0px;
                margin-bottom: 10px;
                margin-right: 0px;
                max-width: 140px;
            }

            .img3 {

                max-width: 280px;
                text-align: center;
            }

            .text {
                margin-left: 10px;
                margin-right: 10px;
                font-size: large;
            }

            .title {
                font-size: large;
                text-align: center;
            }

            .cat {
                margin-left: 0%;
            }
        </style>
    </head>
    <?php
    require_once('conecta.php');
    $conexao = conectar();
    $idmineral = $_GET['mineral'];
    $idrocha = $_GET['rocha'];

    if (isset($_GET['idmineral'])) {
        $sql = "SELECT * FROM mineral WHERE idmineral =" . $idmineral;
        $j = "SELECT * FROM catmineral WHERE idcat='$catJ'";
    } else if (isset($_GET['idrocha'])) {
        $sql = "SELECT * FROM rocha WHERE idrocha =" . $idrocha;
        $j = "SELECT * FROM catrocha WHERE idcat='$catJ'";
    }
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($resultado);
    $nome = $dados['nome'];
    $descricao = $dados['descricao'];
    $img = $dados['img'];
    $catJ = $dados['idcat'];
    
    $res = mysqli_query($conexao, $j);
    while ($d = mysqli_fetch_array($res)) {
        $idcat = $d['idcat'];
        $name = $d['nome'];
    }
    if ($dados['idcat'] == $idcat) {
        $cat = $name;
    } else {
        echo "Erro ao buscar a categoria no banco de dados!";
    }
    ?>

<body>

    <div class="row">
        <div class="col s2"><img class="img1" src="img/if_logo.png"></div><br>
        <div class="title col s7">
            <h6><b>Instituto Federal de Educação, Ciência e Tecnologia Farroupilha Campus Uruguaiana</b></h6>
            <h5><b>MOSTRUÁRIO DIGITAL DE GEOGRAFIA IFGEOLAB</b></h5>
        </div>
        <div class="col s3"><img class="img2" src="img/geolab-verde.png"></div>
    </div>
    <div class="container">
        <hr>
        <div class="row">
            <h3><?= $nome; ?></h3>
            <h5 class="right"><b>Categoria: </b><?= $cat; ?></h5><br>
            <img src="img/mineral/<?= $img; ?>" class="img3">
        </div>
    </div>
    <hr>
    <div class="text col s12">
        <p><?= $descricao; ?></p>
    </div>
</body>

</html>