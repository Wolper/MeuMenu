<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Restaurante
 *
 * @author dikson
 */
class Restaurante extends Conn {

    private $conn;

    private function Connect() {
        $this->conn = parent::getConn();
    }

    public function adicionar(array $data) {

        self::Connect();


        $sql = $this->conn->prepare("SELECT `restaurant_id` FROM `restaurant` WHERE `cnpj` =:cnpj");
        $sql->bindValue(":cnpj", $data['cnpj']);
        $sql->execute();

        if ($sql->rowCount() > 0):
            return false;

        else:
            $sql = $this->conn->prepare("INSERT INTO restaurant SET nome =:nome, cpf =:cpf, telefone =:telefone, user_id =:user_id, razao_social =:razao_social, nome_fantasia =:nome_fantasia, cnpj =:cnpj, tel_emp =:tel_emp, logradouro =:logradouro, numero =:numero, bairro =:bairro, cidade =:cidade, uf =:uf");

            $sql->bindValue(":nome", $data['nome']);
            $sql->bindValue(':cpf', $data['cpf']);
            $sql->bindValue(":telefone", $data['telefone']);
            $sql->bindValue(":user_id", $data['user_id']);
            $sql->bindValue(":razao_social", $data['razao_social']);
            $sql->bindValue(':nome_fantasia', $data['nome_fantasia']);
            $sql->bindValue(":cnpj", $data['cnpj']);
            $sql->bindValue(':tel_emp', $data['tel_emp']);
            $sql->bindValue(':logradouro', $data['logradouro']);
            $sql->bindValue(":numero", $data['numero']);
            $sql->bindValue(':bairro', $data['bairro']);
            $sql->bindValue(":cidade", $data['cidade']);
            $sql->bindValue(':uf', $data['uf']);

            $sql->execute();
            return true;
        endif;
    }

    private function getIdRestaurant($cnpj) {
        self::Connect();

        $sql = $this->conn->prepare("SELECT `restaurant_id` FROM `restaurant` WHERE `cnpj` =:cnpj");
        $sql->bindValue(":cnpj", $cnpj);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch()['restaurant_id'];
        }
    }

    public function getEstados() {
        self::Connect();

        $sql = "SELECT * FROM estados";
        $sql = $this->conn->query($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = array();
            foreach ($sql->fetchAll() as $key => $estado) {

                $data[$key]['estado_id'] = $estado['estado_id'];
                $data[$key]['estado_nome'] = $estado['estado_nome'];
                $data[$key]['estado_uf'] = $estado['estado_uf'];
            }
            return $data;
        }
    }

    public function getCidades() {

        self::Connect();
        $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $sql = "SELECT * FROM cidades WHERE estado_id =:estado_id";
        $sql = $this->conn->prepare($sql);
        $sql->bindValue(':estado_id', $post['estado_id']);
        $sql->execute();
        $data = array();
        if ($sql->rowCount() > 0) {

            foreach ($sql->fetchAll() as $key => $cidade) {
                $data[$key]['cidade_id'] = $cidade['cidade_id'];
                $data[$key]['estado_id'] = $cidade['estado_id'];
                $data[$key]['cidade_nome'] = $cidade['cidade_nome'];
            }
        }
        return $data;
    }
}
