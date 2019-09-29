<form method="POST" action="login/loginUser" >
    Email:<br/>
    <input type="email" name="user_email" required="" /><br/><br/>
    Senha:<br/>
    <input type="password" name="user_password" required="" /><br/><br/>

    <input type="submit" value="Entrar"/><br/>
</form>
<div id="divLogin"><?= (isset($_GET['login']) && $_GET['login']='false') ? 'E-mail ou senha inválidos' : '' ?></div>