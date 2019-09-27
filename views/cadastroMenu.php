<div>
    <form method='POST' action="cadastroMenu/addCategoria" >
        <h4>Adicione uma Categoria</h4>
        Nome da  Categoria:<br>
        <input type='text' name='name_category' required=""  /><br>
        Descrição:<br>
        <input type='text' name='description_category' required=""  /><br>

        <input type='submit' value='Enviar' name="cadastroCategoria" />       
    </form>
</div>
<div>
    <form method='POST' action="cadastroMenu/addItemMenu" >
        <h4>Adicione um item no Menu</h4>
        Categoria:<br>
        <select id='selectCategoria' name='category_id' required="" >
        </select><br><br>
        Nome do Item:<br>
        <input type='text' name='name_item' required=""  /><br>
        Descrição:<br>
        <input type='text' name='description_item' required=""  /><br>
        Preço em R$:<br>
        <input type='text' name='price_item' required=""  /><br>

        <input type='submit' value='Enviar' name="cadastroItemMenu" />       
    </form>
    <a href="<?= BASE_URL ?>logado" >Sair</a>
</div>
<div id="divLogin"><?= (isset($_GET['status']) && !empty($_GET['status'])) ? ($_GET['status'] == 'true') ? 'Item cadastrado com sucesso!' : 'O item não foi cadastrado, tente mais tarde!' : '' ?></div>

<div id="exibeMenu"></div>

