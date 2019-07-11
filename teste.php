<!--//<?= define("BASE_URL", "http://localhost/ProjetoMeuMenu/"); ?>
<form>
    <select id="selectEstado" name='ufEmpresa' >
    </select><br><br>
    <select id="selectCidade" name='cidadeEmpresa' >
    </select><br><br>
    <input type='submit' value='Enviar' />
</form>
<script type="text/javascript" src="//<?= BASE_URL ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" >

    $.ajax({
        type: 'POST',
        url: 'teste2.php',
        dataType: 'json',
        success: function (json) {
            for (var i in json) {
                $('#selectEstado').append('<option value="' + json[i].estado_id + '">' + json[i].estado_nome + '</option>');
            }
        },
        error: function () {}
    });
    
    
    $('#selectEstado').change(function () {
        $('#selectCidade').html('');
        var estado_id = $('#selectEstado').val();

        $.ajax({
            type: 'POST',
            url: 'teste3.php',
            data: {estado_id: estado_id},
            dataType: 'json',
            success: function (json) {
                for (var i in json) {
                    $('#selectCidade').append('<option value="' + json[i].cidade_id + '">' + json[i].cidade_nome + '</option>');
                }
            },
            error: function () {}
        }
        );
    });
</script>-->