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
    'Mineral' => '<a class="active" href="listarMineral.php">Minerais</a>'
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
</style>
</head>

<body>
    <main>
        <div class="container">
            <div class="vertical-line"></div>

            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Minerais</h4>
                    <h6 class="left-align">Mineral é um corpo natural sólido e cristalino formado em resultado da interação de processos
                        físico-químicos em ambientes geológicos. <br>Cada mineral é classificado e denominado não apenas com
                        base na sua composição química, mas também na estrutura cristalina dos materiais que o compõem.</h6>
                    <hr class="divider">
                </div>
                <div class="row">
                    <?php
                    require_once '../conecta.php';
                    $sql = "SELECT * FROM mineral WHERE sugestao=0";
                    $conexao = conectar();
                    $resultado = mysqli_query($conexao, $sql);
                    while ($dados = mysqli_fetch_array($resultado)) {
                        $idmineral = $dados["idmineral"];
                        $nome = $dados['nome'];
                        $cat = $dados['idcat'];
                        $descricao = $dados['descricao'];
                        $img = $dados['img'];
                    ?>
                        <div class="col s12 l4 m8">
                            <div class="card hoverable">
                                <div class="card-image">
                                    <img src="../img/mineral/<?= $img; ?>" class="minha-imagem materialboxed">
                                    <span class="card-title center meu-span white-text">
                                        <?php echo $nome ?>
                                    </span>
                                </div>
                                <div class="card-action">
                                    <a class="center waves-effect waves-light btn-small green accent-4" href="../relatorio.php?id=<?= $idmineral; ?>&tipo=mineral">
                                        <img src="../img/pdf-icon.png">
                                    </a>
                                    <a id="btnExcluir-<?= $idmineral ?>" class="center waves-effect waves-light btn-small red" data-idmineral="<?= $idmineral ?>">Excluir</a>
                                    <a class="center waves-effect waves-light btn-small green" href="forms.php?tipo=mineral&id=<?= $idmineral; ?>">Editar</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col s12 l4 m8">
                        <div class="card hoverable">
                            <div class="card-action center">
                                <a class="center waves-effect waves-light btn-small green" href="forms.php?tipo=mineral">Cadastrar</a>
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
                const idmineral = this.getAttribute('data-idmineral');
                Swal.fire({
                    title: "Tem certeza que deseja excluir o mineral?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "excluir.php?deletarMineral=" + idmineral;
                    }
                });
            });
        });
    </script>
</body>

</html>