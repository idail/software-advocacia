<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png"> -->
    <title>Sistema Financeiro Advocacia</title>
    <!-- Custom CSS -->
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
            <div class="auth-box row">
                <!-- <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(../assets/images/big/3.jpg);"> -->
            </div>
            <div class="col-lg-4 col-md-7 bg-white">
                <div class="p-3">
                    <!-- <div class="text-center">
                            <img src="../assets/images/big/icon.png" alt="wrapkit">
                        </div> -->
                    <h2 class="mt-3 text-center">Financeiro Advocacia</h2>
                    <p class="text-center">Informe seus dados para acesso ao sistema</p>
                    <form class="mt-4">
                        <div class="row">
                            <div class="col-lg-16">
                                <div class="form-group mb-3">
                                    <label class="form-label text-dark" for="uname">Usuário</label>
                                    <input class="form-control" id="usuario-autenticacao" type="text"
                                        placeholder="Informe seu usuário">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="form-label text-dark" for="pwd">Senha</label>
                                    <input class="form-control" id="senha-autenticacao" type="text"
                                        placeholder="Informe sua senha">
                                </div>
                            </div>
                            <div class="col-lg-12 text-center">
                                <button type="button" class="btn w-100 btn-dark" id="acessar-sistema">Acessar</button>
                            </div>
                            <!-- <div class="col-lg-12 text-center mt-5">
                                    Don't have an account? <a href="#" class="text-danger">Sign Up</a>
                                </div> -->
                        </div>

                        <div class="alert alert-warning bg-warning text-white border-0 mt-3" role="alert" id="mensagem-campos-vazio-autenticacao-usuario">
                            <span id="corpo-mensagem-campos-vazio-autenticacao-usuario"></span>
                        </div>

                        <div class="alert alert-danger" role="alert" id="mensagem-falha-ao-autenticar-usuario">
                            <span id="corpo-mensagem-falha-ao-autenticar-usuario"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="../assets/libs/jquery/dist/jquery.min.js "></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js "></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js "></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(document).ready(function(e){
            $("#mensagem-campos-vazio-autenticacao-usuario").hide();
            $("#mensagem-falha-ao-autenticar-usuario").hide();
        });

        $(".preloader ").fadeOut();

        $("#acessar-sistema").click(function(e) {
            e.preventDefault();

            debugger;

            let recebe_usuario_autenticacao = $("#usuario-autenticacao").val();

            let recebe_senha_autenticacao = $("#senha-autenticacao").val();

            if (recebe_usuario_autenticacao === "") {
                $("#corpo-mensagem-campos-vazio-autenticacao-usuario").html("Favor preencher o campo usuário");
                $("#mensagem-campos-vazio-autenticacao-usuario").show();
                $("#mensagem-campos-vazio-autenticacao-usuario").fadeOut(4000);
            } else if (recebe_senha_autenticacao === "") {
                $("#corpo-mensagem-campos-vazio-autenticacao-usuario").html("Favor preencher o campo senha");
                $("#mensagem-campos-vazio-autenticacao-usuario").show();
                $("#mensagem-campos-vazio-autenticacao-usuario").fadeOut(4000);
            } else {
                $.ajax({
                    url: "http://localhost/software-advocacia/API/UsuarioAPI.php",
                    type: "GET",
                    dataType: "json",
                    data: {
                        valor_login_usuario_autenticacao: recebe_usuario_autenticacao,
                        valor_senha_usuario_autenticacao: recebe_senha_autenticacao,
                        processo_usuario: "autentica_usuario"
                    },
                    success: function(retorno) {
                        debugger;

                        if (retorno) {
                            var url_inicio = "http://localhost/software-advocacia/visao";
                            $(window.document.location).attr("href", url_inicio);

                        } else {
                            $("#corpo-mensagem-erro-ao-logar").html("Falha ao tentar logar, favor verificar os campos!");
                            $("#mensagem-erro-ao-logar").show();
                            $("#mensagem-erro-ao-logar").fadeOut(4000);
                        }
                    },
                    error: function(xhr, status, error) {
                        $("#corpo-mensagem-falha-ao-autenticar-usuario").html("Falha ao tentar logar:" + error);
                        $("#mensagem-falha-ao-autenticar-usuario").show();
                        $("#mensagem-falha-ao-autenticar-usuario").fadeOut(6000);
                    }
                });
            }
        });
    </script>
</body>

</html>