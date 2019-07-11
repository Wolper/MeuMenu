<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Meu site</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL?>assets/css/style.css" />
        
    </head>
    <body>
        <h1>Este é o topo</h1>
        <a href="<?= BASE_URL?>">Home</a>
        <a href="<?= BASE_URL.'cadastroUser'?>">Cadastre seu restaurante</a>
        <a href="<?= BASE_URL.'login'?>">Entrar</a>
       
        <hr/>
        <?php $this->loadViewInTemplate($viewName, $viewData) ?>
        
        <script type="text/javascript" src="<?= BASE_URL?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?= BASE_URL?>assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?= BASE_URL?>assets/js/script.js"></script>
       
    </body>
</html>
