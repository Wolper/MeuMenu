<?php

class notfoundController extends Controller implements interfaceController {

    public function index() {
        $this->loadView('404', array());
    }

}
