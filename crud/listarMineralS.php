<?php session_start();
$msg = "";
if (isset($_SESSION['excluir'])) {
    $msg = $_SESSION['excluir'];
    unset($_SESSION['excluir']);
}
include "include.php";

$breadcrumbs = [
    'Sugestão' => '> <a href="sugestao.php">Sugestões</a>',
    'Minerais' => '<a class="active" href="listarMineralS.php">Minerais</a>'
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
                    $sql = "SELECT * FROM mineral WHERE sugestao=1";
                    $conexao = conectar();
                    $resultado = mysqli_query($conexao, $sql); ?>
                    <table class="highlight">
                        <thead>
                            <tr>
                                <th scope="col">Id Mineral</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Id Categoria</th>
                                <th scope="col">Imagem</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <?php while ($dados = mysqli_fetch_array($resultado)) {
                            $idmineral = $dados["idmineral"];
                            $nome = $dados['nome'];
                            $cat = $dados['idcat'];
                            $descricao = $dados['descricao'];
                            $img = $dados['img'];
                            $obj = $dados['3d'];

                            echo "<td> " . $dados['idmineral'] . " </td>";
                            echo "<td>" . $dados['nome'] . " </td>";
                            echo "<td>" . $dados['idcat'] . " </td>";
                            echo "<td> <img src=../img/mineral/" . $dados['img'] . " width='50px' height='auto' class='materialboxed'></td>";
                            echo "<td><a class='center waves-effect waves-light btn-small blue' href='forms.php?tipo=mineral&id=" . $dados['idmineral'] . "'>Editar</a>";
                            echo " <a class='center waves-effect waves-light btn-small green' href='editar.php?idmineral=" . $dados['idmineral'] . "&sugestao=0'>Aceitar</a>";
                            echo " <a id='btnExcluir-" . $dados['idmineral'] . "' class='center waves-effect waves-light btn-small red' data-idmineral='" . $dados['idmineral'] . "'>Excluir</a></td>";
                            echo '</tr>';
                        } ?>
                    </table>
                </div>
            </div>
            <br><br><br>
    </main>

    <?php include "../footer.php"; ?>

    <script src="../js/sweetalert.js"></script>
    <script>
        <?php if ($msg != "") { ?>
            window.addEventListener("load", (event) => {
                Swal.fire(
                    <?= json_encode($msg) ?>
                )
            })
        <?php } ?>

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

        document.addEventListener('DOMContentLoaded', function() {
            const materialboxElems = document.querySelectorAll('.materialboxed');
            M.Materialbox.init(materialboxElems);
        });
    </script>

</body>

</html>