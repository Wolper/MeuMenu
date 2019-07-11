<?php

class cadastroRestauranteController extends Controller implements interfaceController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $this->loadTemplate('cadastroRestaurante', $dados);
    }

}
