<?php
    require_once './Classes/Usuario.php';
    $user = new Usuario;
?>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Cadastro de Login</title>
        <link rel="stylesheet" href="./CSS/style.css">
    </head>
    <body>
        <div id="form-div-Cad">
            <h1>Cadastrar</h1>
            <form method="POST">
                <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">  
                <input type="email" name="email" placeholder="Email" maxlength="40">
                <input type="password" name="senha" placeholder="Senha" maxlength="15">
                <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15">
                <input type="submit" name="CADASTRAR" value="CADASTRAR" id="botao">
            </form>
        </div>
    <?php
        if(isset($_POST['CADASTRAR'])){
            //função addslashes remove comandos maliciosos enviados pelo formulario / teste para segurança
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $confSenha = addslashes($_POST['confSenha']);
            //verificar se tudo foi preenchido
            if(!empty($nome) && !empty($email) && !empty($senha) && !empty($confSenha))
            {
                //fazendo a conexão com o banco
                $user->conectar("projeto_login" , "localhost", "root" , "");
                if($user->msgErro == "")//esta tudo certo
                {
                    if($senha == $confSenha)
                    {
                        if($user->cadastrar($nome ,$email ,$senha))
                        {
                            ?>
                            <div id="msg-sucesso">
                                Cadastrado com sucesso!! Acesse para entrar!!
                            </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="msg-erro">
                                Email já cadastrado!!
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <div class="msg-erro">
                            Senha e Confirmar Senha não são iguais
                        </div>
                        <?php
                    }
                }
                else{
                    ?>
                    <div class="msg-erro">
                        <?php echo "Erro: ".$u->msgErro;  ?>
                    </div>
                    <?php
                }
            }
            else
            {
                ?>
                <div class="msg-erro">
                    Preencha todos os campos!
                </div>
                <?php
            }
        }
    ?>
    </body>
</html>