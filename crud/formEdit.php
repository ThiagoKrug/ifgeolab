<?php
session_start();
require_once('../conecta.php');
$conexao = conectar();

$sql = "SELECT * FROM usuario WHERE idusuario =" . $_SESSION['id'];
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
  $dados = mysqli_fetch_assoc($resultado);
  $img = $dados['img'];
}
include "include.php";
$breadcrumb = "";
navbar($breadcrumb);
?>

<style>
  .minha-imagem {
    height: 220px;
    width: 220px;
    object-fit: cover;
  }

  .tabs .tab a {
    color: #fff;
    border-right: solid 1px grey;
  }


  .tabs .tab a:hover {
    background-color: #eee;
    color: black;
  }

  .tabs .tab a.active {
    color: #000;
  }

  .tabs .indicator {
    background-color: #000;
  }

  .icon {
    height: 32px;
    width: 32px;
    align-items: center;
    position: absolute;
  }
</style>

<body>
  <main>
    <div class="container">
      <div class="vertical-line"></div>
      <div class="section-content">
        <div class="section">
          <h4 class="left-align">Editar Perfil</h4>
          <hr class="divider">
        </div>
        <div class="row">
          <form action="editar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idusuario" value="<?= $_SESSION['id'] ?>">
            <div class="input-field col s12">
              <label for="Nome"> Nome </label><br>
              <input type="text" name="nome" required value="<?php echo $dados['nome']; ?>" />
            </div>
            <div class="input-field col s12">
              <label for="Email"> Email </label><br>
              <input type="text" name="email" required value="<?php echo $dados['email']; ?>" />
            </div>
            <div class="input-field col s12">
              <label for="Senha"> Senha </label><br>
              <input type="password" name="senha" required value="<?php echo $_SESSION['senha']; ?>" />
            </div>
            <div class="input-field col s12">
              <label for="Matrícula"> Matrícula: </label><br>
              <input type="text" name="matricula" required value="<?php echo $dados['matricula']; ?>" />
            </div>
            <div class="input-field col s12">
              <label for="Instituição"> Instituição: </label><br>
              <input type="text" name="inst" required value="<?php echo $dados['instituto']; ?>" />
            </div>

            <div class="input-field col s12">
              <div class="row">
                <div class="col s3">
                  <label> Insira uma foto de perfil:</label><br><br>
                  <img src="../img/usuarios/<?= $img; ?>" class="minha-imagem materialboxed circle">
                  <h6>Foto atual</h6></img><br><br>
                  <input type="hidden" name="img" value="<?php echo $dados['img'] ?>">
                  <input class="form-control" type="file" name="arquivo" />
                </div>
              </div>
            </div>

            <div class="input-field col s12">
              <button class="btn btn-primary green" type="submit" name="EditarUsuario"> Editar </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </main>
</body>
<?php
include "../footer.php";
?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var elems = document.querySelectorAll('.materialboxed');
    var instances = M.Materialbox.init(elems, options);
  });
</script>