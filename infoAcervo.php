<?php session_start();
include "include.php"; ?>
<style>
    .minha-imagem {
        height: 400px;
        width: 400px;
        object-fit: cover;
        align-items: center;
    }

    .meu-span {
        background-color: rgba(0, 0, 0, 0.6);
        width: 100%;
    }

    .icon {
        height: 32px;
        width: 32px;
        align-items: center;
        position: absolute;
    }
</style>
<link rel="stylesheet" href="css/3d.css">

<?php
require_once('conecta.php');
$conexao = conectar();

$sql = "";

if ($_GET['tipo'] == 'rochas') {
    $id = $_GET['id'] ?? null;
    $sql = "SELECT * FROM rocha WHERE idrocha =" . $id;
} else if ($_GET['tipo'] == 'mineral') {
    $id = $_GET['id'] ?? null;
    $sql = "SELECT * FROM mineral WHERE idmineral =" . $id;
}

$tipo = $_GET['tipo'];

$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $dados = mysqli_fetch_assoc($resultado);
    $img = $dados['img'];
    $catJ = $dados['idcat'];
    $id;
    $obj = $dados['3d'];
    $nome = $dados['nome'];
    $descricao = $dados['descricao'];
}

$j = "SELECT * FROM catrocha WHERE idcat='$catJ'";
$res = mysqli_query($conexao, $j);
while ($d = mysqli_fetch_assoc($res)) {
    $idcat = $d['idcat'];
    $name = $d['nome'];
}
if ($dados['idcat'] == $idcat) {
    $cat = $name;
} else {
    echo "Erro ao buscar a categoria no banco de dados!";
}
$breadcrumbs[] = "";
if ($_GET['tipo'] == 'rochas') {
    $breadcrumbs = [
        'Atual' => '> <a href="acervo.php?tipo=Rochas">Rochas</a>',
    ];
    if ($idcat == "1") {
        $breadcrumbs['Ígneas'] = '<a class="active" href="amostras.php?tipo=Rochas&categoria=ígneas">Ígneas</a>';
    } elseif ($idcat == "2") {
        $breadcrumbs['Metamórficas'] = '<a class="active" href="amostras.php?tipo=Rochas&categoria=metamórficas">Metamórficas</a>';
    } elseif ($idcat == "3") {
        $breadcrumbs['Sedimentares'] = '<a class="active" href="amostras.php?tipo=Rochas&categoria=sedimentares">Sedimentares</a>';
    }
} else if ($_GET['tipo'] == 'mineral') {
    $breadcrumbs = [
        'Atual' => '> <a href="acervo.php?tipo=Minerais">Minerais</a>',
    ];

    if ($idcat == "1") {
        $breadcrumbs['Metálicos'] = '<a class="active" href="metalica.php">Metálicos</a>';
    } else {
        $breadcrumbs['Não-Metálicos'] = '<a class="active" href="n-metalica.php">Não-Metálicos</a>';
    }
}

$breadcrumb = implode(' > ', $breadcrumbs);
navbar($breadcrumb);
?>

<body>
    <main>
        <?php if ($obj != "") { ?>
            <div class="container">
                <div class="row center">
                    <div class="wrapp">
                        <div class="col s12">
                            <div class="card">
                                <model-viewer id="model-viewer" class="card__model" shadow-intensity="1"
                                    src="obj/<?= $obj; ?>" max-camera-orbit="auto 90deg" autoplay auto-rotate ar
                                    ar-modes="scene-viewer quick-look" camera-controls touch-action="pan-y"
                                    poster="img/geolab-branco.png">
                                </model-viewer>
                                <span class="card-title">
                                    <?= $nome; ?>
                                </span>
                            </div>
                            <a class="right gerarpdf waves-effect waves-light accent-4"
                                href="relatorio.php?tipo=<?= $tipo ?>&id=<?= $id; ?>">
                                <img class="pdf" src="img/pdf-icon.png"> Gerar PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="container">
                <div class="row center">
                    <div class="wrapp">
                        <img src="img/<?= $tipo ?>/<?= $img ?>" widht="auto" height="300px">
                    </div>
                    <a class="gerarpdf waves-effect waves-light accent-4"
                        href="relatorio.php?tipo=<?= $tipo ?>&id=<?= $id; ?>">
                        <img class="pdf" src="img/pdf-icon.png"> Gerar PDF</a>
                </div>
            </div>
        <?php } ?>
        <h5 class="center"><b>Categoria:</b>
            <?= $cat; ?>
        </h5>
        <hr>
        <div class="container">
            <div class="col s12 m6 l4">
                <h5>
                    <?= $descricao; ?>
                </h5>
            </div>
            <hr>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const materialboxElems = document.querySelectorAll('.materialboxed');
            M.Materialbox.init(materialboxElems);
        });
    </script>