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

            $readUser = new Read();
            $readUser->exeRead(self::entity, "WHERE user_email = :user_email AND user_password =:user_password", "user_email={$email}&user_password={$password}");

            if ($readUser->getRowCount() > 0) {
                //retorna o id do usuário para adicionar na sessão
                return($readUser->getResult()['user_id']);
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function adicionar(array $data) {
        $readUser = new Read();
        $readUser->exeRead(self::entity, "WHERE user_email = :user_email", "user_email={$data['user_email']}");

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

    public function emailExists($email) {
        $readUser = new Read();
        $readUser->exeRead(self::entity, "WHERE user_email = :user_email", "user_email={$email}");

        if ($readUser->getRowCount() > 0):
            return $readUser->getResult()[0]['user_id'];
        else:
            return false;
        endif;
    }

}
