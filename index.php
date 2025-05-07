<?php session_start();
$msg = "";
if (isset($_SESSION['confirm'])) {
    $msg = $_SESSION['confirm'];
    unset($_SESSION['confirm']);
}
$login = "";
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    unset($_SESSION['login']);
}
unset($_SESSION['questoes'])
    ?>
<?php
include "include.php";
$breadcrumb = "";
navbar($breadcrumb);
?>

<body>
    <main>
        <div class="container">
            <!-- Linha vertical à esquerda -->
            <div class="vertical-line"></div>

            <!-- Conteúdo da seção -->
            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Laboratório</h4>
                    <h6 class="left-align">O que deseja acessar?</h6>
                    <hr class="divider">
                </div>

                <div class="menu row">
                    <div class="col pull-s1 s6 m4 l4 center-align">
                        <div class="image-container">
                            <a href="acervo.php?tipo=Rochas">
                                <img src="img/rochas.png" alt="Rochas"
                                    class="image-with-caption grayscale hoverable responsive-img cover-image">
                                <div class="caption">Rochas</div>
                            </a>
                        </div>
                    </div>
                    <div class="col pull-s1 s6 m4 l4 center-align">
                        <div class="image-container">
                            <a href="acervo.php?tipo=Minerais">
                                <img src="img/mineral.png" alt="Minerais"
                                    class="image-with-caption grayscale hoverable responsive-img">
                                <div class="caption">Minerais</div>
                            </a>
                        </div>
                    </div>
                    <div class="col pull-s4 s8 m4 l4 center-align">
                        <div class="image-container">
                            <a href="questionario.php">
                                <img src="img/questionarios.png" alt="Questionários"
                                    class="image-with-caption responsive-img">
                                <div class="caption">Questionários</div>
                            </a>
                        </div>
                        <div class="image-container">
                            <?php
                            if ($_SESSION['permissao'] == 1) {
                                echo '<a href="crud/amostra.php">';
                            } elseif ($_SESSION['permissao'] == 2) {
                                echo '<a href="crud/sugestao.php">';
                            } elseif ($_SESSION['permissao'] == 3) {
                                echo '<a href="crud/sugestao.php">';
                            }
                            ?>
                            <img src="img/sugestoes.png" alt="Sugestões" class="image-with-caption responsive-img">
                            <div class="caption">Sugestões</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include "footer.php"; ?>



    <script src="js/sweetalert.js"></script>
    <script>
        <?php if ($msg != "") { ?>
            window.addEventListener("load", (event) => {
                Swal.fire(
                    <?= json_encode($msg) ?>
                )
            })
        <?php } ?>

        <?php if ($login != "") { ?>
            window.addEventListener("load", (event) => {
                Swal.fire(
                    <?= json_encode($login) ?>
                )
            })
        <?php } ?>
    </script>
</body>

</html>