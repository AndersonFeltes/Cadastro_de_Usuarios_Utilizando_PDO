<?php
    class Usuario{

        private $pdo;//VARIAVEL PARA O BANCO DE DADOS
        public $msgErro = "";

        //Este método faz a conexão com o banco de dados
        public function conectar($nome, $host, $usuario, $senha){
            global $pdo;
            //fazendo a conexão com o banco de dados
            try{
                //criando o objeto PDO parametros /nome,servidor,usuario,senha/
                $pdo = new PDO("mysql:dbname=".$nome."; host=".$host,$usuario,$senha);
            }
            catch(PDOException $e){
                //caso der erro sera exibido o que deu errado
                $msgErro = $e->getMessage();
            }
        }

        public function cadastrar($nome, $email, $senha){
            global $pdo;
            //verificar se ja existe o email cadastrado
            $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
            //substituindo o "e" que veio do banco
            $sql->bindValue(":e" ,$email);
            //executando o comando
            $sql->execute();
            //testando se o banco retorna um Id, se retornar ja ha um cadastro
            if($sql->rowCount() > 0){
                return false;// ja esta cadastrada
            }
            else{
                //inserindo os dados do usuario a tabela no banco de dados
                $sql = $pdo->prepare("INSERT INTO usuarios(nome, email, senha) VALUES (:n, :e, :s)");
                $sql->bindValue(":n" ,$nome);
                $sql->bindValue(":e" ,$email);
                $sql->bindValue(":s" ,md5($senha));
                $sql->execute();
                return true;
            }
        }

        public function logar($email, $senha){
            global $pdo;
            //verificar se o email e senha estão cadastrados
            $sql = $pdo->prepare("SELECT id_usuario , nome FROM usuarios WHERE email = :e AND senha = :s");
            $sql->bindValue(":e" ,$email);
            $sql->bindValue(":s" ,md5($senha));
            $sql->execute();

            //testando se foram recebidos dados do Banco
            if($sql->rowCount() > 0){
                //entrar no sistema /sessão
                //funçao "fetch" transforma os dados em um Array
                $dado = $sql->fetch();
                //iniciando uma sessão e armazenando os dados
                session_start();
                $_SESSION['id_usuario'] = $dado['id_usuario'];
                $_SESSION['nome'] = $dado['nome'];
                return true;
                //logado com sucesso
            }
            else{
                return false; //não foi possível logar
            }

        }
    }
?>