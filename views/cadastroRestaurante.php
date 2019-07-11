<div id="divCad"></div>
<form id='formCadRest' method='POST' >
    <h4>Dados do Proprietário ou Responsável</h4>
    Nome do proprietário:<br>
    <input type='text' name='nome' required=""  /><br>
    CPF:<br>
    <input type='text' name='cpf' required="" maxlength="14" size="14" onkeydown="fMasc(this, mCPF)" /><br>
    Telefone:<br>
    <input type='text' name='telefone' required="" maxlength="14" onkeydown="fMasc(this, mTel)" /><br>
    <h4>Dados da Empresa</h4>
    Razão Social:<br>
    <input type='text' name='razaoSocial' required="" /><br>
    Nome Fantasia:<br>
    <input type='text' name='nomeFantasia' required="" /><br>
    CNPJ:<br>
    <input type='text' name='cnpjEmpresa' required="" maxlength="18" size="18" onkeydown="fMasc(this, mCNPJ)" /><br>
    Telefone:<br>
    <input type='text' name='telEmpresa' required="" maxlength="14" onkeydown="fMasc(this, mTel)" /><br>
    <h5>Endereço</h5>
    Logradouro:<br>
    <input type='text' name='logEmpresa' required="" /><br>
    Número:<br>
    <input type='text' name='numEmpresa' required="" maxlength="5" onkeydown="fMasc(this, mNum)" /><br>
    Bairro:<br>
    <input type='text' name='bairroEmpresa' required="" /><br>
    UF:<br>
    <select id='selectEstado' name='ufEmpresa' required="" >
    </select><br><br>
    Cidade:<br>
    <select id='selectCidade' name='cidadeEmpresa' required="" >  
    </select><br><br>
    <input type='submit' value='Enviar' name="cadastroRestaurante" onclick="cadastrarRestaurante()" />
</form>
