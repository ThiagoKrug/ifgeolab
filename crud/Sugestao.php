<?php session_start();
include "include.php";

$breadcrumbs = [
    'Sugestao' => '> <a class="active" href="sugestao.php">Sugestões</a>'
];
$breadcrumb = implode('>', $breadcrumbs);

navbar($breadcrumb);
?>

<body>
    <main>
        <div class="container">

            <div class="vertical-line"></div>

            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Sugestões</h4>
                    <h6 class="left-align">Sugestões de amostras cadastradas por usuários</h6>
                    <hr class="divider">
                </div>
                <div class="row">
                    <div class="col center-align">
                        <div class="image-container">
                            <a href="listarRochaS.php">
                                <img src="../img/rochas.png" alt="Rochas" class="image-with-caption grayscale">
                                <div class="caption">Rochas</div>
                            </a>
                        </div>
                    </div>
                    <div class="col center-align">
                        <div class="image-container">
                            <a href="listarMineralS.php">
                                <img src="../img/mineral.png" alt="Minerais" class="image-with-caption grayscale">
                                <div class="caption">Minerais</div>
                            </a>
                        </div>
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