<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author dikson
 */
class Menu {

    public function addCategory($data) {
        $createCat = new Create();
        $createCat->exeCreate('category', $data);
        if($createCat->getResult()):
            return TRUE;
        else:
            return FALSE;
        endif;
    }
    
    public function addItem($data){
        $createItem = new Create();
        $createItem->exeCreate('menu_item', $data);
         if($createItem->getResult()):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public function getCategories() {

        $readCat = new Read();
        $readCat->exeRead("category");

        if ($readCat->getRowCount() > 0):
            $data = array();
            foreach ($readCat->getResult() as $key => $category):

                $data[$key]['category_id'] = $category['category_id'];
                $data[$key]['name_category'] = $category['name_category'];
                $data[$key]['description_category'] = $category['description_category'];
            endforeach;
            return $data;
        endif;
    }

    public function get() {
        $readMenu = new Read();
        $readMenu->fullRead("SELECT * FROM menu_item AS m JOIN category AS c ON m.category_id = c.category_id");

        if ($readMenu->getRowCount() > 0):
            $data = array();
            foreach ($readMenu->getResult() as $key => $menu):
                $data[$key] = $menu;
            endforeach;
            return $data;
        endif;
    }

}
