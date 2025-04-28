<?php

require("../controladora/PagamentoControladora.php");

header('Access-Control-Allow-Origin: *');

header("Access-Control-Allow-Methods: POST , GET");

$pagamento_controladora = new PagamentoControladora();
if($_SERVER["REQUEST_METHOD"] === "POST")
{
    $recebe_processo_pagamento = $_POST["processo_pagamento"];

    if($recebe_processo_pagamento === "cadastro_pagamento")
    {
        $recebe_status_pagamento_cadastro = $_POST["valor_status_pagamento_cadastro"];
        $recebe_data_vencimento_pagamento_cadastro = $_POST["valor_data_vencimento_pagamento_cadastro"];
        $recebe_servico_realizado_pagamento_cadastro = $_POST["valor_servico_realizado_pagamento_cadastro"];
        $recebe_codigo_cliente_pagamento_cadastro = $_POST["valor_codigo_cliente_pagamento_cadastro"];

        $resultado_cadastro_pgamento = $pagamento_controladora->cadastro_pagamento($recebe_status_pagamento_cadastro,
        $recebe_data_vencimento_pagamento_cadastro,$recebe_servico_realizado_pagamento_cadastro,$recebe_codigo_cliente_pagamento_cadastro);
        echo json_encode($resultado_cadastro_pgamento);
    }
}else if($_SERVER["REQUEST_METHOD"] === "GET")
{
    $recebe_processo_pagamento = $_GET["processo_pagamento"];

    if($recebe_processo_pagamento === "buscar_pagamentos")
    {
        $resultado_buscar_pagamentos = $pagamento_controladora->buscar_pagamentos();
        echo json_encode($resultado_buscar_pagamentos);
    }else if($recebe_processo_pagamento === "buscar_pagamentos_vencidos")
    {
        $resultado_buscar_pagamentos_vencidos = $pagamento_controladora->buscar_pagamentos_vencidos();
        echo json_encode($resultado_buscar_pagamentos_vencidos);
    }
}
?>