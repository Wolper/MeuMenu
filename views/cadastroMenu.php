<div>
    <form method='POST' action="cadastroMenu/addItemMenu" >
        <h4>Adicione um item no Menu</h4>
        Categoria:<br>
        <select id='selectCategoria' name='categoriaItem' required="" >
        </select><br><br>
        Nome do Item:<br>
        <input type='text' name='nomeItem' required=""  /><br>
        Descrição:<br>
        <input type='text' name='descricaoItem' required=""  /><br>
        Preço em R$:<br>
        <input type='text' name='precoItem' required=""  /><br>

        <input type='submit' value='Enviar' name="cadastroItemMenu" />
    </form>
</div>

<!--<div id="divLogin"><?= (isset($_GET['addRest']) && $_GET['addRest'] = 'false') ? 'Não foi possível cadastrar seu restaurante, tente mais tarde!' : '' ?></div>-->