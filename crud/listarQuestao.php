<?php session_start();
$msg = "";
if (isset($_SESSION['excluir'])) {
    $msg = $_SESSION['excluir'];
    unset($_SESSION['excluir']);
}
include "include.php";

$breadcrumbs = [
    'Atual' => '> <a class="active" href="listarQuestao.php">Questões</a>'
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

<link rel="stylesheet" href="../css/rocha-mineral.css">

<body>
    <main>
    <div class="container center">
            <div class="vertical-line"></div>

            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Questões</h4>
                    <h6 class="left-align">Cadastre, edite ou visualize as questões sobre rochas e minerais.</h6>
                    <hr class="divider">
                    <a class="center waves-effect waves-light btn-small green"
                                    href="forms.php?tipo=questionário">Cadastrar</a>
                </div>
            <div class="row">
                <?php
                require_once '../conecta.php';
                $sql = "SELECT * FROM questoes";
                $conexao = conectar();
                $resultado = mysqli_query($conexao, $sql); ?>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Alternativa Certa</th>
                        </tr>
                    </thead>
                    <?php while ($dados = mysqli_fetch_array($resultado)) {

                        echo "<td> " . $dados['id_questao'] . " </td>";
                        echo "<td>" . $dados['nome'] . " </td>";
                        echo "<td>" . $dados['descricao'] . " </td>";
                        echo "<td>" . $dados['alternativa_certa'] . " </td>";
                        echo "<td><a class='center waves-effect waves-light btn-small blue' href='forms.php?tipo=questionário&id=" . $dados['id_questao'] . "'>Editar</a>";
                        echo " <a id='btnExcluir-" . $dados['id_questao'] . "' class='center waves-effect waves-light btn-small red' data-idquestao='" . $dados['id_questao'] . "'>Excluir</a></td>";
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

        document.addEventListener('DOMContentLoaded', function() {
            const materialboxElems = document.querySelectorAll('.materialboxed');
            M.Materialbox.init(materialboxElems);
        });
    </script>
</body>

</html>