<?php

class cadastroRestauranteController extends Controller implements interfaceController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $this->loadTemplate('cadastroRestaurante', $dados);
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
                header("Location:../logado");
            } else {
                header("Location:../login?false");
            }
        }
    }

}
