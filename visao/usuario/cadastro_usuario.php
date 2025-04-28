<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-5">
        <div class="card">
            <h4>Cadastro Usuário</h4>
            <div class="card-body">
                <h4 class="card-subtitle"><b style="color: black;">Nome Usuário</b></h4>
                <form class="mt-4">
                    <div class="form-group">
                        <input type="text" class="form-control" style="background-color: #eae6e6;" id="nome-usuario" placeholder="Informe o nome do usuário">
                    </div>
                </form>

                <h4 class="card-subtitle mt-3"><b style="color: black;">Login Usuário</b></h4>
                <form class="mt-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="login-usuario" style="background-color: #eae6e6;" placeholder="Informe o login do usuário">
                    </div>
                </form>

                <h4 class="card-subtitle mt-3"><b style="color: black;">Senha Usuário</b></h4>
                <form class="mt-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="senha-usuario" style="background-color: #eae6e6;" placeholder="Informe a senha do usuário">
                    </div>
                </form>

                <h4 class="card-subtitle mt-3"><b style="color: black;">Email Usuário</b></h4>
                <form class="mt-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="email-usuario" style="background-color: #eae6e6;" placeholder="Informe o e-mail do usuário">
                    </div>
                </form>

                <button type="button"
                    class="btn waves-effect waves-light btn-primary mt-4" id="gravar-usuario">Gravar</button>

                <button type="button"
                    class="btn waves-effect waves-light btn-secondary mt-4">Limpar</button>

                <div class="alert alert-warning bg-warning text-white border-0 mt-3" role="alert" id="mensagem-campos-vazio-cadastro-usuario">
                    <span id="corpo-mensagem-campos-vazio-cadastro-usuario"></span>
                </div>

                <div class="alert alert-danger" role="alert" id="mensagem-falha-cadastro-usuario">
                    <span id="corpo-mensagem-falha-cadastro-usuario"></span>
                </div>

                <div class="alert alert-success" role="alert" id="mensagem-cadastro-usuario-sucesso">
                    <span id="corpo-mensagem-cadastro-usuario-sucesso"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="./assets/libs/jquery/dist/jquery.min.js "></script>
<!-- <script src="./assets/libs/popper.js/dist/umd/popper.min.js "></script> -->
<!-- <script src="./assets/libs/bootstrap/dist/js/bootstrap.min.js "></script> -->


<script>
    $(document).ready(function(e){
        $("#mensagem-campos-vazio-cadastro-usuario").hide();
        $("#mensagem-falha-cadastro-usuario").hide();
        $("#mensagem-cadastro-usuario-sucesso").hide();
    });

    $("#gravar-usuario").click(function(e) {
        e.preventDefault();

        debugger;

        let recebe_nome_usuario_cadastro = $("#nome-usuario").val();

        let recebe_login_usuario_cadastro = $("#login-usuario").val();

        let recebe_senha_usuario_cadastro = $("#senha-usuario").val();

        let recebe_email_usuario_cadastro = $("#email-usuario").val();

        if (recebe_nome_usuario_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-usuario").html("Favor preencher o nome do usuário");
            $("#mensagem-campos-vazio-cadastro-usuario").show();
            $("#mensagem-campos-vazio-cadastro-usuario").fadeOut(4000);
        } else if (recebe_login_usuario_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-usuario").html("Favor preencher o login do usuário");
            $("#mensagem-campos-vazio-cadastro-usuario").show();
            $("#mensagem-campos-vazio-cadastro-usuario").fadeOut(4000);
        } else if (recebe_senha_usuario_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-usuario").html("Favor preencher a senha do usuário");
            $("#mensagem-campos-vazio-cadastro-usuario").show();
            $("#mensagem-campos-vazio-cadastro-usuario").fadeOut(4000);
        } else if (recebe_email_usuario_cadastro === "") {
            $("#corpo-mensagem-campos-vazio-cadastro-usuario").html("Favor preencher a senha do usuário");
            $("#mensagem-campos-vazio-cadastro-usuario").show();
            $("#mensagem-campos-vazio-cadastro-usuario").fadeOut(4000);
        } else {
            $.ajax({
                url: "http://localhost/software-advocacia/API/UsuarioAPI.php",
                type: "POST",
                dataType: "json",
                data: {
                    valor_nome_usuario_cadastro: recebe_nome_usuario_cadastro,
                    valor_login_usuario_cadastro: recebe_login_usuario_cadastro,
                    valor_senha_usuario_cadastro:recebe_senha_usuario_cadastro,
                    valor_email_usuario_cadastro:recebe_email_usuario_cadastro,
                    valor_perfil_usuario_cadastro:"administrador",
                    processo_usuario: "cadastro_usuario"
                },
                success: function(retorno) {
                    debugger;
                    console.log(retorno);
                    if(retorno > 0)
                    {
                        $("#corpo-mensagem-cadastro-usuario-sucesso").html("Usuário cadastrado com sucesso");
                        $("#mensagem-cadastro-usuario-sucesso").show();
                        $("#mensagem-cadastro-usuario-sucesso").fadeOut(4000);
                    }   
                },
                error: function(xhr, status, error) 
                {
                    $("#corpo-mensagem-falha-cadastro-usuario").html("Falha ao cadastrar usuário:" + error);
                    $("#mensagem-falha-cadastro-usuario").show();
                    $("#mensagem-falha-cadastro-usuario").fadeOut(4000);
                },
            });
        }
    });
</script>