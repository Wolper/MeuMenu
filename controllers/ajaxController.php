<?php

class ajaxController extends Controller implements interfaceController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $this->loadView('ajax', $dados);
    }

    public function addUser() {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $dados = array();
        if (isset($post['email']) && !empty($post['email'])) {
            $dados['email'] = addslashes($post['email']);
            $dados['password'] = addslashes(md5($post['password']));

            $u = new Usuario();
            if ($u->adicionar($dados)) {
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    public function addRestaurante() {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($post['cpf']) && !empty($post['cpf'])) {
            $data = array();
            $data['nome'] = addslashes($post['nome']);
            $data['cpf'] = addslashes($post['cpf']);
            $data['telefone'] = addslashes($post['telefone']);
            $data['user_id'] = addslashes(Session::getValue('user_id'));
            $data['razao_social'] = addslashes($post['razaoSocial']);
            $data['nome_fantasia'] = addslashes($post['nomeFantasia']);
            $data['cnpj'] = addslashes($post['cnpjEmpresa']);
            $data['tel_emp'] = addslashes($post['telEmpresa']);
            $data['logradouro'] = addslashes($post['logEmpresa']);
            $data['numero'] = addslashes($post['numEmpresa']);
            $data['bairro'] = addslashes($post['bairroEmpresa']);
            $data['cidade'] = addslashes($post['cidadeEmpresa']);
            $data['uf'] = addslashes($post['ufEmpresa']);

            $u = new Restaurante;
            if ($u->adicionar($data)) {
                echo 'true';
            } else {
                echo 'false';
            }
        }
    }

    public function loginUser() {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($post['email']) && !empty($post['email'])) {
            $u = new Usuario();
            //Se tiver usuário cadastrado, sistema direciona o usuário para seu perfil,
            //caso contrário, redireciona para a página de login
            if ($u->login($post) == FALSE) {
                echo 'false';
            } else {
                //retorna da o Id do usuário para ser inserido na sessão e direciona para o perfil do usuário
                Session::setValue('user_id', $u->login($post));
                echo 'true';
            }
        }
    }

    public function loadEstados() {
        $r = new Restaurante();
        echo json_encode($r->getEstados());
    }

    public function loadCidades() {
        $r = new Restaurante();
        echo json_encode($r->getCidades());
    }

}
