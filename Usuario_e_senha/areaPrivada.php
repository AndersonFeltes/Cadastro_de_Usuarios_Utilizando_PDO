<?php
    //iniciando a sessão do usuario ja cadastrado
    session_start();

    //testando se um usuario nao cadastrado tenta acesar a página e redirecionando para a página inicial
    if(!isset($_SESSION['id_usuario'])){
        header("location: index.php");
        exit;
    }else{
        echo "<h1> Bem vindo ".$_SESSION['nome']."</h1>";
    }

    if(isset($_GET['logout'])){
        //destruindo a sessão
        unset($_SESSION['id_usuario']);
        unset($_SESSION['nome']);
        //direcionando para a tela inicial
        header("location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Área Privada</title>
</head>
<body>
    <a id="sair" href="?logout=true" >Sair</a>
</body>
</html>