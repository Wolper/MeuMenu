<?php

class cadastroMenuController extends Controller implements interfaceController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();

        $this->loadTemplate('cadastroMenu', $dados);
    }

    public static function getMenu() {
        $data = array();
        $menu = new Menu();
        foreach ($menu->get() as $key):
            array_push($data, $key);
        endforeach;
//        die(var_dump($data));
        return $data;
    }

    public function addItemMenu() {

        if (isset($_FILES['imagem']['tmp_name']) && !empty($_FILES['imagem'])):
            $file = $_FILES;
            if (Image::validarTipoImagem($file)):
                echo 'Imagem válida!';
            else:
                echo 'Imagem inválida!';
            endif;
          
        else:
            echo 'sem imagem';
        
        endif;

        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post['category_id']) && !empty($post['category_id'])) {
            $data = array();
            $data['name_item'] = addslashes($post['name_item']);
            $data['category_id'] = addslashes($post['category_id']);
            $data['description_item'] = addslashes($post['description_item']);
            $data['price_item'] = str_replace(',', '.', addslashes($post['price_item']));
            $data['image_item'] = $file['imagem']['tmp_name'];

            $itemMenu = new Menu();
            if ($itemMenu->addItem($data)):
                header("Location: http://localhost/MeuMenu/cadastroMenu?status=true");
            else:
                header("Location: http://localhost/MeuMenu/cadastroMenu?status=false");
            endif;
        }
    }

    public function addCategoria() {
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($post['name_category']) && !empty($post['name_category'])) {
            $data = array();
            $data['name_category'] = addslashes($post['name_category']);
            $data['description_category'] = addslashes($post['description_category']);

            $itemMenu = new Menu();
            if ($itemMenu->addCategory($data)):

                header("Location: http://localhost/MeuMenu/cadastroMenu?cat=true");
            else:
                header("Location: http://localhost/MeuMenu/cadastroMenu?cat=false");
            endif;
        }
    }
}