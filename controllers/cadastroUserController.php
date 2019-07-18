<?php

class cadastroUserController extends Controller implements interfaceController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $this->loadTemplate('cadastroUser', $dados);
    }

    public function addUser() {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $dados = array();
        if (isset($post['email']) && !empty($post['email'])) {
            $dados['email'] = addslashes($post['email']);
            $dados['password'] = addslashes(md5($post['password']));

            $u = new Usuario();
            if ($u->adicionar($dados)) {
                //redireciona para o perfil do usuário
                header("Location:../logado");
            } else {
                /*redireciona para o formulário de cadastro
                emitindo msg de duplicidade de e-mail*/
                header("Location:../cadastroUser?addUser=false");
            }
        }
    }

}
