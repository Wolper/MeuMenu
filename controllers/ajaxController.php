<?php

class ajaxController extends Controller implements interfaceController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $this->loadView('ajax', $dados);
    }

    public function loadEstados() {
        $r = new Restaurante();
        echo json_encode($r->getEstados());
    }

    public function loadCidades() {
        $r = new Restaurante();
        echo json_encode($r->getCidades());
    }

    public function loadCategorias() {
        $m = new Menu();
        echo json_encode($m->getCategories());
    }

    public function loadMenu() {
        $m = new Menu();
        echo json_encode($m->get());
    }

    public function validaEmailGoogle() {
        $email = filter_input(INPUT_POST, 'userEmail', FILTER_SANITIZE_EMAIL);
        $u = new Usuario();
        $user_id = $u->emailExists($email);
        if ($user_id) {
            Session::setValue('user_id', $user_id);
           return true;
        } else {
            echo json_encode("false");
        }
    }

}
