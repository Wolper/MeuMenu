<form method='POST' action="<?= (isset($_SESSION['user_name'])) ? 'cadastroUser/editUser' : 'cadastroUser/createUser' ?>">
    Nome:<br>
    <input type='text' name='user_name' required="" value="<?= (isset($_SESSION['user_name'])) ? ($_SESSION['user_name']) : '' ?>" /><br>
    Sobrenome:<br>
    <input type='text' name='user_lastname' required="" value="<?= (isset($_SESSION['user_lastname'])) ? ($_SESSION['user_lastname']) : '' ?>"/><br>
    Email:<br>
    <input type='email' name='user_email' required="" /><br>
    Senha:<br>
    <input type='password' name='user_password' required="" /><br>
    Repita a Senha:<br>
    <input type='password' name='user_passwordRepite' required='' /><br>

    <input type='submit' value='Enviar' />
</form>
<div id="divCad"><?= (isset($_GET['msg'])) ? $_GET['msg'] : '' ?></div>
