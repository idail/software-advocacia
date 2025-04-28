<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-5">
        <div class="card">
            <h4>Cadastro Pagamento</h4>
            <div class="card-body">
                <h4 class="card-subtitle"><b style="color: black;">Cliente</b></h4>
                <form class="mt-4">
                    <div class="form-group">
                        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" style="background-color: #eae6e6;" id="cliente-pagamento">
                        </select>
                    </div>
                </form>

                <h4 class="card-subtitle"><b style="color: black;">Status Pagamento</b></h4>
                <form class="mt-4">
                    <div class="form-group">
                        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" style="background-color: #eae6e6;" id="status-pagamento">
                            <option selected>Selecione</option>
                            <option value="pendente">Pendente</option>
                            <option value="pago">Pago</option>
                            <option value="vencido">Vencido</option>
                        </select>
                    </div>
                </form>

                <h4 class="card-subtitle mt-3"><b style="color: black;">Data Vencimento Pagamento</b></h4>
                <form class="mt-4">
                    <div class="form-group">
                        <input type="date" class="form-control" id="data-vencimento-pagamento" style="background-color: #eae6e6;">
                    </div>
                </form>

                <h4 class="card-subtitle mt-3"><b style="color: black;">Serviço Realizado</b></h4>
                <form class="mt-3">
                    <div class="form-group">
                        <textarea class="form-control" rows="3" cols="4" style="background-color: #eae6e6;" id="servico-realizado-cliente"></textarea>
                    </div>
                </form>


                <button type="button"
                    class="btn waves-effect waves-light btn-primary mt-4" id="gravar-pagamento">Gravar</button>

                <button type="button"
                    class="btn waves-effect waves-light btn-secondary mt-4">Limpar</button>

                <div class="alert alert-warning bg-warning text-white border-0 mt-3" role="alert" id="mensagem-campos-vazio-cadastro-pagamento">
                    <span id="corpo-mensagem-campos-vazio-cadastro-pagamento"></span>
                </div>

                <div class="alert alert-danger mt-3" role="alert" id="mensagem-falha-cadastro-pagamento">
                    <span id="corpo-mensagem-falha-cadastro-pagamento"></span>
                </div>

                <div class="alert alert-danger mt-3" role="alert" id="mensagem-falha-buscar-clientes">
                    <span id="corpo-mensagem-falha-buscar-clientes"></span>
                </div>

                <div class="alert alert-success mt-3" role="alert" id="mensagem-cadastro-pagamento-sucesso">
                    <span id="corpo-mensagem-cadastro-pagamento-sucesso"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./assets/libs/jquery/dist/jquery.min.js "></script>
<!-- <script src="./assets/libs/popper.js/dist/umd/popper.min.js "></script> -->
<!-- <script src="./assets/libs/bootstrap/dist/js/bootstrap.min.js "></script> -->


<script>
    $(document).ready(function(e) {
        $("#mensagem-campos-vazio-cadastro-pagamento").hide();
        $("#mensagem-falha-cadastro-pagamento").hide();
        $("#mensagem-cadastro-pagamento-sucesso").hide();
        $("#mensagem-falha-buscar-clientes").hide();

        $.ajax({
            url: 'http://localhost/software-advocacia/API/ClienteAPI.php', // coloque aqui a URL da sua API
            method: 'GET',
            dataType: 'json',
            data: {
                processo_cliente: "buscar_clientes"
            },
            success: function(resposta) {
                debugger;

                let select_clientes = $("#cliente-pagamento");
                select_clientes.empty();

                select_clientes.append('<option value="">Selecione um cliente</option>');

                for (var i = 0; i < resposta.length; i++) {
                    let item = resposta[i];
                    select_clientes.append('<option value="' + item.codigo_cliente + '">' + item.nome_cliente + '</option>');
                }
            },
            error: function(xhr, status, error) {
                $("#corpo-mensagem-falha-buscar-clientes").html("Falha ao buscar clientes:" + error);
                $("#mensagem-falha-buscar-clientes").show();
                $("#mensagem-falha-buscar-clientes").fadeOut(4000);
            },
        });


    });

    $("#gravar-pagamento").click(function(e) {
        e.preventDefault();

        debugger;

        let recebe_codigo_pagamento_cadastro = $("#cliente-pagamento").val();

        let recebe_status_pagamento_cadastro = $("#status-pagamento").val();

        let recebe_data_vencimento_pagamento_cadastro = $("#data-vencimento-pagamento").val();

        let recebe_servico_realizado_pagamento_cadastro = $("#servico-realizado-cliente").val();


        if (recebe_codigo_pagamento_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-pagamento").html("Favor selecionar o cliente desejado");
            $("#mensagem-campos-vazio-cadastro-pagamento").show();
            $("#mensagem-campos-vazio-cadastro-pagamento").fadeOut(4000);
        } else if (recebe_status_pagamento_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-pagamento").html("Favor selecionar o status do pagamento");
            $("#mensagem-campos-vazio-cadastro-pagamento").show();
            $("#mensagem-campos-vazio-cadastro-pagamento").fadeOut(4000);
        } else if (recebe_data_vencimento_pagamento_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-pagamento").html("Favor selecionar a data do vencimento do pagamento");
            $("#mensagem-campos-vazio-cadastro-pagamento").show();
            $("#mensagem-campos-vazio-cadastro-pagamento").fadeOut(4000);
        } else if (recebe_servico_realizado_pagamento_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-pagamento").html("Favor preencher o serviço realizado ao cliente");
            $("#mensagem-campos-vazio-cadastro-pagamento").show();
            $("#mensagem-campos-vazio-cadastro-pagamento").fadeOut(4000);
        } else {
            $.ajax({
                url: "http://localhost/software-advocacia/API/PagamentoAPI.php",
                type: "POST",
                dataType: "json",
                data: {
                    valor_status_pagamento_cadastro: recebe_status_pagamento_cadastro,
                    valor_data_vencimento_pagamento_cadastro: recebe_data_vencimento_pagamento_cadastro,
                    valor_servico_realizado_pagamento_cadastro: recebe_servico_realizado_pagamento_cadastro,
                    valor_codigo_cliente_pagamento_cadastro: recebe_codigo_pagamento_cadastro,
                    processo_pagamento: "cadastro_pagamento"
                },
                success: function(retorno) {
                    debugger;
                    console.log(retorno);
                    if (retorno > 0) {
                        $("#corpo-mensagem-cadastro-pagamento-sucesso").html("Pagamento cadastrado com sucesso");
                        $("#mensagem-cadastro-pagamento-sucesso").show();
                        $("#mensagem-cadastro-pagamento-sucesso").fadeOut(4000);
                    }
                },
                error: function(xhr, status, error) {
                    $("#corpo-mensagem-falha-cadastro-pagamento").html("Falha ao cadastrar pagamento:" + error);
                    $("#mensagem-falha-cadastro-pagamento").show();
                    $("#mensagem-falha-cadastro-pagamento").fadeOut(4000);
                },
            });
        }
    });
</script>