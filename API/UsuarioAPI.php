<?php

require("../controladora/UsuarioControladora.php");

header('Access-Control-Allow-Origin: *');

header("Access-Control-Allow-Methods: POST , GET");

$usuario_controladora = new UsuarioControladora();
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $recebe_processo_usuario = $_POST["processo_usuario"];

    if($recebe_processo_usuario === "cadastro_usuario")
    {
        $recebe_nome_usuario_cadastro = $_POST["valor_nome_usuario_cadastro"];
        $recebe_login_usuario_cadastro = $_POST["valor_login_usuario_cadastro"];
        $recebe_senha_usuario_cadastro = $_POST["valor_senha_usuario_cadastro"];
        $recebe_email_usuario_cadastro = $_POST["valor_email_usuario_cadastro"];
        $recebe_perfil_usuario_cadastro = $_POST["valor_perfil_usuario_cadastro"];

        $recebe_senha_usuario_criptografada = md5($recebe_senha_usuario_cadastro);

        $resultado_cadastro_usuario = $usuario_controladora->cadastra_usuario($recebe_nome_usuario_cadastro,$recebe_login_usuario_cadastro,
        $recebe_senha_usuario_criptografada,$recebe_email_usuario_cadastro,$recebe_perfil_usuario_cadastro);
        echo json_encode($resultado_cadastro_usuario);
    }else if($recebe_processo_usuario === "deslogar")
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        
        session_unset();
        session_destroy();
        echo json_encode("deslogado");
    }
}else if($_SERVER["REQUEST_METHOD"] === "GET")
{
    $recebe_processo_usuario = $_GET["processo_usuario"];

    if($recebe_processo_usuario === "autentica_usuario")
    {
        $recebe_login_usuario_autenticacao = $_GET["valor_login_usuario_autenticacao"];

        $recebe_senha_usuario_autenticacao = $_GET["valor_senha_usuario_autenticacao"];

        $recebe_senha_usuario_criptografada = md5($recebe_senha_usuario_autenticacao);

        $resultado_autenticacao_usuario = $usuario_controladora->autentica_usuario($recebe_login_usuario_autenticacao,$recebe_senha_usuario_criptografada);
        echo json_encode($resultado_autenticacao_usuario);
    }else if($recebe_processo_usuario === "buscar_usuarios")
    {
        $resultado_buscar_usuarios = $usuario_controladora->busca_usuarios();
        echo json_encode($resultado_buscar_usuarios);
    }
}