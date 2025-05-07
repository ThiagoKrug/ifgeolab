<?php
session_start();
require_once('../conecta.php');
$conexao = conectar();

if (isset($_POST['EditarMineral'])) {
    $obj = $_POST['3d'];
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cat = $_POST['idcat'];
    $descricao = $_POST['descricao'];
    $suges = $_POST['sugestao'];

    if (isset($_FILES['arquivo']) and isset($_FILES['3d'])) {

        //pega a extensao do arquivo
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $extensao3D = strtolower(pathinfo($_FILES['3d']['name'], PATHINFO_EXTENSION));

        //define o nome do arquivo
        $novo_nome = "$nome" . "$extensao";
        $obj = "$nome-3d." . "$extensao3D";

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../img/mineral/";
        $pastaObj = "../obj/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
        move_uploaded_file($_FILES['3d']['tmp_name'], $pastaObj . $obj);

        $sql = "UPDATE mineral SET nome='$nome', idcat = '$cat', descricao = '$descricao', img='$novo_nome', sugestao='$suges', 3d='$obj' WHERE idmineral=$id";
    } elseif (isset($_FILES['arquivo'])) {

        $extensao = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
        $novo_nome = "$nome.$extensao";
        $diretorio = "../img/mineral/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        $sql = "UPDATE mineral SET nome='$nome', idcat = '$cat', descricao = '$descricao', img='$novo_nome', sugestao='$suges' WHERE idmineral=$id";
    }
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['confirm'] = [
            "title" => 'Parabéns!',
            'text' => 'Amostra atualizada com sucesso!',
            'icon' => 'success'
        ];
        header("Location: listarMineral.php");
    } else {
        echo "<script>alert('Não foi possível realizar o cadastro! Erro SQL: " . mysqli_error($conexao) . "'); location.href='../index.php';</script>";
        exit;
    }
} elseif (isset($_POST['EditarRocha'])) {
    $obj = $_POST['3d'];
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cat = $_POST['idcat'];
    $descricao = $_POST['descricao'];
    $suges = $_POST['sugestao'];

    if (isset($_FILES['arquivo']) and isset($_FILES['3d'])) {

        //pega a extensao do arquivo
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $extensao3D = strtolower(pathinfo($_FILES['3d']['name'], PATHINFO_EXTENSION));

        //define o nome do arquivo
        $novo_nome = "$nome" . "$extensao";
        $obj = "$nome-3d." . "$extensao3D";

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../img/rochas/";
        $pastaObj = "../obj/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
        move_uploaded_file($_FILES['3d']['tmp_name'], $pastaObj . $obj);

        $sql = "UPDATE rocha SET nome='$nome', idcat = '$cat', descricao = '$descricao', img='$novo_nome', sugestao='$suges', 3d='$obj' WHERE idrocha=$id";
    } elseif (isset($_FILES['arquivo'])) {
        $extensao = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
        $novo_nome = "$nome". "$extensao";
        $diretorio = "../img/rochas/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        $sql = "UPDATE rocha SET nome='$nome', idcat = '$cat', descricao = '$descricao', img='$novo_nome', sugestao='$suges' WHERE idrocha=$id";
    }
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['confirm'] = [
            "title" => 'Parabéns!',
            'text' => 'Amostra atualizada com sucesso!',
            'icon' => 'success'
        ];
        header("Location: ../index.php");
    } else {
        echo "<script>alert('Não foi possível atualizar a amostra!');
            location.href='listarRocha.php'</script>";
    }
} elseif (isset($_POST['EditarUsuario'])) {

    $id = $_POST['idusuario'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senhaE = $_POST['senha'];
    $matricula = $_POST['matricula'];
    $inst = $_POST['inst'];
    $novo_nome = $_POST['img'];

    if (isset($_FILES['arquivo'])) {

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        $novo_nome = "$nome-" . $id . "." . $extensao;

        $diretorio = "../img/usuarios/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
    }
    $hash = password_hash($senhaE, PASSWORD_DEFAULT);
    if ($hash) {
        if (isset($_FILES['arquivo'])) {
            $sql = "UPDATE usuario SET nome='$nome', email = '$email', senha = '$hash', img = '$novo_nome', matricula = '$matricula', instituto = '$inst' WHERE idusuario=$id";
        } else {
            $sql = "UPDATE usuario SET nome='$nome', email = '$email', senha = '$hash', matricula = '$matricula', instituto = '$inst' WHERE idusuario=$id";
        }
        if (mysqli_query($conexao, $sql)) {
            $_SESSION['confirm'] = [
                "title" => 'Parabéns!',
                'text' => 'Usuário atualizado com sucesso!',
                'icon' => 'success'
            ];
            header("Location: ../index.php");
        } else {
            echo "<script>alert('Não foi possível atualizar o cadastro!');
            </script>";
        }
    } else {
        echo "Erro na encriptografia da senha!!!!";
    }
} elseif (isset($_GET['idmineral'])) {

    $id = $_GET['idmineral'];
    $suges = $_GET['sugestao'];

    $sql = "UPDATE mineral SET sugestao='$suges' WHERE idmineral=$id";
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['confirm'] = [
            "title" => 'Parabéns!',
            'text' => 'Amostra aceita!',
            'icon' => 'success'
        ];
        header("Location: ../index.php");
    } else {
        echo "<script>alert('Não foi possível atualizar a amostra!');
            location.href='listarMineralS.php'</script>";
    }
} elseif (isset($_GET['idrocha'])) {

    $id = $_GET['idrocha'];
    $suges = $_GET['sugestao'];

    $sql = "UPDATE rocha SET sugestao='$suges' WHERE idrocha=$id";
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['confirm'] = [
            "title" => 'Parabéns!',
            'text' => 'Amostra aceita!',
            'icon' => 'success'
        ];
        header("Location: ../index.php");
    } else {
        echo "<script>alert('Não foi possível atualizar a amostra!');
            location.href='listarRochaS.php'</script>";
    }
}
