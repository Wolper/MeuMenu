<?php

class loginController extends Controller implements interfaceController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        $this->loadTemplate('login', $dados);
    }

     public function loginUser() {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($post['user_email']) && !empty($post['user_email'])) {
            $u = new Usuario();
            //Se tiver usuário cadastrado, sistema direciona o usuário para seu perfil,
            //caso contrário, redireciona para a página de login
            if ($u->login($post) == FALSE) {
                header("Location:../login?login=false");
            } else {
                //retorna da o Id do usuário para ser inserido na sessão e direciona para o perfil do usuário
                Session::setValue('user_id', $u->login($post));
                header("Location:../logado");
            }
        }
    }
}
