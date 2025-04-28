<?php
session_start();
require("Conexao.php");
class Usuario{
    private $codigo_usuario;
    private $nome_usuario;
    private $login_usuario;
    private $senha_usuario;
    private $email_usuario;
    private $perfil_usuario;

    public function setCodigo_Usuario($codigo_usuario)
    {
        $this->codigo_usuario = $codigo_usuario;
    }

    public function getCodigo_Usuario()
    {
        return $this->codigo_usuario;
    }

    public function setNome_Usuario($nome_usuario)
    {
        $this->nome_usuario = $nome_usuario;
    }

    public function getNome_Usuario()
    {
        return $this->nome_usuario;
    }

    public function setLogin_Usuario($login_usuario)
    {
        $this->login_usuario = $login_usuario;
    }

    public function getLogin_Usuario()
    {
        return $this->login_usuario;
    }

    public function setSenha_Usuario($senha_usuario)
    {
        $this->senha_usuario = $senha_usuario;
    }

    public function getSenha_Usuario()
    {
        return $this->senha_usuario;
    }

    public function setEmail_Usuario($email_usuario)
    {
        $this->email_usuario = $email_usuario;
    }

    public function getEmail_Usuario()
    {
        return $this->email_usuario;
    }

    public function setPerfil_Usuario($perfil_usuario)
    {
        $this->perfil_usuario = $perfil_usuario;
    }

    public function getPerfil_Usuario()
    {
        return $this->perfil_usuario;
    }

    public function autentica_usuario()
    {
        try{
            $instrucao_autentica_usuario = "select * from usuario where login_usuario = :recebe_login_recebido and senha_usuario = :recebe_senha_recebida";
            $comando_autentica_usuario = Conexao::Obtem()->prepare($instrucao_autentica_usuario);
            $comando_autentica_usuario->bindValue(":recebe_login_recebido",$this->getLogin_Usuario());
            $comando_autentica_usuario->bindValue(":recebe_senha_recebida",$this->getSenha_Usuario());
            $comando_autentica_usuario->execute();
            $resultado_autentica_usuario = $comando_autentica_usuario->fetch(PDO::FETCH_ASSOC);

            if(!empty($resultado_autentica_usuario))
            {
                $_SESSION["recebe_nome_usuario"] = $resultado_autentica_usuario["nome_usuario"];
                return true;
            }else{
                return false;
            }
        }catch(PDOException $exception)
        {
            return $exception->getMessage();
        }catch(Exception $excecao)
        {
            return $excecao->getMessage();
        }finally{
            Conexao::$conexao = null;
        }
    }

    public function cadastra_usuario()
    {
        try{
            $instrucao_cadastra_usuario = "insert into usuario(nome_usuario,login_usuario,senha_usuario,email_usuario,perfil_usuario)values
            (:recebe_nome_usuario,:recebe_login_usuario,:recebe_senha_usuario,:recebe_email_usuario,:recebe_perfil_usuario)";
            $comando_cadastra_usuario = Conexao::Obtem()->prepare($instrucao_cadastra_usuario);
            $comando_cadastra_usuario->bindValue(":recebe_nome_usuario",$this->getNome_Usuario());
            $comando_cadastra_usuario->bindValue(":recebe_login_usuario",$this->getLogin_Usuario());
            $comando_cadastra_usuario->bindValue(":recebe_senha_usuario",$this->getSenha_Usuario());
            $comando_cadastra_usuario->bindValue(":recebe_email_usuario",$this->getEmail_Usuario());
            $comando_cadastra_usuario->bindValue(":recebe_perfil_usuario",$this->getPerfil_Usuario());
            $comando_cadastra_usuario->execute();
            $recebe_ultimo_codigo_registrado_cadastro_usuario = Conexao::Obtem()->lastInsertId();
            return $recebe_ultimo_codigo_registrado_cadastro_usuario;
        }catch(PDOException $exception)
        {
            return $exception->getMessage();
        }catch(Exception $excecao)
        {
            return $excecao->getMessage();
        }finally{
            Conexao::$conexao = null;
        }
    }

    public function busca_usuarios()
    {
        $registros_usuarios = array();

        try{
            $instrucao_busca_usuarios = "select * from usuario";
            $comando_busca_usuarios = Conexao::Obtem()->prepare($instrucao_busca_usuarios);
            $comando_busca_usuarios->execute();
            $registros_usuarios = $comando_busca_usuarios->fetchAll(PDO::FETCH_ASSOC);
            return $registros_usuarios;
        }catch(PDOException $exception)
        {
            return $exception->getMessage();
        }catch(Exception $excecao)
        {
            return $excecao->getMessage();
        }finally{
            Conexao::$conexao = null;
        }
    }
}
?>