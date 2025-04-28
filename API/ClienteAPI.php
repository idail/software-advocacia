<?php

require("../controladora/ClienteControladora.php");

header('Access-Control-Allow-Origin: *');

header("Access-Control-Allow-Methods: POST , GET");

$cliente_controladora = new ClienteControladora();
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $recebe_processo_cliente = $_POST["processo_cliente"];

    if($recebe_processo_cliente === "cadastro_cliente")
    {
        $recebe_nome_cliente_cadastro = $_POST["valor_nome_cliente_cadastro"];
        $recebe_telefone_cliente_cadastro = $_POST["valor_telefone_cliente_cadastro"];
        $recebe_endereco_cliente_cadastro = $_POST["valor_endereco_cliente_cadastro"];
        $recebe_email_cliente_cadastro = $_POST["valor_email_cliente_cadastro"];
        $resultado_cadastro_cliente = $cliente_controladora->cadastro_cliente($recebe_nome_cliente_cadastro,
        $recebe_telefone_cliente_cadastro,$recebe_endereco_cliente_cadastro,$recebe_email_cliente_cadastro);
        echo json_encode($resultado_cadastro_cliente);
    }
}else if($_SERVER["REQUEST_METHOD"] === "GET")
{
    $recebe_processo_cliente = $_GET["processo_cliente"];

    if($recebe_processo_cliente === "buscar_clientes")
    {
        $resultado_buscar_clientes = $cliente_controladora->buscar_clientes();
        echo json_encode($resultado_buscar_clientes);
    }
}