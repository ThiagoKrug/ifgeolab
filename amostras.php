<?php 
session_start();
include "include.php";
$tipo = $_GET['tipo'];
$categoria = $_GET['categoria'];

?>
<style>
    .minha-imagem {
        height: 220px;
        width: 600px;
        object-fit: cover;
    }

    .meu-span {
        background-color: rgba(0, 0, 0, 0.3);
        width: 100%;
    }
</style>
    <?php
    $breadcrumbs = [
        'Acervo' => '> <a href="acervo.php?tipo=' . urlencode(ucfirst($tipo)) . '">' . ucfirst($tipo) . '</a>',
        'Atual' => '<a class="active" href="amostras.php?tipo=' . urlencode(ucfirst($tipo)) . '&categoria=' . $categoria . '">' . ucfirst($categoria) . '</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);
    navbar($breadcrumb);
    ?>
    <main>
        <div class="container">
            <div class="vertical-line"></div>

            <?php if ($tipo == 'Rochas' and $categoria == 'ígneas') { ?>
                <div class="section-content">
                    <div class="section">
                        <h4 class="left-align">Rochas Ígneas</h4>
                        <hr class="divider">
                    </div>
                    <div class="row">
                        <?php
                        require_once 'conecta.php';
                        $sql = "SELECT * FROM rocha WHERE idcat=1 and sugestao=0";
                        $conexao = conectar();
                        $resultado = mysqli_query($conexao, $sql);
                        while ($dados = mysqli_fetch_array($resultado)) {
                            $nome = $dados['nome'];
                            $cat = $dados['idcat'];
                            $descricao = $dados['descricao'];
                            $img = $dados['img'];

                            ?>
                            <div class="col s12 l4 m8">
                                <div class="card hoverable">

                                    <div class="card-image transparent">
                                        <img src="img/rochas/<?= $img; ?>" class="minha-imagem materialboxed ">
                                        <span
                                            class="card-title center meu-span green-text text-lighten-3"><?= $nome ?></span>
                                    </div>
                                    <div class="card-action">
                                        <a class="green-text text-lighten-3"
                                            href="infoAcervo.php?tipo=rochas&id=<?= $dados['idrocha'] ?>">Saiba mais</a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            <?php } elseif ($tipo == 'Rochas' and $categoria == 'sedimentares') { ?>
                <div class="section-content">
                    <div class="section">
                        <h4 class="left-align">Rochas Sedimentares</h4>
                        <hr class="divider">
                    </div>
                    <div class="row">
                        <?php
                        require_once 'conecta.php';
                        $sql = "SELECT * FROM rocha WHERE idcat=3 and sugestao=0";
                        $conexao = conectar();
                        $resultado = mysqli_query($conexao, $sql);
                        while ($dados = mysqli_fetch_array($resultado)) {
                            $nome = $dados['nome'];
                            $cat = $dados['idcat'];
                            $descricao = $dados['descricao'];
                            $img = $dados['img'];

                            ?>
                            <div class="col s12 l4 m8">
                                <div class="card hoverable">

                                    <div class="card-image">
                                        <img src="img/rochas/<?= $img; ?>" class="minha-imagem materialboxed ">
                                        <span
                                            class="card-title center meu-span green-text text-lighten-3"><?= $nome ?></span>
                                    </div>
                                    <div class="card-action">
                                        <a class="green-text text-lighten-3"
                                            href="infoAcervo.php?tipo=rochas&id=<?= $dados['idrocha'] ?>">Saiba mais</a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            <?php } elseif ($tipo == 'Rochas' and $categoria == 'metamórficas') { ?>
                <div class="section-content">
                    <div class="section">
                        <h4 class="left-align">Rochas Metamórficas</h4>
                        <hr class="divider">
                    </div>
                    <div class="row">
                        <?php
                        require_once 'conecta.php';
                        $sql = "SELECT * FROM rocha WHERE idcat=2 and sugestao=0";
                        $conexao = conectar();
                        $resultado = mysqli_query($conexao, $sql);
                        while ($dados = mysqli_fetch_array($resultado)) {
                            $nome = $dados['nome'];
                            $cat = $dados['idcat'];
                            $descricao = $dados['descricao'];
                            $img = $dados['img'];

                            ?>
                            <div class="col s12 l4 m8">
                                <div class="card hoverable">

                                    <div class="card-image">
                                        <img src="img/rochas/<?= $img; ?>" class="minha-imagem materialboxed ">
                                        <span
                                            class="card-title center meu-span green-text text-lighten-3"><?= $nome ?></span>
                                    </div>
                                    <div class="card-action">
                                        <a class="green-text text-lighten-3"
                                            href="infoAcervo.php?tipo=rochas&id=<?= $dados['idrocha'] ?>">Saiba mais</a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            <?php } elseif ($tipo == 'Minerais' and $categoria == 'metálicos') { ?>
                <div class="section-content">
                    <div class="section">
                        <h4 class="left-align">Minerais Metálicos</h4>
                        <hr class="divider">
                    </div>
                    <div class="row">
                        <?php
                        require_once 'conecta.php';
                        $sql = "SELECT * FROM mineral WHERE idcat=1 and sugestao=0";
                        $conexao = conectar();
                        $resultado = mysqli_query($conexao, $sql);
                        while ($dados = mysqli_fetch_array($resultado)) {
                            $nome = $dados['nome'];
                            $cat = $dados['idcat'];
                            $descricao = $dados['descricao'];
                            $img = $dados['img'];

                            ?>
                            <div class="col s12 l4 m8">
                                <div class="card hoverable">

                                    <div class="card-image">
                                        <img src="img/mineral/<?= $img; ?>" class="minha-imagem materialboxed ">
                                        <span
                                            class="card-title center meu-span green-text text-lighten-3"><?= $nome ?></span>
                                    </div>
                                    <div class="card-action">
                                        <a class="green-text text-lighten-3"
                                            href="infoAcervo.php?tipo=mineral&id=<?= $dados['idmineral'] ?>">Saiba mais</a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            <?php } elseif ($tipo == 'Minerais' and $categoria == 'não-metálicos') { ?>
                <div class="section-content">
                    <div class="section">
                        <h4 class="left-align">Minerais Não-Metálicos</h4>
                        <hr class="divider">
                    </div>
                    <div class="row">
                        <?php
                        require_once 'conecta.php';
                        $sql = "SELECT * FROM mineral WHERE idcat=2 and sugestao=0";
                        $conexao = conectar();
                        $resultado = mysqli_query($conexao, $sql);
                        while ($dados = mysqli_fetch_array($resultado)) {
                            $nome = $dados['nome'];
                            $cat = $dados['idcat'];
                            $descricao = $dados['descricao'];
                            $img = $dados['img'];

                            ?>
                            <div class="col s12 l4 m8">
                                <div class="card hoverable">

                                    <div class="card-image">
                                        <img src="img/mineral/<?= $img; ?>" class="minha-imagem materialboxed ">
                                        <span
                                            class="card-title center meu-span green-text text-lighten-3"><?= $nome ?></span>
                                    </div>
                                    <div class="card-action">
                                        <a class="green-text text-lighten-3"
                                            href="infoAcervo.php?tipo=mineral&id=<?= $dados['idmineral'] ?>">Saiba mais</a>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
    </main>
    <?php
    include "footer.php";
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const materialboxElems = document.querySelectorAll('.materialboxed');
            M.Materialbox.init(materialboxElems);
        });
    </script>