<?php session_start();
include "include.php";

$breadcrumb = "";
navbar($breadcrumb);

require_once '../conecta.php';
$sql = "SELECT * FROM usuario";
$conexao = conectar();
$resultado = mysqli_query($conexao, $sql);
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
                    <h4 class="left-align">Editar Usuários</h4>
                    <hr class="divider">
                </div>
                <div class="row">
                    <?php

                    while ($dados = mysqli_fetch_array($resultado)) {
                        $idusuario = $dados["idusuario"];
                        $nome = $dados['nome'];
                        $img = $dados['img'];
                    ?>
                        <div class="col s12 l4 m8">
                            <div class="card hoverable">
                                <div class="card-image">
                                    <img src="../img/usuarios/<?= $img; ?>" class="minha-imagem materialboxed">
                                    <span class="card-title center meu-span white-text text-lighten-3">
                                        <?php echo $nome ?>
                                    </span>
                                </div>
                                <div class="card-action">
                                    <a id="btnExcluir-<?= $idusuario ?>" class="center waves-effect waves-light btn-small red"
                                        data-idusuario="<?= $idusuario ?>">Excluir</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <br>
                    <br>
                    <br>

                </div>

            </div>
            <br><br><br>
    </main>

    <?php
    include "../footer.php";
    ?>
    <script src="../js/sweetalert.js"></script>
    <script>
        document.querySelectorAll('[id^="btnExcluir-"]').forEach(button => {
            button.addEventListener('click', function() {
                const idusuario = this.getAttribute('data-idusuario');
                Swal.fire({
                    title: "Tem certeza que deseja excluir a conta?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sim"
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = "excluir.php?deletarUsuario=" + idusuario;
                    }
                });
            });
        });
    </script>

</body>

</html>