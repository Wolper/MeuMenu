<?php

class cadastroUserController extends Controller implements interfaceController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $this->loadTemplate('cadastroUsuario', $dados);
    }

    public function createUser() {
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
                //envia e-mail ao usuário cadastrado para validação de e-mail
             
                $data['Assunto'] = 'Validação de e-mail';
                $data['Mensagem'] = '<a href="' . BASE_URL . 'logado.php" >Clique aqui para validar seu e-mail!</a>';
                $data['RemetenteNome'] = $dados['user_name'];
                $data['RemetenteEmail'] = $dados['user_email'];
                $data['DestinoNome'] = 'Sistema MeuMenu';
                $data['DestinoEmail'] = 'diksondelgado@jacresci.com';
                
                $e = new Email();
                $e->Enviar($data);
                
            } else {
                /* retorna ao formulário de cadastro
                  emitindo msg de duplicidade de e-mail */
                header("Location:../cadastroUser?msg=$result[0]");
            }
        }
    }

    public function editUser() {
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
                /* retorna ao formulário de cadastro
                  emitindo msg de duplicidade de e-mail */
                header("Location:../cadastroUser?msg=$result[0]");
            }
        }
    }

    public function setUserInView(int $user_id) {

        $u = new Usuario();
        $dataUser = $u->getUser($user_id);

        $_SESSION['user_name'] = $dataUser[0]['user_name'];
        $_SESSION['user_lastname'] = $dataUser[0]['user_lastname'];
        header("Location:../");
    }

}
