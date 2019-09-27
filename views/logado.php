<h1>Sessão do usuário</h1>

<ul>
    <li><a href="<?= BASE_URL . 'cadastroRestaurante' ?>">Cadastre seu restaurante</a></li>
    <li>Meu Menu</li>
    <li>Meus dados</li>
    <li>Configurações</li>
</ul>

<div>
    <h3>Restaurante Cadastrado</h3>
    <h4>Nome fantasia do restaurante ... Puxar do DB via ajax ...</h4>
    <a href="<?= BASE_URL . 'cadastroMenu' ?>">Adicionar Menu</a>
    <a href="<?= BASE_URL . 'cadastroUser/setUserInView/' . $_SESSION['user_id'] ?>">Editar dados do usuário</a>
</div>