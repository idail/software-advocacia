<?php
require("Conexao.php");
class Cliente{
    private $codigo_cliente;
    private $nome_cliente;
    private $telefone_cliente;
    private $endereco_cliente;
    private $email_cliente;

    public function setCodigo_Cliente($codigo_cliente)
    {
        $this->codigo_cliente = $codigo_cliente;
    }

    public function getCodigo_Cliente()
    {
        return $this->codigo_cliente;
    }

    public function setNome_Cliente($nome_cliente)
    {
        $this->nome_cliente = $nome_cliente;
    }

    public function getNome_Cliente()
    {
        return $this->nome_cliente;
    }

    public function setTelefone_Cliente($telefone_cliente)
    {
        $this->telefone_cliente = $telefone_cliente;
    }

    public function getTelefone_Cliente()
    {
        return $this->telefone_cliente;
    }

    public function setEndereco_Cliente($endereco_cliente)
    {
        $this->endereco_cliente = $endereco_cliente;
    }

    public function getEndereco_Cliente()
    {
        return $this->endereco_cliente;
    }

    public function setEmail_Cliente($email_cliente)
    {
        $this->email_cliente = $email_cliente;
    }

    public function getEmail_Cliente()
    {
        return $this->email_cliente;
    }

    public function cadastro_cliente()
    {
        try{
            $instrucao_cadastro_cliente = "insert into cliente(nome_cliente,telefone_cliente,endereco_cliente,
            email_cliente)values(:recebe_nome_cliente,:recebe_telefone_cliente,:recebe_endereco_cliente,:recebe_email_cliente)";
            $comando_cadastro_cliente = Conexao::Obtem()->prepare($instrucao_cadastro_cliente);
            $comando_cadastro_cliente->bindValue(":recebe_nome_cliente",$this->getNome_Cliente());
            $comando_cadastro_cliente->bindValue(":recebe_telefone_cliente",$this->getTelefone_Cliente());
            $comando_cadastro_cliente->bindValue(":recebe_endereco_cliente",$this->getEndereco_Cliente());
            $comando_cadastro_cliente->bindValue(":recebe_email_cliente",$this->getEmail_Cliente());
            $comando_cadastro_cliente->execute();
            $recebe_ultimo_codigo_registrado_cliente = Conexao::Obtem()->lastInsertId();
            return $recebe_ultimo_codigo_registrado_cliente;
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

    public function buscar_clientes()
    {   
        $registros_clientes = array();
        try{
            $instrucao_busca_clientes = "select * from cliente";
            $comando_busca_clientes = Conexao::Obtem()->prepare($instrucao_busca_clientes);
            $comando_busca_clientes->execute();
            $registros_clientes = $comando_busca_clientes->fetchAll(PDO::FETCH_ASSOC);
            return $registros_clientes;
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