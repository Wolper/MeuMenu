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

}
