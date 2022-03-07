<?php
    require_once './Classes/Usuario.php';
    $user = new Usuario;
?>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Projeto de Login</title>
        <link rel="stylesheet" href="./CSS/style.css">
    </head>
    <body>
        <div id="form-div">
            <h1>Entrar</h1>
            <form method="POST">
                <input type="email" name="email" placeholder="Usuário">
                <input type="password" name="senha" placeholder="Senha">
                <input type="submit" name="ACESSAR" value="ACESSAR" id="botao">
                <a href="cadastrar.php">Ainda não é inscrito? <strong>Cadastre-se!</strong></a>
            </form>
        </div>
        <?php
            if(isset($_POST['ACESSAR'])){
                //função addslashes remove comandos maliciosos enviados pelo formulario / teste para segurança
                $email = addslashes($_POST['email']);
                $senha = addslashes($_POST['senha']);
                //verificar se tudo foi preenchido
                if(!empty($email) && !empty($senha))
                {
                    //fazendo a conexão com o banco
                    $user->conectar("projeto_login" , "localhost" , "root" , "");
                    if($user->msgErro == ""){
                        //validando email e senha do usuário
                        if($user->logar($email, $senha)){
                            header("location: areaPrivada.php");
                        }else{
                            echo "Email e/ou senha estão incorretos!!";
                        }
                    }else{
                        echo "Erro: ".$user->msgErro;
                    }
                }else{
                    echo "Preencha todos os campos!!";
                }
            }
        ?>
    </body>
</html>