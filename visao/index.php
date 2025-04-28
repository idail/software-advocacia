<?php
$url = (isset($_GET['pagina'])) ? $_GET['pagina'] : 'inicio';

$url = array_filter(explode('/', $url));

if (!empty($url[0])) 
{
    if ($url[0] == "inicio" || $url[0] === "cadastro_usuario" || $url[0] === "consulta_usuario" 
    || $url[0] === "cadastro_cliente" || $url[0] === "consulta_cliente" || $url[0] === "cadastro_pagamento" || $url[0] === "consulta_pagamento") 
    {
        require("inicio.php");
    }
}
?>