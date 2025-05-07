<?php session_start();
$msg = "";
if (isset($_SESSION['excluir'])) {
    $msg = $_SESSION['excluir'];
    unset($_SESSION['excluir']);
}
$confirm = "";
if (isset($_SESSION['confirm'])) {
    $confirm = $_SESSION['confirm'];
    unset($_SESSION['confirm']);
}
include "include.php";
$breadcrumbs = [
    'Amostra' => '> <a href="amostra.php">Amostras</a>',
    'Rochas' => '<a class="active" href="listarRocha.php">Rochas</a>'
];
$breadcrumb = implode('>', $breadcrumbs);

navbar($breadcrumb);
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

    .btn {
        font-size: 10px;
    }
</style>

<body>
    <main>
    <div class="container">
            <div class="vertical-line"></div>

            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Rochas</h4>
                    <h6 class="left-align">Rocha é um agregado sólido que ocorre naturalmente e é constituído por um ou mais minerais ou
                        mineraloides. <br>A camada externa sólida da Terra, conhecida por litosfera, é constituída por rochas.</h6>
                    <hr class="divider">
                </div>

                <?php
                require_once '../conecta.php';
                $sql = "SELECT * FROM rocha WHERE sugestao=0";
                $conexao = conectar();
                $resultado = mysqli_query($conexao, $sql);
                while ($dados = mysqli_fetch_array($resultado)) {
                    $idrocha = $dados["idrocha"];
                    $nome = $dados['nome'];
                    $cat = $dados['idcat'];
                    $descricao = $dados['descricao'];
                    $img = $dados['img'];
                ?>
                    <div class="row">
                        <div class="col s4">
                            <div class="card hoverable">
                                <div class="card-image">
                                    <img src="../img/rochas/<?= $img; ?>" class="minha-imagem materialboxed">
                                    <span class="card-title center meu-span white-text">
                                        <?= $nome ?>
                                    </span>
                                </div>
                                <div class="card-action">
                                    <a class="center waves-effect waves-light btn-small green accent-4"
                                        href="../relatorio.php?id=<?= $idrocha; ?>&tipo=rochas">
                                        <img src="../img/pdf-icon.png">
                                    </a>
                                    <a id="btnExcluir-<?= $idrocha ?>" class="center waves-effect waves-light btn-small red"
                                        data-idrocha="<?= $idrocha ?>">Excluir</a>
                                    <a class="center waves-effect waves-light btn-small green"
                                        href="forms.php?tipo=rocha&id=<?= $idrocha; ?>">Editar</a>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                    <div class="col s12 l4 m8">
                        <div class="card hoverable">
                            <div class="card-action center">
                                <a class="center waves-effect waves-light btn-small green"
                                    href="forms.php?tipo=rocha">Cadastrar</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    </div>
    </main>
    <?php
    include "../footer.php";
    ?>
    <script src="../js/sweetalert.js"></script>
    <script>
        <?php if ($msg != "") { ?>
            window.addEventListener("load", (event) => {
                Swal.fire(
                    <?= json_encode($msg) ?>
                )
            })
        <?php } ?>
        <?php if ($confirm != "") { ?>
            window.addEventListener("load", (event) => {
                Swal.fire(
                    <?= json_encode($confirm) ?>
                )
            })
        <?php } ?>
    </script>
    <script>
        document.querySelectorAll('[id^="btnExcluir-"]').forEach(button => {
            button.addEventListener('click', function() {
                const idrocha = this.getAttribute('data-idrocha');
                Swal.fire({
                    title: "Tem certeza que deseja excluir a rocha?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "excluir.php?deletarRocha=" + idrocha;
                    }
                });
            });
        });
    </script>
</body>

</html>