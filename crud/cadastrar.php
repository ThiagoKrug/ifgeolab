<?php
session_start();
require_once('../conecta.php');
$conexao = conectar();

if (isset($_POST['CadastrarMineral'])) {
    $nome = $_POST['nome'];
    $cat = $_POST['idcat'];
    $desc = $_POST['descricao'];
    $suges = $_POST['sugestao'];
    $idusuario = $_POST['idusuario'];

    if (isset($_FILES['arquivo']) and isset($_FILES['3d'])) {
        // Pega a extensão do arquivo
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $extensao3D = strtolower(pathinfo($_FILES['3d']['name'], PATHINFO_EXTENSION));

        // Define o nome do arquivo
        $novo_nome = "$nome.$extensao";
        $obj = "$nome-3d." . "$extensao3D";

        // Define a pasta para onde enviaremos o arquivo
        $diretorio = "../img/mineral/";
        $pastaObj = "../obj/";

        // Faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
        move_uploaded_file($_FILES['3d']['tmp_name'], $pastaObj . $obj);

        // Cadastra no banco
        $sql = "INSERT INTO mineral(nome, idcat, descricao, img, sugestao, 3d, idusuario) VALUES ('$nome', '$cat', '$desc', '$novo_nome', '$suges', '$obj', '$idusuario')";
    } elseif (isset($_FILES['arquivo'])) {
        $extensao = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
        $novo_nome = "$nome.$extensao";
        $diretorio = "../img/mineral/";
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        $sql = "INSERT INTO mineral(nome, idcat, descricao, img, sugestao, idusuario) VALUES ('$nome', '$cat', '$desc', '$novo_nome', '$suges', '$idusuario')";
    }
    if (mysqli_query($conexao, $sql)) {
        $_SESSION['confirm'] = [
            "title" => 'Parabéns!',
            'text' => 'Mineral cadastrado com sucesso!',
            'icon' => 'success'
        ];
        if ($_SESSION['permissao'] == 1) {
            header("Location: ../index.php");
        } else {
            header("Location: listarRocha.php");
        }
    } else {
        echo "<script>alert('Não foi possível realizar o cadastro! Erro SQL: " . mysqli_error($conexao) . "'); location.href='../index.php';</script>";
        exit;
    }
} elseif (isset($_POST['CadastrarRocha'])) {
    $nome = $_POST['nome'];
    $cat = $_POST['idcat'];
    $descricao = $_POST['descricao'];
    $suges = $_POST['sugestao'];
    $idusuario = $_POST['idusuario'];

    if (isset($_FILES['arquivo']) and isset($_FILES['3d'])) {

        //pega a extensao do arquivo
        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
        $extensao3D = strtolower(pathinfo($_FILES['3d']['name'], PATHINFO_EXTENSION));

        //define o nome do arquivo
        $novo_nome = "$nome" . $extensao;
        $obj = $_FILES['3d']['name'];

        //define a pasta para onde enviaremos o arquivo
        $diretorio = "../img/rochas/";
        $pastaObj = "../obj/";

        //faz o upload, movendo o arquivo para a pasta especificada
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
        move_uploaded_file($_FILES['3d']['tmp_name'], $pastaObj . $obj);

        //cadastra no banco

        $sql = "INSERT INTO rocha(nome, idcat, descricao, img, sugestao, 3d, idusuario) VALUES ('$nome', '$cat', '$descricao', '$novo_nome', '$suges', '$obj', '$idusuario')";
    } elseif (isset($_FILES['arquivo'])) {

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        $novo_nome = "$nome" . $extensao;

        $diretorio = "../img/rochas/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);

        $sql = "INSERT INTO rocha(nome, idcat, descricao, img, sugestao, idusuario) VALUES ('$nome', '$cat', '$descricao', '$novo_nome', '$suges', '$idusuario')";
    }

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['confirm'] = [
            "title" => 'Parabéns!',
            'text' => 'Rocha cadastrada com sucesso!',
            'icon' => 'success'
        ];
        if ($_SESSION['permissao'] == 1) {
            header("Location: ../index.php");
        } else {
            header("Location: listarRocha.php");
        }
    } else {
        echo "<script>alert('Não foi possível realizar o cadastro! Erro SQL: " . mysqli_error($conexao) . "'); location.href='../index.php';</script>";
        exit;
    }
} elseif (isset($_POST['CadastrarUsuario'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $matricula = $_POST['matricula'];
    $inst = $_POST['inst'];

    if (isset($_FILES['arquivo']) and $_FILES['arquivo']['size'] > 0) {

        $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

        $novo_nome = "$nome-" . $extensao;

        $diretorio = "../img/usuarios/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
    } else {
        $novo_nome = "usuario.png";
        $diretorio = "../img/usuarios/";

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novo_nome);
    }

    $hash = password_hash($senha, PASSWORD_DEFAULT);

    if ($hash) {
        $sql = "INSERT INTO usuario(nome, email, senha, img, matricula, instituto) VALUES ('$nome','$email', '$hash', '$novo_nome', '$matricula', '$inst')";

        if (mysqli_query($conexao, $sql)) {
            $_SESSION['confirm'] = [
                "title" => 'Parabéns!',
                'text' => 'Cadastrado realizado com sucesso!',
                'icon' => 'success'
            ];
            header("Location: ../login.php?form=login");
        } else {
            echo "<script>alert('Não foi possível realizar o cadastro! Erro SQL: " . mysqli_error($conexao) . "'); location.href='../login.php?form=register';</script>";
            exit;
        }
    } else {
        echo "Erro na encriptografia da senha!!!!";
    }
} elseif (isset($_POST['CadastrarQuestao'])) {
    $descricao = $_POST['descricao'];
    $nome = $_POST['nome'];
    $alternativas = $_POST['alternativas'];
    $alternativa1 = $_POST['alternativa1'];
    $alternativa2 = $_POST['alternativa2'];
    $alternativa3 = $_POST['alternativa3'];
    $alternativa4 = $_POST['alternativa4'];
    $alternativa5 = $_POST['alternativa5'];

    $sql = "INSERT INTO questoes(nome, descricao, alternativa_certa, alternativa_1, alternativa_2, alternativa_3, alternativa_4, alternativa_5) 
                    VALUES ('$nome', '$descricao', '$alternativas', '$alternativa1', '$alternativa2', '$alternativa3', '$alternativa4', '$alternativa5')";

    if (mysqli_query($conexao, $sql)) {
        $_SESSION['confirm'] = [
            "title" => 'Parabéns!',
            'text' => 'Cadastrado realizado com sucesso!',
            'icon' => 'success'
        ];
        header("Location: ../index.php");
    } else {
        echo "<script>alert('Não foi possível realizar o cadastro! Erro SQL: " . mysqli_error($conexao) . "'); location.href='../index.php';</script>";
        exit;
    }
} else {
    echo "Tipo de cadastro indefinido.";
    exit;
}
