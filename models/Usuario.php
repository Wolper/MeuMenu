<?php

class Usuario extends Conn {

    private $conn;

    private function Connect() {
        $this->conn = parent::getConn();
    }

    public function login(array $data) {
        if (isset($data['email']) && !empty($data['email'])) {
            $email = addslashes($data['email']);
            $password = addslashes(md5($data['password']));

            self::Connect();

            $this->conn = $this->conn->prepare("SELECT * FROM user WHERE email = :email AND password =:password");
            $this->conn->bindValue(':email', $email);
            $this->conn->bindValue(':password', md5($password));
            $this->conn->execute();

            if ($this->conn->rowCount() > 0) {
                //retorna o id do usuário para adicionar na sessão
                return($this->conn->fetch()['user_id']);
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function adicionar(array $data) {

        self::Connect();

        $sql = $this->conn->prepare("SELECT `user_id` FROM `user` WHERE `email` =:email");
        $sql->bindValue(":email", $data['email']);
        $sql->execute();

        if ($sql->rowCount() > 0):
            return false;
        else:
            $sql = $this->conn->prepare("INSERT INTO user SET email =:email, password =:password");

            $sql->bindValue(":email", $data['email']);
            $sql->bindValue(':password', md5($data['password']));

            $sql->execute();
             //retorna o id do usuário para adicionar na sessão
            Session::setValue('user_id', self::getIdUser($data['email']));
            return true;
        endif;
    }

    public function adicionarRestaurante(array $data) {

        self::Connect();
//        extract($data);
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
    }

    private function getIdUser($email) {
        self::Connect();

        $sql = $this->conn->prepare("SELECT `user_id` FROM `user` WHERE `email` =:email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if ($sql->rowCount() > 0){
            return $sql->fetch()['user_id'];
        }        
    }

}
