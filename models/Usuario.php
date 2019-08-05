<?php

class Usuario {

    private $data;
    private $userId;
    private $error;
    private $result;

    //nome da tabela no DB
    const entity = 'user';

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

        $readUser = new Read();
        $readUser->exeRead(self::entity, "WHERE user_email = :email", "email={$data['email']}");

        if ($readUser->getRowCount() > 0):
            $this->result = false;
            $this->error = ['Erro ao cadastrar: Já existe usuário cadastrado com este e-mail!', WS_ALERT, $this->result];
        else:
            $createUser = new Create();
            $createUser->exeCreate(self::entity, $data);

            if ($createUser->getResult()):
                Session::setValue('user_id', $createUser->getResult());
                $this->result = true;
                $this->error = ['Sucesso: Usuário cadastrado no sistema!', WS_INFOR, $this->result];
            endif;
        endif;
        return $this->error;
    }

//    public function adicionarRestaurante(array $data) {
//
//        self::Connect();
////        extract($data);
//        $sql = $this->conn->prepare("INSERT INTO restaurant SET nome =:nome, cpf =:cpf, telefone =:telefone, user_id =:user_id, razao_social =:razao_social, nome_fantasia =:nome_fantasia, cnpj =:cnpj, tel_emp =:tel_emp, logradouro =:logradouro, numero =:numero, bairro =:bairro, cidade =:cidade, uf =:uf");
//
//        $sql->bindValue(":nome", $data['nome']);
//        $sql->bindValue(':cpf', $data['cpf']);
//        $sql->bindValue(":telefone", $data['telefone']);
//        $sql->bindValue(":user_id", $data['user_id']);
//        $sql->bindValue(":razao_social", $data['razao_social']);
//        $sql->bindValue(':nome_fantasia', $data['nome_fantasia']);
//        $sql->bindValue(":cnpj", $data['cnpj']);
//        $sql->bindValue(':tel_emp', $data['tel_emp']);
//        $sql->bindValue(':logradouro', $data['logradouro']);
//        $sql->bindValue(":numero", $data['numero']);
//        $sql->bindValue(':bairro', $data['bairro']);
//        $sql->bindValue(":cidade", $data['cidade']);
//        $sql->bindValue(':uf', $data['uf']);
//
//        $sql->execute();
//        return true;
//    }

    private function getIdUser($email) {
        self::Connect();

        $sql = $this->conn->prepare("SELECT `user_id` FROM `user` WHERE `email` =:email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch()['user_id'];
        }
    }

}
