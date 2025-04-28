<?php
require("Conexao.php");
class Pagamento{
    private $codigo_pagamento;
    private $status_pagamento;
    private $data_vencimento_pagamento;
    private $servico_realizado_pagamento;
    private $codigo_cliente_pagamento;

    public function setCodigo_Pagamento($codigo_pagamento)
    {
        $this->codigo_pagamento = $codigo_pagamento;
    }

    public function getCodigo_Pagamento()
    {
        return $this->codigo_pagamento;
    }

    public function setStatus_Pagamento($status_pagamento)
    {
        $this->status_pagamento = $status_pagamento;
    }

    public function getStatus_Pagamento()
    {
        return $this->status_pagamento;
    }

    public function setData_Vencimento_Pagamento($data_vencimento_pagamento)
    {
        $this->data_vencimento_pagamento = $data_vencimento_pagamento;
    }

    public function getData_Vencimento_Pagamento()
    {
        return $this->data_vencimento_pagamento;
    }

    public function setServico_Realizado_Pagamento($servico_realizado_pagamento)
    {
        $this->servico_realizado_pagamento = $servico_realizado_pagamento;
    }

    public function getServico_Realizado_Pagamento()
    {
        return $this->servico_realizado_pagamento;
    }

    public function setCodigo_Cliente_Pagamento($codigo_cliente_pagamento)
    {
        $this->codigo_cliente_pagamento = $codigo_cliente_pagamento;
    }

    public function getCodigo_Cliente_Pagamento()
    {
        return $this->codigo_cliente_pagamento;
    }

    public function cadastro_pagamento()
    {
        try{
            $instrucao_cadastro_pagamento = "insert into pagamento(status_pagamento,data_vencimento_pagamento,servico_realizado_pagamento
            ,codigo_cliente_pagamento)values(:recebe_status_pagamento,:recebe_data_vencimento_pagamento,:recebe_servico_realizado_pagamento,
            :recebe_codigo_cliente_pagamento)";
            $comando_cadastro_pagamento = Conexao::Obtem()->prepare($instrucao_cadastro_pagamento);
            $comando_cadastro_pagamento->bindValue(":recebe_status_pagamento",$this->getStatus_Pagamento());
            $comando_cadastro_pagamento->bindValue(":recebe_data_vencimento_pagamento",$this->getData_Vencimento_Pagamento());
            $comando_cadastro_pagamento->bindValue(":recebe_servico_realizado_pagamento",$this->getServico_Realizado_Pagamento());
            $comando_cadastro_pagamento->bindValue(":recebe_codigo_cliente_pagamento",$this->getCodigo_Cliente_Pagamento());
            $comando_cadastro_pagamento->execute();
            $recebe_ultimo_codigo_registrado_pagamento = Conexao::Obtem()->lastInsertId();
            return $recebe_ultimo_codigo_registrado_pagamento;
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

    public function buscar_pagamentos()
    {
        $registros_pagamentos = array();
        try{
            $instrucao_busca_pagamentos = "SELECT 
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
            $registros_pagamentos = $comando_busca_pagamentos->fetchAll(PDO::FETCH_ASSOC);
            return $registros_pagamentos;
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

    public function buscar_pagamentos_vencidos()
    {
        $registros_pagamentos_vencidos = array();

        try{
            $instrucao_busca_pagamentos_vencidos = 
            "SELECT 
            p.codigo_pagamento,
            p.data_vencimento_pagamento,
            p.servico_realizado_pagamento,
            p.codigo_cliente_pagamento,
            c.nome_cliente
            FROM pagamento p
            JOIN cliente c ON p.codigo_cliente_pagamento = c.codigo_cliente
            WHERE 
            p.status_pagamento != 'pago'
            AND p.data_vencimento_pagamento <= CURDATE();";
            $comando_busca_pagamentos_vencidos = Conexao::Obtem()->prepare($instrucao_busca_pagamentos_vencidos);
            $comando_busca_pagamentos_vencidos->execute();
            $registros_pagamentos_vencidos = $comando_busca_pagamentos_vencidos->fetchAll(PDO::FETCH_ASSOC);
            return $registros_pagamentos_vencidos;
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