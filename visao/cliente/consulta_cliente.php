<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-12">
        <div class="card">
            <div class="table-responsive">
                <h4 class="card-subtitle mt-3"><b style="color: black;">Clientes</b></h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">E-mail</th>
                        </tr>
                    </thead>
                    <tbody id="registro-cliente">
                    </tbody>
                </table>
            </div>
            <div class="alert alert-danger" role="alert" id="mensagem-falha-busca-cliente">
                <span id="corpo-mensagem-falha-busca-cliente"></span>
            </div>
        </div>
    </div>
</div>

<script src="./assets/libs/jquery/dist/jquery.min.js "></script>

<script>
    $(document).ready(function(e) {
        $("#mensagem-falha-busca-cliente").hide();
        carrega_clientes();
    });

    function carrega_clientes() {
        debugger;

        $.ajax({
            url: "http://localhost/software-advocacia/API/ClienteAPI.php",
            type: "get",
            dataType: "json",
            data: {
                processo_cliente: "buscar_clientes",
            },
            success: function(retorno) {
                debugger;
                let recebe_tabela_cliente = document.querySelector(
                    "#registro-cliente"
                );

                $("#registro-cliente").html("");

                if (retorno.length > 0) {
                    for (let indice = 0; indice < retorno.length; indice++) {
                        recebe_tabela_cliente.innerHTML +=
                            "<tr>" +
                            "<td>" + retorno[indice].nome_cliente + "</td>" +
                            "<td>" + retorno[indice].telefone_cliente + "</td>" +
                            "<td>" + retorno[indice].endereco_cliente + "</td>" +
                            "<td>" + retorno[indice].email_cliente + "</td>" +
                            "</tr>";
                    }
                    $("#registro-cliente").append(recebe_tabela_cliente);
                } else {
                    $("#registro-cliente").html("");
                    $("#registro-cliente").append("<td colspan='4' class='text-center'>Nenhum registro localizado</td>");
                }
            },
            error: function(xhr, status, error) 
            {
                $("#corpo-mensagem-falha-busca-cliente").html("Falha ao buscar clientes:" + error);
                $("#mensagem-falha-busca-cliente").show();
                $("#mensagem-falha-busca-cliente").fadeOut(4000);
            },
        });
    }
</script>