<?php session_start();
include "include.php"; ?>


<body>
    <?php
    $breadcrumbs = [
        'Amostra' => '> <a class="active" href="amostra.php">Amostras</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);
    navbar($breadcrumb);
    ?>
    <link rel="stylesheet" href="../css/index.css">
    <main>
        <div class="container center">
            <div class="vertical-line"></div>

            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Amostras</h4>
                    <h6 class="left-align">Veja amostras cadastradas de Rochas ou Minerais</h6>
                    <hr class="divider">
                </div>
                <div class="row">
                    <div class="col center-align">
                        <div class="image-container">
                        <?php if ($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){ ?>
                            <a href="listarRocha.php">
                                <img src="../img/rochas.png" alt="Rochas" class="image-with-caption grayscale">
                                <div class="caption">Rochas</div>
                            </a>
                            <?php }else{ ?>
                                <a href="forms.php?tipo=rocha&sugestao=1">
                                <img src="../img/rochas.png" alt="Rochas" class="image-with-caption grayscale">
                                <div class="caption">Rochas</div>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col center-align">
                        <div class="image-container">
                        <?php if ($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){ ?>
                            <a href="listarMineral.php">
                                <img src="../img/mineral.png" alt="Minerais" class="image-with-caption grayscale">
                                <div class="caption">Minerais</div>
                            </a>
                            <?php }else{ ?>
                                <a href="forms.php?tipo=mineral&sugestao=1">
                                <img src="../img/mineral.png" alt="Minerais" class="image-with-caption grayscale">
                                <div class="caption">Minerais</div>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <br><br><br><br>
    <?php
    include "../footer.php";
    ?>
</body>

</html>