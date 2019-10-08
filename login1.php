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
<html lang="en">
  <head>
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="YOUR_CLIENT_ID.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
  </head>
  <body>
    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
      }
    </script>
  </body>
</html>