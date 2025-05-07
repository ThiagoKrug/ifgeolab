<style>
  .sticky-nav {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 6;
    opacity: 0;
    animation: fadeIn 1s ease-in-out forwards;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .nav-wrapper {
    display: flex;
    justify-content: space-between;
  }

  .breadcrumb-container {
    display: flex;
    align-items: center;
    opacity: 0;
    animation: breadcrumbIn 0.6s ease-in-out forwards;
  }

  @keyframes breadcrumbIn {
    from {
      opacity: 0;
      transform: translateX(-20px);
    }

    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .breadcrumb-container li {
    display: inline;
    padding-right: 10px;
    opacity: 0;
    animation: breadcrumbItemIn 0.5s ease-in-out forwards;
    animation-delay: 0.2s;
  }

  @keyframes breadcrumbItemIn {
    from {
      opacity: 0;
      transform: translateX(-10px);
    }

    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .nav_color2 {
    top: 64px;
    opacity: 0;
    animation: fadeInNav 1s ease-in-out forwards;
  }

  @keyframes fadeInNav {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .logolink {
    padding: 0 !important;
  }

  .perfil-container img {
    height: 30px;
    width: 30px;
    border-radius: 50%;
    margin-left: 10px;
    transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
  }

  .perfil-container img:hover {
    transform: scale(1.2);
    opacity: 0.8;
  }

  .sidenav {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100vh;
  }

  /* Logo in footer animation */
  .logo-footer {
    text-align: center;
    padding: 20px 0;
  }
</style>

<?php
require_once('conecta.php');
$conexao = conectar();

$sql = "SELECT * FROM usuario WHERE idusuario =" . $_SESSION['id'];
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
  $dados = mysqli_fetch_assoc($resultado);
  $img = $dados['img'];
}
?>

<nav class="nav_color sticky-nav">
  <div class="nav-wrapper">

    <!-- Lado direito - Aparece apenas em telas grandes -->
    <ul class="left hide-on-med-and-down">
      <li><a href="index.php" class="logolink"><img src="img/geolab-branco.png" alt="Logo do site" height="60"
            width="auto"></a></li>
      <li class="breadcrumb-container"><?= $breadcrumb ?></li>
    </ul>

    <!-- Lado esquerdo - Aparece apenas em telas grandes -->
    <ul class="right hide-on-med-and-down">
      <li><a href="index.php">Início</a></li>
      <?php if ($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3): ?>
        <li>
          <a class="dropdown-trigger" href="#!" data-target="dropdown1">Cadastrar<i
              class="material-icons right">arrow_drop_down</i></a>
        </li>
      <?php endif; ?>
      <li><a href="crud/editUser.php?idusuario=<?= $_SESSION['id']; ?>" class="perfil-container"><?= $dados['nome']; ?>
          <img src="img/usuarios/<?= $img; ?>" alt="Imagem de perfil"></a></li>
    </ul>

    <ul class="left hide-on-large-only">
      <li><a href="index.php" class="logolink"><img src="img/geolab-branco.png" alt="Logo do site" height="60"
            width="auto"></a></li>
    </ul>

    <ul class="right hide-on-large-only">
      <li><a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a></li>
    </ul>
  </div>

  <nav class="nav_color2 sticky-nav">
    <ul class="left">
      <li><a href="rank.php">Colaboradores</a></li>
    </ul>
    <ul class="right">
      <li><button id="toggleDarkMode" class="toggle-button">Alternar Modo</button></li>
    </ul>
  </nav>
</nav>

<!-- Dropdown Content (Desktop) -->
<?php if ($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3) { ?>
  <ul id="dropdown1" class="dropdown-content">
    <?php if ($_SESSION['permissao'] == 3): ?>
      <li><a href="crud/listarUsuario.php">Usuários</a></li>
    <?php endif; ?>
    <li><a href="crud/listarQuestao.php">Questões</a></li>
    <li><a href="crud/Sugestao.php">Sugestões</a></li>
    <li><a href="crud/Amostra.php">Amostras</a></li>
  </ul>
<?php } ?>

<!-- Mobile Sidenav (menu lateral) -->
<ul class="sidenav white-text #212121 grey darken-4" id="mobile-demo">
  <!-- Conteúdo da sidebar -->
  <div class="sidenav-content">
    <li><a class="sidenav-close white-text" href="#!"><i class="material-icons white-text">clear</i>Fechar</a></li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a class="white-text" href="index.php">Início</a></li>
    <?php if ($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3) { ?>
      <?php if ($_SESSION['permissao'] == 3): ?>
        <li><a class="white-text" href="crud/listarUsuario.php">Usuários</a></li>
      <?php endif; ?>
      <li><a class="white-text" href="crud/forms.php?tipo=questionario">Cadastrar Questões</a></li>
      <li><a class="white-text" href="crud/Sugestao.php">Cadastrar Sugestões</a></li>
      <li><a class="white-text" href="crud/Amostra.php">Cadastrar Amostras</a></li>
    <?php } ?>
    <li><a href="crud/editUser.php?idusuario=<?= $_SESSION['id']; ?>" class="white-text perfil-container">
        <img src="img/usuarios/<?= $img; ?>" alt="Imagem de perfil"> <?= $dados['nome']; ?></a></li>
    <hr>
  </div>
  <div class="logo-footer">
    <img class="responsive-img" src="img/geolab-branco.png" alt="Logo IFGeoLab">
  </div>
</ul>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, {
      click: true
    });

    // Inicializar Sidenav (menu lateral para mobile)
    var sidenavElems = document.querySelectorAll('.sidenav');
    var sidenavInstances = M.Sidenav.init(sidenavElems, {
      edge: 'right'
    });
  });
</script>