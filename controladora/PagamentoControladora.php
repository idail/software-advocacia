<?php
require("../modelo/Pagamento.php");
class PagamentoControladora{
    private $pagamento;

    public function __construct()
    {
        $this->pagamento = new Pagamento();
    }

    public function cadastro_pagamento($recebe_status_pagamento,$recebe_data_vencimento_pagamento,$recebe_servico_realizado_pagamento,
    $recebe_codigo_cliente_pagamento)
    {
        $this->pagamento->setStatus_Pagamento($recebe_status_pagamento);
        $this->pagamento->setData_Vencimento_Pagamento($recebe_data_vencimento_pagamento);
        $this->pagamento->setServico_Realizado_Pagamento($recebe_servico_realizado_pagamento);
        $this->pagamento->setCodigo_Cliente_Pagamento($recebe_codigo_cliente_pagamento);
        return $this->pagamento->cadastro_pagamento();
    }

    public function buscar_pagamentos()
    {
        return $this->pagamento->buscar_pagamentos();
    }

    public function buscar_pagamentos_vencidos()
    {
        return $this->pagamento->buscar_pagamentos_vencidos();
    }
}
?>