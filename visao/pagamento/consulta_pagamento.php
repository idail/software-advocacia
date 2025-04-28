<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-12">
        <div class="card">
            <div class="table-responsive">
                <h4 class="card-subtitle mt-3"><b style="color: black;">Pagamentos</b></h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome Cliente</th>
                            <th scope="col">Data Vencimento Pagamento</th>
                            <th scope="col">Serviço Realizado</th>
                            <th scope="col">Situação</th>
                        </tr>
                    </thead>
                    <tbody id="registro-pagamento">
                    </tbody>
                </table>
                
                <a href="pagamento/gera_relatorio_pagamento.php" target="_blank" class="btn waves-effect waves-light btn-primary mt-4">Relátorio</a>

                <!-- <button type="button"
                    class="btn waves-effect waves-light btn-primary mt-4" id="gerar-relatorio-pagamentos">Relátorio</button> -->
            </div>
            <div class="alert alert-danger" role="alert" id="mensagem-falha-busca-pagamento">
                <span id="corpo-mensagem-falha-busca-pagamento"></span>
            </div>
        </div>
    </div>
</div>

<script src="./assets/libs/jquery/dist/jquery.min.js "></script>

<script>
    $(document).ready(function(e) {
        $("#mensagem-falha-busca-pagamento").hide();
        carrega_pagamentos();
    });

    function carrega_pagamentos() {
        debugger;

        $.ajax({
            url: "http://localhost/software-advocacia/API/PagamentoAPI.php",
            type: "get",
            dataType: "json",
            data: {
                processo_pagamento: "buscar_pagamentos",
            },
            success: function(retorno) {
                debugger;
                let recebe_tabela_pagamento = document.querySelector(
                    "#registro-pagamento"
                );

                $("#registro-pagamento").html("");

                if (retorno.length > 0) {
                    for (let indice = 0; indice < retorno.length; indice++) {
                        let objeto_data = new Date(retorno[indice].data_vencimento_pagamento);
                        let data_formatada_brasileiro = objeto_data.toLocaleDateString('pt-BR');
                        recebe_tabela_pagamento.innerHTML +=
                            "<tr>" +
                            "<td>" + retorno[indice].nome_cliente + "</td>" +
                            "<td>" + data_formatada_brasileiro + "</td>" +
                            "<td>" + retorno[indice].servico_realizado_pagamento + "</td>" +
                            "<td>" + retorno[indice].status_real + "</td>" +
                            "</tr>";
                    }
                    $("#registro-pagamento").append(recebe_tabela_pagamento);
                } else {
                    $("#registro-pagamento").html("");
                    $("#registro-pagamento").append("<td colspan='4' class='text-center'>Nenhum registro localizado</td>");
                }
            },
            error: function(xhr, status, error) {
                $("#corpo-mensagem-falha-busca-pagamento").html("Falha ao buscar pagamentos:" + error);
                $("#mensagem-falha-busca-pagamento").show();
                $("#mensagem-falha-busca-pagamento").fadeOut(4000);
            },
        });
    }
</script>