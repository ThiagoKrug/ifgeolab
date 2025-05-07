<?php session_start();
include "include.php";

$tipo = $_GET['tipo'];

?>

<body>
    <?php
    $breadcrumbs = [
        'Atual' => '> <a class="active" href="acervo.php?tipo=' . urlencode(ucfirst($tipo)) . '">' . ucfirst($tipo) . '</a>'
    ];
    $breadcrumb = implode('>', $breadcrumbs);
    navbar($breadcrumb);
    ?>
    <main>
        <div class="container">
            <div class="vertical-line"></div>
            <?php if ($tipo === 'Rochas') { ?>
                <div class="section-content">
                    <div class="section">
                        <h4 class="left-align">Tipos de rochas</h4>
                        <h6 class="left-align">As rochas são constituídas por um ou mais minerais.<br>
                            As rochas são classificadas em três tipos baseados na sua formação:</h6>
                        <hr class="divider">
                    </div>
                    <div class="row">
                        <div class="col s12 m4">
                            <div class="image-container center-align">
                                <a href="amostras.php?tipo=Rochas&categoria=ígneas">
                                    <img src="img/igneas.png" alt="Rochas ígneas" class="image-with-caption">
                                    <div class="caption">ÍGNEAS</div>
                                </a>
                            </div>
                        </div>

                        <div class="col s12 m4">
                            <div class="image-container center-align">
                                <a href="amostras.php?tipo=Rochas&categoria=sedimentares">
                                    <img src="img/sedimentares.png" alt="Rochas Sedimentares" class="image-with-caption">
                                    <div class="caption">SEDIMENTARES</div>
                                </a>
                            </div>
                        </div>
                        <div class="col s12 m4">
                            <div class="image-container center-align">
                                <a href="amostras.php?tipo=Rochas&categoria=metamórficas">
                                    <img src="img/metamórficas.png" alt="Rochas Metamórficas" class="image-with-caption">
                                    <div class="caption">METAMÓRFICAS</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="section-content">
                    <div class="section">
                        <h4 class="left-align">Tipos de minerais</h4>
                        <h6 class="left-align">Minerais são partes de rochas, de formação natural.<br>
                            Os minerais são classificados em dois tipos baseados na sua formação:</h6>
                        <hr class="divider">
                    </div>
                    <div class="row">
                        <div class="col s12 m6">
                            <div class="image-container center-align">
                                <a href="amostras.php?tipo=Minerais&categoria=metálicos" class="white-text">
                                    <img src="img/metalicas.png" alt="Minerais Metálicos" class="image-with-caption">
                                    <div class="caption">METÁLICOS</div>
                                </a>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="image-container center-align">
                                <a href="amostras.php?tipo=Minerais&categoria=não-metálicos" class="white-text">
                                    <img src="img/nao-metalicas.png" alt="Minerais Metálicos" class="image-with-caption">
                                    <div class="caption">NÃO METÁLICOS</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    <?php
    include "footer.php";
    ?>