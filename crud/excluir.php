<?php
session_start();
require_once('../conecta.php');
$conexao = conectar();

if (isset($_GET['deletarMineral'])) {
    $id = $_GET['deletarMineral'];

    $diretorio = "../img/mineral/";
    $diretorio3d = "../obj/";

    $sql = "SELECT * FROM mineral WHERE idmineral=$id";
    $resultado = mysqli_query($conexao, $sql);
    $mineral = mysqli_fetch_assoc($resultado);

    $sql1 = "DELETE FROM mineral WHERE idmineral=$id";
    $sql2 = "DELETE FROM img_mineral WHERE idmineral=$id";
    if (mysqli_query($conexao, $sql1) and mysqli_query($conexao, $sql2)) {
        unlink($diretorio . $mineral['img']);
        unlink($diretorio3d . $mineral['3d']);
        $_SESSION['excluir'] = [
            'title' => 'Parabéns!',
            'text' => 'Amostra deletada!',
            'icon' => 'success'
        ];
        header("Location: listarMineral.php");
    } else {
        echo "<script>alert('Não foi possível deletar a amostra!');
        location.href='listarMineral.php'</script>";
    }
} elseif (isset($_GET['deletarRocha'])) {
    $id = $_GET['deletarRocha'];

    $diretorio = "../img/rochas/";
    $diretorio3d = "../obj/";

    $sql = "SELECT * FROM rocha WHERE idrocha=$id";
    $resultado = mysqli_query($conexao, $sql);
    $rocha = mysqli_fetch_assoc($resultado);

    $sql1 = "DELETE FROM rocha WHERE idrocha=$id";
    $sql2 = "DELETE FROM img_rocha WHERE idrocha=$id";
    if (mysqli_query($conexao, $sql1) and mysqli_query($conexao, $sql2)) {
        unlink($diretorio . $rocha['img']);
        unlink($diretorio3d . $rocha['3d']);
        $_SESSION['excluir'] = [
            'title' => 'Parabéns!',
            'text' => 'Amostra deletada!',
            'icon' => 'success'
        ];
        header("Location: listarRocha.php");
    } else {
        echo "<script>alert('Não foi possível deletar a amostra!');
            location.href='listarRocha.php'</script>";
    }
} elseif (isset($_GET['deletarUsuario'])) {
    $id = $_GET['deletarUsuario'];

    $sql1 = "DELETE FROM usuario WHERE idusuario=$id";
    $_SESSION['excluir'] = [
        'title' => 'Parabéns!',
        'text' => 'Conta deletada!',
        'icon' => 'success'
    ];
    header("Location: ../login.php");
    if (mysqli_query($conexao, $sql1)) {
        session_start();

        session_destroy();
    } else {
        echo "<script>alert('Não foi possível deletar a conta!');
            location.href='editUser.php'</script>";
    }

} elseif (isset($_GET['deletarquestoes'])) {
    $id = $_GET['deletarquestoes'];

    $sql1 = "DELETE FROM questoes WHERE id_questao=$id";
    $_SESSION['excluir'] = [
        'title' => 'Parabéns!',
        'text' => 'Conta deletada!',
        'icon' => 'success'
    ];
    header("Location: ../login.php");
    if (mysqli_query($conexao, $sql1)) {
        session_start();

        session_destroy();
    } else {
        echo "<script>alert('Não foi possível deletar a conta!');
            location.href='editUser.php'</script>";
    }
}
