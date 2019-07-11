<?php
/**
 * Classe encarregada de criar sessão para as páginas
 * setar e pegar valores e ao final destruir a sessão
 *
 * @author dikson
 */
class Session {

    public function __construct() {
        if (!session_id()) {
            session_start();
        }
    }
    
    //insere valores na Sessão
    public static function setValue($var, $value) {
        $_SESSION[$var] = $value;
    }

    //pega valores na Sessão
    public static function getValue($var) {
        if (isset($_SESSION[$var])) {
            return $_SESSION[$var];
        }
    }
        
    public static function freeSession(){
        $_SESSION = array();
        session_destroy();
    }
}
