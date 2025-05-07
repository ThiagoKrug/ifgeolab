<?php session_start();
include "include.php";

$breadcrumb = "";
navbar($breadcrumb);

require_once('../conecta.php');
$conexao = conectar();
$idusuario = $_SESSION['id'];

$sql = "SELECT * FROM usuario WHERE idusuario =" . $idusuario;
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
    $dados = mysqli_fetch_assoc($resultado);
    $img = $dados['img'];
    $user = $dados['idusuario'];
}
$sqlAmostra = "SELECT 
        usuario.nome, 
        GROUP_CONCAT(DISTINCT mineral.nome ORDER BY mineral.nome SEPARATOR ', ') AS nomes_minerais,
        GROUP_CONCAT(DISTINCT rocha.nome ORDER BY rocha.nome SEPARATOR ', ') AS nomes_rochas
    FROM 
        usuario
    LEFT JOIN 
        mineral ON usuario.idusuario = mineral.idusuario
    LEFT JOIN 
        rocha ON usuario.idusuario = rocha.idusuario
    WHERE 
        usuario.idusuario = $idusuario
    GROUP BY 
        usuario.nome;
    ";

$result = mysqli_query($conexao, $sqlAmostra);
if (mysqli_num_rows($result) > 0) {
    $amostra = mysqli_fetch_assoc($result);
    $mineraisCad = $amostra['nomes_minerais'];
    $rochasCad = $amostra['nomes_rochas'];
}

?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .section-content {
        padding: 20px;
    }

    .vertical-line {
        border-left: 2px solid #ddd;
        height: 100%;
    }

    .divider {
        border: none;
        height: 2px;
        background: #ddd;
        margin: 10px 0;
    }

    h4 {
        font-weight: bold;
        color: #555;
    }

    h5 {
        font-size: 18px;
        margin: 8px 0;
    }

    a {
        margin-right: 10px;
        transition: background-color 0.3s, color 0.3s;
    }

    a:hover {
        filter: brightness(90%);
    }

    .btn.green {
        background-color: #4caf50;
        color: white;
        border: 1px solid #388e3c;
    }

    .btn.red {
        background-color: #e53935;
        color: white;
        border: 1px solid #b71c1c;
    }

    .btn.red-text {
        color: #e53935;
        background-color: transparent;
    }

    /* Ajuste para o layout dos botões e conteúdo */
    .btn-container {
        margin-bottom: 20px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
    }

    .col {
        padding: 10px;
        flex: 1 1 calc(50% - 20px); /* Duas colunas em telas grandes */
    }

    .card-image {
        text-align: center;
    }

    .minha-imagem {
        height: 300px;
        width: 300px;
        object-fit: cover;
        border: 5px solid #ddd;
        border-radius: 50%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Ajuste para telas menores */
    @media (max-width: 768px) {
        .minha-imagem {
            height: 200px;
            width: 200px;
        }

        /* Ajuste os botões para caberem melhor em dispositivos menores */
        .btn-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn {
            font-size: 14px;
            width: 100%;
            margin: 5px 0;
        }
    }

    /* Ajuste para telas muito pequenas (por exemplo, celulares em modo retrato) */
    @media (max-width: 480px) {
        .container {
            padding: 15px;
        }

        .minha-imagem {
            height: 150px;
            width: 150px;
        }

        .btn.green, .btn.red, .btn.red-text {
            font-size: 14px;
        }
    }
</style>

<body>
    <main>
        <div class="container">
            <div class="section-content">
                <div class="section">
                    <h4>Meu Perfil</h4>
                    <hr class="divider">
                    
                    <!-- Botões acima das informações -->
                    <div class="btn-container">
                        <a class="waves-effect waves-light btn green" href="formEdit.php">Editar</a>
                        <a id="btnSair" class="waves-effect waves-light btn red-text">Sair</a>
                        <a id="btnExcluir" class="waves-effect waves-light btn red">Excluir</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12 m6">
                        <h5><b>Nome: </b><?php echo $dados['nome']; ?></h5>
                        <h5><b>Email: </b><?php echo $dados['email']; ?></h5>
                        <h5><b>Matrícula: </b><?php echo $dados['matricula']; ?></h5>
                        <h5><b>Instituição: </b><?php echo $dados['instituto']; ?></h5>
                        <?php if ($amostra['nomes_minerais'] != "") { ?>
                            <h5><b>Minerais Cadastrados: </b><?= $mineraisCad; ?></h5>
                        <?php }
                        if ($amostra['nomes_rochas'] != "") { ?>
                            <h5><b>Rochas Cadastrados: </b><?= $rochasCad; ?></h5>
                        <?php } ?>
                    </div>
                    <div class="col s12 m6">
                        <div class="card-image">
                            <img src="../img/usuarios/<?= $img; ?>" class="minha-imagem">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

<script src="../js/sweetalert.js"></script>
<script>
    const btnSair = document.querySelector('#btnSair');
    btnSair.addEventListener('click', function () {
        Swal.fire({
            title: "Tem certeza que deseja sair?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim"
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "../sair.php";
            }
        });
    });

    const btnExcluir = document.querySelector('#btnExcluir');
    btnExcluir.addEventListener('click', function () {
        Swal.fire({
            title: "Tem certeza que deseja excluir a conta?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim"
        }).then((result) => {
            if (result.isConfirmed) {
                location.href = "excluir.php?deletarUsuario=<?= $user; ?>"
            }
        });
    });
</script>
<?php
include "../footer.php";
?>
