<?php session_start();
$msg = "";
if (isset($_SESSION['excluir'])) {
    $msg = $_SESSION['excluir'];
    unset($_SESSION['excluir']);
}
include "include.php";

$breadcrumbs = [
    'Sugestão' => '> <a href="sugestao.php">Sugestões</a>',
    'Rochas' => '<a class="active" href="listarRochaS.php">Rochas</a>'
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
                    <h4 class="left-align">Rochas</h4>
                    <h6 class="left-align">Rocha é um agregado sólido que ocorre naturalmente e é constituído por um ou mais minerais ou
                        mineraloides. <br>A camada externa sólida da Terra, conhecida por litosfera, é constituída por rochas.</h6>
                    <hr class="divider">
                </div>
            <div class="row">
                <?php
                require_once '../conecta.php';
                $sql = "SELECT * FROM rocha WHERE sugestao=1";
                $conexao = conectar();
                $resultado = mysqli_query($conexao, $sql); ?>
                <table class="highlight">
                    <thead>
                        <tr>
                            <th scope="col">Id Rocha</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Id Categoria</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Opções</th>
                        </tr>
                    </thead>
                    <?php while ($dados = mysqli_fetch_array($resultado)) {
                        $idrocha = $dados["idrocha"];
                        $nome = $dados['nome'];
                        $cat = $dados['idcat'];
                        $descricao = $dados['descricao'];
                        $img = $dados['img'];
                        $obj = $dados['3d'];

                        echo "<td> " . $dados['idrocha'] . " </td>";
                        echo "<td>" . $dados['nome'] . " </td>";
                        echo "<td>" . $dados['idcat'] . " </td>";
                        echo "<td> <img src=../img/rochas/" . $dados['img'] . " width='50px' height='auto' class='materialboxed'></td>";
                        echo "<td><a class='center waves-effect waves-light btn-small blue' href='forms.php?tipo=rocha&id=" . $dados['idrocha'] . "'>Editar</a>";
                        echo " <a class='center waves-effect waves-light btn-small green' href='editar.php?idrocha=" . $dados['idrocha'] . "&sugestao=0'>Aceitar</a>";
                        echo " <a id='btnExcluir-" . $dados['idrocha'] . "' class='center waves-effect waves-light btn-small red' data-idrocha='" . $dados['idrocha'] . "'>Excluir</a></td>";
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