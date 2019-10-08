$(function () {

//Requisição ajax puxa os dados do banco relativo aos estados da federação e encaminha para o select de cadastro da empresa
    $('#selectEstado').focus(function () {
        $.ajax({
            type: 'POST',
            url: 'http://localhost/MeuMenu/ajax/loadEstados',
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
            url: 'http://localhost/MeuMenu/ajax/loadCidades',
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
    //Requisição ajax puxa os dados do banco relativo às categorias dos itens do cardápio e encaminha para o select de cadastro de item de menu
    $('#selectCategoria').focus(function () {
        $.ajax({
            type: 'POST',
            url: 'http://localhost/MeuMenu/ajax/loadCategorias',
            dataType: 'json',
            success: function (json) {
                //Recebe o json de Categorias e monta os OPTIONS correspondentes
                for (var i in json) {
                    $('#selectCategoria').append('<option value="' + json[i].category_id + '">' + json[i].name_category + '</option>');
                }
            },
            error: function () {}
        });
    });
    //Chamada da função para apresentar o menu ao usuário
    exibeMenu();
    //Chamada da função ao cadastrar usuário, verifica se ambas senhas são iguais
    comparaSenhas();
});
//Função que faz requisição ajax puxa os dados do banco relativo aos itens de menu
//e os exibe na atela ao usuário
function exibeMenu() {
    $.ajax({
        type: 'POST',
        url: 'http://localhost/MeuMenu/ajax/loadMenu',
        dataType: 'json',
        success: function (json) {

            //Recebe o json de Categorias e monta os OPTIONS correspondentes
            $('#exibeMenu').append('<table>');
            $('#exibeMenu').append('<th>M E N U</th>');


            for (var i in json) {

                if (i !== '0') {
                    if (json[i].category_id !== json[i - 1].category_id) {
                        $('#exibeMenu').append('<tr><td>' + json[i].name_category + '</td></tr>');
                        $('#exibeMenu').append('<tr>');
                        $('#exibeMenu').append('<td>Item</td>');
                        $('#exibeMenu').append('<td>Nome</td>');
                        $('#exibeMenu').append('<td>Descrição</td>');
                        $('#exibeMenu').append('<td>Quant</td>');
                        $('#exibeMenu').append('</tr>');
                    }
                } else {
                    $('#exibeMenu').append('<tr><td>' + json[i].name_category + '</td></tr>');
                    $('#exibeMenu').append('<tr>');
                    $('#exibeMenu').append('<td>Item</td>');
                    $('#exibeMenu').append('<td>Imagem</td>');
                    $('#exibeMenu').append('<td>Nome</td>');
                    $('#exibeMenu').append('<td>Descrição</td>');
                    $('#exibeMenu').append('<td>Quant</td>');
                    $('#exibeMenu').append('</tr>');
                }
                var s = parseInt(i) + parseInt(1);
                $('#exibeMenu').append('<tr>');
                $('#exibeMenu').append('<td>' + s + '</td>');
                $('#exibeMenu').append('<td>' + json[i].image_item + '</td>');
//                $('#exibeMenu').append('<td><img src="http://localhost/MeuMenu/assets/images/meumenu.jpg" width="60" height="40" />  </td>');
                $('#exibeMenu').append('<td>' + json[i].name_item + '</td>');
                $('#exibeMenu').append('<td>' + json[i].description_item + '</td>');
                $('#exibeMenu').append('<td>' + json[i].price_item + '</td>');
                $('#exibeMenu').append('</tr>');
            }
            $('#exibeMenu').append('</table>');
        },
        error: function () {
//            alert('Erro! Não foi possível adicionar item!');
        }
    });
}

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

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    var userId = profile.getId();
    var userName = profile.getName();
    var userImage = profile.getImageUrl();
    var userEmail = profile.getEmail();
    var userToken = googleUser.getAuthResponse().id_token;

    if (userEmail !== '') {
        var dados = {
            userId: userId,
            userName: userName,
            userImage: userImage,
            userEmail: userEmail
        };
        $.post('http://localhost/MeuMenu/ajax/validaEmailGoogle', dados, function (retorno) {
            if (retorno === '"false"') {
                var msg = "Não há usuário com esse e-mail!";
                document.getElementById("msg").innerHTML = msg;
            } else {
                window.location.href = 'logado';

            }
        });
    } else {
        var msg = "Usuário não encontrado!";
        document.getElementById("msg").innerHTML = msg;
    }
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