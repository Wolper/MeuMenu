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

    public function editar(int $user_id) {
        
    }

    public function getUser(int $user_id) {
        $readUser = new Read();
        $readUser->exeRead(self::entity, "WHERE user_id = :user_id", "user_id={$user_id}");

        if ($readUser->getRowCount() > 0):
           return $this->result = $readUser->getResult();
        endif;
    }

}
