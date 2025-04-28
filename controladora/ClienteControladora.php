<?php
require("../modelo/Cliente.php");
class ClienteControladora{
    private $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function cadastro_cliente($recebe_nome_cliente,$recebe_telefone_cliente,$recebe_endereco_cliente,$recebe_email_cliente)
    {
        $this->cliente->setNome_Cliente($recebe_nome_cliente);
        $this->cliente->setTelefone_Cliente($recebe_telefone_cliente);
        $this->cliente->setEndereco_Cliente($recebe_endereco_cliente);
        $this->cliente->setEmail_Cliente($recebe_email_cliente);
        return $this->cliente->cadastro_cliente();
    }

    public function buscar_clientes()
    {
        return $this->cliente->buscar_clientes();
    }
}
?>