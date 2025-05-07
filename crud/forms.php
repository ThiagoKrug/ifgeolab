<?php
session_start();
include "include.php";
include "quilljs.php";
include "MineralRochaForm.php";
include "QuestionarioForm.php";
include "UsuarioForm.php";

$formtipo = isset($_GET['tipo']) ? $_GET['tipo'] : "";
$id = isset($_GET['id']) ? $_GET['id'] : null;
$sugestao = isset($_GET['sugestao']) ? $_GET['sugestao'] : 0;
if ($id != null) {
  $action = "editar.php";
  $nomeform = 'Editar';
} else {
  $action = "cadastrar.php";
  $nomeform = 'Cadastrar';
}
$breadcrumbs[] = "";

if ($formtipo == 'mineral' or $formtipo == 'rocha') {
  $breadcrumbs = [
    'Amostra' => '> <a href="Amostra.php">Amostras</a>',
    'Atual' => '<a class="active" href="#">' . ucfirst($formtipo) . '</a>'
  ];
} else {
  $breadcrumbs = [
    'Atual' => '> <a class="active" href="#">' . ucfirst($formtipo) . '</a>'
  ];
} 

$breadcrumb = implode('>', $breadcrumbs);

$idusuario = $_SESSION['id'] ?? null;
navbar($breadcrumb);

switch ($formtipo) {
  case "mineral":
  case "rocha":
    $form = new MineralRochaForm($formtipo, $id, $action, $idusuario, $sugestao, $nomeform);
    break;
  case "usuario":
    $form = new UsuarioForm($formtipo, $id, $action, $nomeform);
    break;
  case "questionário":
    $form = new QuestionarioForm($formtipo, $id, $action, $nomeform);
    break;
  default:
    echo "<p>Tipo de formulário inválido.</p>";
    exit;
}
?>

<link rel="stylesheet" href="../css/image.css">

<body>
  <main>
    <div class="container">
      <div class="vertical-line"></div>
      <div class="section-content">
        <div class="section">
          <h4 class="left-align"><?= $nomeform . " ", ucfirst($formtipo) ?></h4>
          <hr class="divider">
        </div>
        <?= $form->render(); ?>
      </div>
    </div>
  </main>

  <?php
  include '../footer.php';
  ?>

  <script src="../js/uploadmulti.js"></script>
  <script src="../js/quill.js"></script>
  <script src="../js/image.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Inicializa os dropdowns do Materialize
      var elems = document.querySelectorAll('.select-dropdown');
      var instances = M.FormSelect.init(elems);
    });
  </script>