<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-5">
        <div class="card">
            <h4>Cadastro Cliente</h4>
            <div class="card-body">
                <h4 class="card-subtitle"><b style="color: black;">Nome Cliente</b></h4>
                <form class="mt-4">
                    <div class="form-group">
                        <input type="text" class="form-control" style="background-color: #eae6e6;" id="nome-cliente" placeholder="Informe o nome do cliente">
                    </div>
                </form>

                <h4 class="card-subtitle mt-3"><b style="color: black;">Telefone Cliente</b></h4>
                <form class="mt-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="telefone-cliente" style="background-color: #eae6e6;" placeholder="Informe o telefone do cliente">
                    </div>
                </form>

                <h4 class="card-subtitle mt-3"><b style="color: black;">Endereço Cliente</b></h4>
                <form class="mt-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="endereco-cliente" style="background-color: #eae6e6;" placeholder="Informe o endereço do cliente">
                    </div>
                </form>

                <h4 class="card-subtitle mt-3"><b style="color: black;">Email Cliente</b></h4>
                <form class="mt-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="email-cliente" style="background-color: #eae6e6;" placeholder="Informe o e-mail do cliente">
                    </div>
                </form>


                <button type="button"
                    class="btn waves-effect waves-light btn-primary mt-4" id="gravar-cliente">Gravar</button>

                <button type="button"
                    class="btn waves-effect waves-light btn-secondary mt-4">Limpar</button>

                <div class="alert alert-warning bg-warning text-white border-0 mt-3" role="alert" id="mensagem-campos-vazio-cadastro-cliente">
                    <span id="corpo-mensagem-campos-vazio-cadastro-cliente"></span>
                </div>

                <div class="alert alert-danger mt-3" role="alert" id="mensagem-falha-cadastro-cliente">
                    <span id="corpo-mensagem-falha-cadastro-cliente"></span>
                </div>

                <div class="alert alert-success mt-3" role="alert" id="mensagem-cadastro-cliente-sucesso">
                    <span id="corpo-mensagem-cadastro-cliente-sucesso"></span>
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
        $("#mensagem-campos-vazio-cadastro-cliente").hide();
        $("#mensagem-falha-cadastro-cliente").hide();
        $("#mensagem-cadastro-cliente-sucesso").hide();
    });

    $("#gravar-cliente").click(function(e) {
        e.preventDefault();

        debugger;

        let recebe_nome_cliente_cadastro = $("#nome-cliente").val();

        let recebe_telefone_cliente_cadastro = $("#telefone-cliente").val();

        let recebe_endereco_cliente_cadastro = $("#endereco-cliente").val();

        let recebe_email_cliente_cadastro = $("#email-cliente").val();

        if (recebe_nome_cliente_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-cliente").html("Favor preencher o nome do cliente");
            $("#mensagem-campos-vazio-cadastro-cliente").show();
            $("#mensagem-campos-vazio-cadastro-cliente").fadeOut(4000);
        } else if (recebe_telefone_cliente_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-cliente").html("Favor preencher o telefone do cliente");
            $("#mensagem-campos-vazio-cadastro-cliente").show();
            $("#mensagem-campos-vazio-cadastro-cliente").fadeOut(4000);
        } else if (recebe_endereco_cliente_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-cliente").html("Favor preencher o endereço do cliente");
            $("#mensagem-campos-vazio-cadastro-cliente").show();
            $("#mensagem-campos-vazio-cadastro-cliente").fadeOut(4000);
        } else if (recebe_email_cliente_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-cliente").html("Favor preencher o e-mail do cliente");
            $("#mensagem-campos-vazio-cadastro-cliente").show();
            $("#mensagem-campos-vazio-cadastro-cliente").fadeOut(4000);
        }  else {
            $.ajax({
                url: "http://localhost/software-advocacia/API/ClienteAPI.php",
                type: "POST",
                dataType: "json",
                data: {
                    valor_nome_cliente_cadastro: recebe_nome_cliente_cadastro,
                    valor_telefone_cliente_cadastro: recebe_telefone_cliente_cadastro,
                    valor_endereco_cliente_cadastro: recebe_endereco_cliente_cadastro,
                    valor_email_cliente_cadastro: recebe_email_cliente_cadastro,
                    processo_cliente: "cadastro_cliente"
                },
                success: function(retorno) {
                    debugger;
                    console.log(retorno);
                    if (retorno > 0) {
                        $("#corpo-mensagem-cadastro-cliente-sucesso").html("Cliente cadastrado com sucesso");
                        $("#mensagem-cadastro-cliente-sucesso").show();
                        $("#mensagem-cadastro-cliente-sucesso").fadeOut(4000);
                    }
                },
                error: function(xhr, status, error) {
                    $("#corpo-mensagem-falha-cadastro-cliente").html("Falha ao cadastrar cliente:" + error);
                    $("#mensagem-falha-cadastro-cliente").show();
                    $("#mensagem-falha-cadastro-cliente").fadeOut(4000);
                },
            });
        }
    });
</script>