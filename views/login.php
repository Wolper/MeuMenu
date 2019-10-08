<form method="POST" action="login/loginUser" >
    Email:<br/>
    <input type="email" name="user_email" required="" /><br/><br/>
    Senha:<br/>
    <input type="password" name="user_password" required="" /><br/><br/>

    <input type="submit" value="Entrar"/><br/>
</form>
<div id="divLogin"><?= (isset($_GET['login']) && $_GET['login'] = 'false') ? 'E-mail ou senha inválidos' : '' ?></div>

<?php
if (empty($_SESSION['userLogin'])):
    echo '<h1>Guest</h1>';

    /**
     * AUTH FACEBOOK
     */
    $facebook = new League\OAuth2\Client\Provider\Facebook([
        'clientId' => FACEBOOK['app_id'],
        'clientSecret' => FACEBOOK['app_secret'],
        'redirectUri' => FACEBOOK['app_redirect'],
        'graphApiVersion' => FACEBOOK['app_version']
    ]);
    
    $authUrl = $facebook->getAuthorizationUrl([
        'scope' => ['email']
    ]);
    echo "<a title='FB Login' href='{$authUrl}'>Facebook Login</a>";
else:
    echo '<h1>User Name</h1>';
endif;
?>
<div class="g-signin2" data-onsuccess="onSignIn"></div>
<div id="msg"></div>