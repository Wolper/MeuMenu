<form method='POST' action="cadastroUser/addUser" >
    Email:<br>
    <input type='email' name='email' required="" /><br>
    Senha:<br>
    <input type='password' name='password' required="" /><br>
    Repita a Senha:<br>
    <input type='password' name='passwordRepite' required='' /><br>

    <input type='submit' value='Enviar' />
</form>
<div id="divCad"><?= (isset($_GET['addUser']) && $_GET['addUser']='false') ? 'Já existe usuário com este e-mail' : '' ?></div>