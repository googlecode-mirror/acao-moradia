/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */         

/*-----------------------------------------------------------------------
  Máscara para o campo data dd/mm/aaaa hh:mm:ss
  Exemplo: <input maxlength="16" name="datahora" onKeyPress="DataHora(event, this)">
-----------------------------------------------------------------------*/

$(document).ready(function(){
	$(function(){
		$.mask.addPlaceholder("~","[+-]");
		$("#cpf").mask("999.999.999-99");
                $("#telefone").mask("(99) 9999-9999?9");                
	});
});
function validaData(campo,valor) {
    var date=valor;
    var ardt=new Array;
    var ExpReg=new RegExp("(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[12][0-9]{3}");
    ardt=date.split("/");
    erro=false;
    if ( date.search(ExpReg)==-1){
        erro = true;
    }
    else if (((ardt[1]==4)||(ardt[1]==6)||(ardt[1]==9)||(ardt[1]==11))&&(ardt[0]>30))
        erro = true;
    else if ( ardt[1]==2) {
        if ((ardt[0]>28)&&((ardt[2]%4)!=0))
            erro = true;
        if ((ardt[0]>29)&&((ardt[2]%4)==0))
            erro = true;
    }
    if (erro) {
        alert("\"" + valor + "\" não é uma data válida!!!");
        campo.value = "";
        return false;
    }
    return true;
}


function Data(evento, objeto){
    var keypress=(window.event)?event.keyCode:evento.which;
    campo = eval (objeto);
    if (campo.value == '00/00/0000')
    {
        campo.value=""
    }

    caracteres = '0123456789';
    separacao1 = '/';
    conjunto1 = 2;
    conjunto2 = 5;
    if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (10))
    {
        if (campo.value.length == conjunto1 )
            campo.value = campo.value + separacao1;
        else if (campo.value.length == conjunto2)
            campo.value = campo.value + separacao1;
    }
    else
        event.returnValue = false;

}

function checkBox(){
    if($('#conjugue').is(':checked')){
        $('#formConjugue').show();
    } else{
        $('#formConjugue').hide();
    }
}

function novoEndereco(){
    if($('#novoFormEndereco').is(':checked')){
        $('#novoEndereco').show();
    } else{
        $('#novoEndereco').hide();
    }
}

function novoTelefone(){
    if($('#telefone2').is(':checked')){
        $('#novoTelefone').show();

    } else{
        $('#novoTelefone').hide();
    }
}

function numeros(){
    tecla = event.keyCode;
    if (tecla >= 48 && tecla <= 57)
    {
        event.returnValue = true;
        alert('tecla: '+tecla);
    }
    else
    {
        event.returnValue = false;
    }
}   

function lookup(inputString) {
        if(inputString.length == 0) {
                // Hide the suggestion box.
                $('#suggestions').hide();
        } else {
                $.post("busca_pais.php", {queryString: ""+inputString+""}, function(data){
                        if(data.length >0) {
                                $('#suggestions').show();
                                $('#autoSuggestionsList').html(data);
                        }
                });
        }
} // lookup

function fill(thisValue) {
        $('#inputString').val(thisValue);
        setTimeout("$('#suggestions').hide();", 200);
}

function valida_nome(){        
    if($("#nome").val()==""){
        alert("Preencha o campo nome.");        
        document.cadastro.nome.focus();
        return false;
    }    
    return true;
}