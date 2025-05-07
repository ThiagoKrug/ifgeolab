<?php
session_start();
if (isset($_POST['login'])) {

    require_once('conecta.php');
    $conexao = conectar();

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE email='$email'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        if (password_verify($senha, $dados['senha'])) {
            $_SESSION['usuario'] = $dados['nome'];
            $_SESSION['senha'] = $senha;
            $_SESSION['email'] = $email;
            $_SESSION['permissao'] = $dados['tipo'];
            $_SESSION['id'] = $dados['idusuario'];
            $img = $dados['img'];
            $_SESSION['login'] = [
                'title' => 'Seja bem-vindo ' . $_SESSION['usuario'] . '!',
                'imageUrl' => 'img/usuarios/' . $img,
                'imageWidth' => 150,
                'imageHeight' => 150,
                'background' => '#3A5A40',
                'color' => '#ffffff',
                'timer' => 1500,
                'showConfirmButton' => false,
                'customClass' => [
                    'popup' => 'custom-popup',
                    'image' => 'custom-image',
                    'title' => 'custom-title',
                    'content' => 'custom-content',
                    'confirmButton' => 'custom-button',
                ],
                'html' => '<div class="custom-footer-image"><img src="img/geolab-verde.png" alt="Logo Geolab" /></div>'
            ];
            header("Location: index.php");
        } else {
            echo "<script>alert('Senha incorreta.');</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado.');</script>";
    }
}
include "include.php";
?>
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet' />
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/image.css">

<body>
    <div class="login">
        <!-- Formulário de login -->
        <div class="login-section login">
            <h1>Login</h1>
            <hr class="login">
            <form method="post">
                <div class="form-group">
                    <div class="input-field">
                        <label for="email">Email</label> <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="senha">Senha</label> <i class="fas fa-lock"></i>
                        <input type="password" name="senha" id="senha" required />
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="login">Entrar</button>
                </div>
            </form>
            <div class="center">
                <a href="javascript:void(0);" onclick="toggleForm()">Cadastre-se já</a>
            </div>
        </div>

        <!-- Formulário de cadastro -->
        <div class="login-section register">
            <h1>Cadastrar</h1>
            <hr class="login">
            <form action="crud/cadastrar.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="input-field">
                        <label for="nome">Nome</label> <i class="fas fa-user"></i>
                        <input type="text" name="nome" id="nome" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="email">Email</label> <i class="fas fa-envelope"></i>
                        <input type="email" name="email" id="email" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="senha">Senha</label> <i class="fas fa-lock"></i>
                        <input type="password" name="senha" id="senha" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="matricula">Matrícula</label> <i class="fas fa-id-card"></i>
                        <input type="text" name="matricula" id="matricula" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-field">
                        <label for="inst">Instituição</label> <i class="fas fa-school"></i>
                        <input type="text" name="inst" id="inst" required />
                    </div>
                </div>
                <div class="form-group">
                    <div class="img-area" data-img="">
                        <i class='bx bxs-cloud-upload icon'></i>
                        <h3>Envie uma Foto de Perfil</h3>
                        <p>A Imagem não pode ser maior que <span>20MB</span></p>
                        <input name="arquivo" type="file" id="Capa" style="display: none;">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="CadastrarUsuario">Cadastrar</button>
                </div>
            </form>
            <div class="center">
                <a href="javascript:void(0);" onclick="toggleForm()">Já tenho uma conta</a>
            </div>
        </div>

        <div class="image-section"></div>
    </div>

    <script>
        function toggleForm() {
            const loginSection = document.querySelector('.login-section.login');
            const registerSection = document.querySelector('.login-section.register');

            // Alterna entre login e cadastro
            if (loginSection.style.display === 'none') {
                loginSection.style.display = 'flex';
                registerSection.style.display = 'none';
                localStorage.setItem('form', 'login'); // Salva a preferência no localStorage
            } else {
                loginSection.style.display = 'none';
                registerSection.style.display = 'flex';
                localStorage.setItem('form', 'register'); // Salva a preferência no localStorage
            }
        }

        window.onload = function() {
            const loginSection = document.querySelector('.login-section.login');
            const registerSection = document.querySelector('.login-section.register');

            // Obtém o parâmetro 'form' da URL
            const urlParams = new URLSearchParams(window.location.search);
            const formParam = urlParams.get('form');

            if (formParam === 'login') {
                // Força o estado de login
                localStorage.setItem('form', 'login');
            }

            // Carrega a preferência salva
            if (localStorage.getItem('form') === 'register') {
                loginSection.style.display = 'none';
                registerSection.style.display = 'flex';
            } else {
                loginSection.style.display = 'flex';
                registerSection.style.display = 'none';
            }
        };
    </script>
    <script src="js/image.js"></script>