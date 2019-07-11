<?php

class cadastroUserController extends Controller implements interfaceController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $this->loadTemplate('cadastroUser', $dados);
    }

}
