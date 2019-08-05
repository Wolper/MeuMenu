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
        if (isset($post['user_email']) && !empty($post['user_email'])) {
            $dados['user_name'] = addslashes($post['user_name']);
            $dados['user_lastname'] = addslashes($post['user_lastname']);
            $dados['user_email'] = addslashes($post['user_email']);
            $dados['user_password'] = addslashes(md5($post['user_password']));

            $u = new Usuario();
            $result = $u->adicionar($dados);
            if ($result[2]) {
                //redireciona para o perfil do usuário
                header("Location:../logado");
            } else {
                /*retorna ao formulário de cadastro
                emitindo msg de duplicidade de e-mail*/
                header("Location:../cadastroUser?msg=$result[0]");
            }
        }
    }

}
