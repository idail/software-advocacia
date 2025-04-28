<?php
require("../modelo/Usuario.php");
class UsuarioControladora{
    private $usuario;

    public function __construct()
    {
        $this->usuario =  new Usuario();
    }

    public function autentica_usuario($recebe_login_usuario,$recebe_senha_usuario)
    {
        $this->usuario->setLogin_Usuario($recebe_login_usuario);
        $this->usuario->setSenha_Usuario($recebe_senha_usuario);
        return $this->usuario->autentica_usuario();
    }

    public function cadastra_usuario($recebe_nome_usuario,$recebe_login_usuario,$recebe_senha_usuario,$recebe_email_usuario,$recebe_perfil_usuario)
    {
        $this->usuario->setNome_Usuario($recebe_nome_usuario);
        $this->usuario->setLogin_Usuario($recebe_login_usuario);
        $this->usuario->setSenha_Usuario($recebe_senha_usuario);
        $this->usuario->setEmail_Usuario($recebe_email_usuario);
        $this->usuario->setPerfil_Usuario($recebe_perfil_usuario);
        return $this->usuario->cadastra_usuario();
    }

    public function busca_usuarios()
    {
        return $this->usuario->busca_usuarios();
    }
}
?>