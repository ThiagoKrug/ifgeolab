<?php
session_start();

require_once 'conecta.php';
$conexao = conectar();

if (!isset($_SESSION['questoes'])) {
    $sql_questoes = "SELECT * FROM questoes ORDER BY RAND() LIMIT 10";
    $result_questoes = mysqli_query($conexao, $sql_questoes);

    if ($result_questoes) {
        $questoes = mysqli_fetch_all($result_questoes, MYSQLI_ASSOC);
        $_SESSION['questoes'] = $questoes;
    } else {
        echo mysqli_errno($conexao) . ": " . mysqli_error($conexao);
    }
} else {
    $questoes = $_SESSION['questoes'];
}


if (isset($_POST['enviar'])) {
    $contagem = 0;
    $gabarito = array();
    $respostas = [];

    foreach ($questoes as $i => $pergunta) {
        $nome_campo = 'questao' . ($i + 1);
        $respostas[$i] = $_POST[$nome_campo];

        if ($respostas[$i] == $pergunta['alternativa_certa']) {
            $contagem++;
        }
        $gabarito[] = $pergunta['alternativa_certa'];
    }
}

if (isset($_POST['refazer'])) {
    unset($_SESSION['questoes']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
include "include.php";

$breadcrumbs = [
    'questionários' => '> <a class="active" href="questionario.php">Questionários</a>'
];

$breadcrumb = implode('>', $breadcrumbs);
navbar($breadcrumb);
?>
<style>
    .correct {
        background-color: #c8e6c9;
    }

    .incorrect {
        background-color: #ffcdd2;
    }

    span.light {
        color: black;
    }
    span.dark{
        color: #fff;
    }
</style>
<link rel="stylesheet" href="css/rocha-mineral.css">

<body>
    <main>
        <div class="container">
            <div class="vertical-line"></div>
            <div class="section-content">
                <div class="section">
                    <h4 class="left-align">Questionário de Rochas e Minerais</h4>
                    <hr class="divider">
                </div>
                <div class="row">
                    <form action="" method="post">
                        <?php if (isset($_POST['enviar'])) : ?>
                            <div class="row">
                                <div class="col s12">
                                    <div class="card-panel">
                                        <span>Você acertou <?= $contagem ?>/<?= count($questoes) ?> questões.</span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <?php
                            $i = 1;
                            $total_questoes = count($questoes);
                            $midpoint = ceil($total_questoes / 2); // Ponto médio para dividir as perguntas em duas colunas

                            foreach ($questoes as $index => $pergunta) :
                                $alternativas = [
                                    'A' => $pergunta['alternativaA'],
                                    'B' => $pergunta['alternativaB'],
                                    'C' => $pergunta['alternativaC'],
                                    'D' => $pergunta['alternativaD'],
                                    'E' => $pergunta['alternativaE'],
                                ];

                                if ($index % $midpoint == 0 && $index != 0) :
                                    echo '</div><div class="col s12 m6">';
                                elseif ($index == 0) :
                                    echo '<div class="col s12 m6">';
                                endif;
                            ?>
                                <div class="card questao">
                                    <div class="card-content">
                                        <span class="card-title color"><?php echo $pergunta['nome']; ?></span>
                                        <span class="card-title color"><?php echo $pergunta['descricao']; ?></span>
                                        <div>
                                            <?php foreach ($alternativas as $key => $alternativa) :
                                                $classe = '';
                                                $checked = '';
                                                if (isset($_POST['enviar'])) {
                                                    if ($respostas[$i - 1] == $key) {
                                                        $checked = 'checked';
                                                        if ($respostas[$i - 1] == $pergunta['alternativa_certa']) {
                                                            $classe = 'correct';
                                                        } else {
                                                            $classe = 'incorrect';
                                                        }
                                                    }
                                                    if ($key == $pergunta['alternativa_certa']) {
                                                        $classe .= ' correct';
                                                    }
                                                }
                                            ?>
                                                <p class="<?= $classe ?>">
                                                    <label class="color">
                                                        <input type="radio" name="questao<?= $i ?>" value="<?= $key ?>" <?= $checked ?> <?= isset($_POST['enviar']) ? 'disabled' : 'required' ?>>
                                                        <span><?= $key ?>) <?= $alternativa ?></span>
                                                    </label>
                                                </p>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            <?php $i++;
                            endforeach ?>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="right-align">
                                    <?php if (isset($_POST['enviar'])) : ?>
                                        <button class="btn waves-effect waves-light" type="submit" name="refazer">Refazer
                                            <i class="material-icons right">refresh</i>
                                        </button>
                                    <?php else : ?>
                                        <button class="btn waves-effect waves-light" type="submit" name="enviar">Enviar
                                            <i class="material-icons right">send</i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </form>
    </main>
    <?php include "footer.php"; ?>
</body>

</html>