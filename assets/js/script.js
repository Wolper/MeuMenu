$(function () {

    //Requisição ajax puxa os dados do banco relativo aos estados da federação e encaminha para o select de cadastro da empresa
    $('#selectEstado').focus(function () {
        $.ajax({
            type: 'POST',
            url: 'http://localhost/ProjetoMeuMenu/ajax/loadEstados',
            dataType: 'json',
            success: function (json) {
                //Recebe o json de UF e monta os OPTIONS correspondentes
                for (var i in json) {
                    $('#selectEstado').append('<option value="' + json[i].estado_id + '">' + json[i].estado_nome + '</option>');
                }
            },
            error: function () {}
        });
    });


    //Requisição ajax aguarda a escolha da UF para requerer as cidades relativas ao estado da federação selecionado
    $('#selectEstado').change(function () {
        $('#selectCidade').html('');
        var estado_id = $('#selectEstado').val();

        $.ajax({
            type: 'POST',
            url: 'http://localhost/ProjetoMeuMenu/ajax/loadCidades',
            data: {estado_id: estado_id},
            dataType: 'json',
            success: function (json) {
                //Recebe o json de Cidades e monta os OPTIONS correspondentes
                for (var i in json) {
                    $('#selectCidade').append('<option value="' + json[i].cidade_id + '">' + json[i].cidade_nome + '</option>');
                }
            },
            error: function () {}
        }
        );
    });
    
    comparaSenhas();
//    $('input[name=passwordRepite]').keypress(function () {
//        var email = $('input[name=email]').val();
//        var senha1 = $('input[name=password]').val();
//        var senha2 = $('input[name=passwordRepite]').val();
//
//        if (senha1.length < 8) {
//            $('#divCad').html('Senhas devem conter ao menos 8 dígitos!');
//      
//        } else {
//            if (email !== '' && senha1 !== '' && senha2 !== '') {
//                if (senha1 !== senha2) {
//                    $('#divCad').html('As senhas devem ser iguais!');
//                  
//                } else {
//                    $('#divCad').html('');
//                  
//                }
//            } else {
//                $('#divCad').html('Não é possível cadastrar elementos vazios!');
//            
//            }
//        }
//    });
});

//------------------------------------------------------------------------------            
//Função compara os dois imputs de senha no momento do cadastro do usuário
function comparaSenhas() {
    $('input[name=passwordRepite]').keypress(function () {
        var email = $('input[name=email]').val();
        var senha1 = $('input[name=password]').val();
        var senha2 = $('input[name=passwordRepite]').val();

        if (senha1.length < 8) {
            $('#divCad').html('Senhas devem conter ao menos 8 dígitos!');
      
        } else {
            if (email !== '' && senha1 !== '' && senha2 !== '') {
                if (senha1 !== senha2) {
                    $('#divCad').html('As senhas devem ser iguais!');
                  
                } else {
                    $('#divCad').html('');
                  
                }
            } else {
                $('#divCad').html('Não é possível cadastrar elementos vazios!');
            
            }
        }
    });
}

//##############################################################################
//MÁSCARA PARA INPUTS - CNPJ, CPF, TEL, CEP E NÚMERO
function fMasc(objeto, mascara) {
    obj = objeto;
    masc = mascara;
    setTimeout("fMascEx()", 1);
}
function fMascEx() {
    obj.value = masc(obj.value);
}
function mTel(tel) {
    tel = tel.replace(/\D/g, "");
    tel = tel.replace(/^(\d)/, "($1");
    tel = tel.replace(/(.{3})(\d)/, "$1)$2");
    if (tel.length == 9) {
        tel = tel.replace(/(.{1})$/, "-$1");
    } else if (tel.length == 10) {
        tel = tel.replace(/(.{2})$/, "-$1");
    } else if (tel.length == 11) {
        tel = tel.replace(/(.{3})$/, "-$1");
    } else if (tel.length == 12) {
        tel = tel.replace(/(.{4})$/, "-$1");
    } else if (tel.length > 12) {
        tel = tel.replace(/(.{4})$/, "-$1");
    }
    return tel;
}
function mCNPJ(cnpj) {
    cnpj = cnpj.replace(/\D/g, "");
    cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
    cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
    cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
    cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");
    return cnpj;
}
function mCPF(cpf) {
    cpf = cpf.replace(/\D/g, "");
    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
    cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
    return cpf;
}
function mCEP(cep) {
    cep = cep.replace(/\D/g, "");
    cep = cep.replace(/^(\d{2})(\d)/, "$1.$2");
    cep = cep.replace(/\.(\d{3})(\d)/, ".$1-$2");
    return cep;
}
function mNum(num) {
    num = num.replace(/\D/g, "");
    return num;
}
//##############################################################################