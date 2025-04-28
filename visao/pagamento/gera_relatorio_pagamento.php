<?php
require("../../vendor/autoload.php");
require("../../modelo/Conexao.php");

use Dompdf\Dompdf;
use Dompdf\Options;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: POST, GET");

try {
    $instrucao_busca_pagamentos = "
            SELECT 
                p.codigo_pagamento,
                p.data_vencimento_pagamento,
                p.servico_realizado_pagamento,
                p.codigo_cliente_pagamento,
                c.nome_cliente,
                CASE
                    WHEN p.status_pagamento = 'pago' THEN 'pago'
                    WHEN CURDATE() > p.data_vencimento_pagamento THEN 'vencido'
                    ELSE 'pendente'
                END AS status_real
            FROM pagamento p
            JOIN cliente c ON p.codigo_cliente_pagamento = c.codigo_cliente;
            ";

    $comando_busca_pagamentos = Conexao::Obtem()->prepare($instrucao_busca_pagamentos);
    $comando_busca_pagamentos->execute();
    $valores = $comando_busca_pagamentos->fetchAll(PDO::FETCH_ASSOC);

    $dados = "<!DOCTYPE html>";
    $dados .= "<html lang='pt-br'>";
    $dados .= "<head>";
    $dados .= "<meta charset='UTF-8'>";
    $dados .= "
    <style>
         body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            color: #333;
            margin: 20px 0;
        }
        .table-container {
            width: 100%;
            margin: 20px 0;
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        th {
            background-color:rgb(76, 101, 175);
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:nth-child(odd) {
            background-color: #fafafa;
        }
        .status-pago {
            color: #4CAF50;
            font-weight: bold;
        }
        .status-vencido {
            color: #f44336;
            font-weight: bold;
        }
        .status-pendente {
            color: #FF9800;
            font-weight: bold;
        }
    </style>";
    $dados .= "<title>Financeiro Advocacia</title>";
    $dados .= "</head>";
    $dados .= "<body>";
    $dados .= "<h1>Relatório de Pagamentos</h1>";
    $dados .= "<div class='table-container'>";
    $dados .= "<table class='table'>";
    $dados .= "<thead>";
    $dados .= "<tr>";
    $dados .= "<th>Data Vencimento</th>";
    $dados .= "<th>Serviço Realizado</th>";
    $dados .= "<th>Nome Cliente</th>";
    $dados .= "<th>Status</th>";
    $dados .= "</tr>";
    $dados .= "</thead>";
    $dados .= "<tbody>";

    // Ler os registros retornados do BD
    foreach ($valores as $vendas) {
        $statusClass = '';
        switch ($vendas['status_real']) {
            case 'pago':
                $statusClass = 'status-pago';
                break;
            case 'vencido':
                $statusClass = 'status-vencido';
                break;
            case 'pendente':
                $statusClass = 'status-pendente';
                break;
        }

        $dados .= "<tr>";
        $dados .= "<td>" . date('d/m/Y', strtotime($vendas['data_vencimento_pagamento'])) . "</td>";
        $dados .= "<td>" . $vendas["servico_realizado_pagamento"] . "</td>";
        $dados .= "<td>" . $vendas["nome_cliente"] . "</td>";
        $dados .= "<td class='$statusClass'>" . $vendas["status_real"] . "</td>";
        $dados .= "</tr>";
    }

    $dados .= "</tbody>";
    $dados .= "</table>";
    $dados .= "</div>";
    $dados .= "<h1>Relatório Completo - Sistema Financeiro Advocacia</h1>";
    $dados .= "</body>";
    $dados .= "</html>";

    $options = new Options();
    $dompdf = new Dompdf(['enable_remote' => true]);

    $options->set('defaultFont', 'Relatório Vendas');

    $dompdf->loadHtml($dados);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    // Chama stream() com nome e o parâmetro correto
    $dompdf->stream('relatorio_financeiro.pdf', ['Attachment' => false]); // Exibe no navegador sem forçar o download
} catch (PDOException $exception) {
    echo $exception->getMessage();
} catch (Exception $excecao) {
    echo $excecao->getMessage();
} finally {
    Conexao::$conexao = null;
}
?>