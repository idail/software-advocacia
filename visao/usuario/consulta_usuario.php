<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-12">
        <div class="card">
            <div class="table-responsive">
                <h4 class="card-subtitle mt-3"><b style="color: black;">Usuários</b></h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Login</th>
                            <th scope="col">Email</th>
                            <th scope="col">Perfil</th>
                        </tr>
                    </thead>
                    <tbody id="registro-usuario">
                    </tbody>
                </table>
            </div>
            <div class="alert alert-danger" role="alert" id="mensagem-falha-busca-usuario">
                <span id="corpo-mensagem-falha-busca-usuario"></span>
            </div>
        </div>
    </div>
</div>

<script src="./assets/libs/jquery/dist/jquery.min.js "></script>

<script>
    $(document).ready(function(e) {
        $("#mensagem-falha-busca-usuario").hide();
        carrega_usuarios();
    });

    function carrega_usuarios() {
        debugger;

        $.ajax({
            url: "http://localhost/software-advocacia/API/UsuarioAPI.php",
            type: "get",
            dataType: "json",
            data: {
                processo_usuario: "buscar_usuarios",
            },
            success: function(retorno) {
                debugger;
                let recebe_tabela_usuario = document.querySelector(
                    "#registro-usuario"
                );

                $("#registro-usuario").html("");

                if (retorno.length > 0) {
                    for (let indice = 0; indice < retorno.length; indice++) {
                        recebe_tabela_usuario.innerHTML +=
                            "<tr>" +
                            "<td>" + retorno[indice].nome_usuario + "</td>" +
                            "<td>" + retorno[indice].login_usuario + "</td>" +
                            "<td>" + retorno[indice].email_usuario + "</td>" +
                            "<td>" + retorno[indice].perfil_usuario + "</td>" +
                            "</tr>";
                    }
                    $("#registro-usuario").append(recebe_tabela_usuario);
                } else {
                    $("#registro-usuario").html("");
                    $("#registro-usuario").append("<td colspan='4' class='text-center'>Nenhum registro localizado</td>");
                }
            },
            error: function(xhr, status, error) 
            {
                $("#corpo-mensagem-falha-busca-usuario").html("Falha ao buscar usuários:" + error);
                $("#mensagem-falha-busca-usuario").show();
                $("#mensagem-falha-busca-usuario").fadeOut(4000);
            },
        });
    }
</script>