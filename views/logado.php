<h1>Sessão do usuário</h1>
<h5>UserId: <?= $_SESSION['user_id']?></h5>
<ul>
    <li><a href="<?= BASE_URL.'cadastroRestaurante'?>">Cadastre seu restaurante</a></li>
    <li>Meu Menu</li>
    <li>Meus dados</li>
    <li>Configurações</li>
</ul>
<div>
    <h3>Restaurante Cadastrado</h3>
    <h4>Nome fantasia do restaurante ... Puxar do DB via ajax ...</h4>
    <a href="<?= BASE_URL . 'cadastroMenu'?>">Adicionar Menu</a>
</div>