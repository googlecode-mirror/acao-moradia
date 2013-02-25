/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */         

////usada em vIncluirPessoaCurso para autocomplete
//function lookup(pessoa) {
//        if(pessoa.length == 0) {
//                // Hide the suggestion box.
//                $('#suggestions').hide();
//        } else {
//                $.post("pessoas.php", {queryString: ""+pessoa+""}, function(data){
//                        if(data.length >0) {
//                                $('#suggestions').show();
//                                $('#autoSuggestionsList').html(data);
//                        }
//                });
//        }
//} // lookup
//
////usada em vIncluirPessoaCurso para autocomplete
//function fill(thisValue) {
//        $('#pessoa').val(thisValue);
//        setTimeout("$('#suggestions').hide();", 200);
//}

/*-----------------------------------------------------------------------
  Máscara para o campo data dd/mm/aaaa hh:mm:ss
  Exemplo: <input maxlength="16" name="datahora" onKeyPress="DataHora(event, this)">
-----------------------------------------------------------------------*/
jQuery(function(){
    jQuery("#cpf").mask("999.999.999-99");
    jQuery("#cep").mask("99999-999");
    jQuery("#telefone").mask("(99) 9999-9999?9");
    jQuery("#telefone_residencial").mask("(99) 9999-9999?9");
    jQuery("#dataNascimento").mask("99/99/9999");
    jQuery("#numero").mask("9?99999");
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
        //alert("\"" + valor + "\" não é uma data válida!!!");
        campo.value = "";
        return false;
    }
    return true;
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

/*----------------------------------------------------------------------------
 função que valida a primeira etapa de cadastrar os dados da familia.
-----------------------------------------------------------------------------*/
function valida_etapa_1(){            
    valida_nome();
        
    if($("#cep").val()==""){
        alert("Preencha o campo cep.");        
        document.cadastro.cep.focus();
        return false;
    }
    if($("#logradouro").val()==": " || $("#logradouro").val()==""){
        alert("Preencha o campo logradouro.");        
        document.cadastro.logradouro.focus();
        return false;
    }
    if($("#numero").val()==""){
        alert("Preencha o campo numero.");        
        document.cadastro.numero.focus();
        return false;
    }    
    if($("#cidade").val()=="null"){
        alert("Preencha o campo estado e cidade.");        
        document.cadastro.estado.focus();
        return false;
    }    
    if($("#bairro").val()==""){
        alert("Preencha o campo bairro.");        
        document.cadastro.bairro.focus();
        return false;
    }     
    return true;
}

function valida_etapa_2(){        
    return valida_nome();            
    
}


/*----------------------------------------------------------------------------
 controla a validação das etapas do cadastro de famílias.
-----------------------------------------------------------------------------*/
var msg_confirm = "Clique em OK para incluir outras pessoas.\n\nClique em Cancelar ou em Fechar(X) para ir ao cadastro socioeconômico"
function controla(){              
    //alert(document.getElementById("et").value);
    //alert($("#et").val());    
    switch($("#et").val()){
        case "1":
            if(valida_etapa_1()==true){                                                
                if(confirm(msg_confirm))
                {
                    document.getElementById("et").value='2';//alterar o valor do campo hidden com id #et para 2                    
                    //vai persistir no banco os dados e passa para a pesquisa socio-economica                    
                }else{
                    document.getElementById("et").value='3';//alterar o valor do campo hidden com id #et para 3                    
                    //vai para a pesquisa socioeconomica da família!
                }
                //alert(document.getElementById("et").value);
                return true;                
            }else{                
                return false;
            }
        break;
        case "2":
            if(valida_etapa_2()==true){
                if(!confirm(msg_confirm))
                {                                    
                    document.getElementById("et").value='3';//alterar o valor do campo hidden com id #et para 3                    
                    //vai para a pesquisa socioeconomica
                }
                return true;
            }else{                
                return false;
            }        
        break;
        default:
            return false;
    }
}

/*----------------------------------------------------------------------------
 função que verifica em qual etapa do cadastro da familia foi parado. Esta 
 funão existe, pq se o usuário voltar um página no browser e o campo cep 
 estiver escrito algo, significa que a etapa 2 foi concluida.
-----------------------------------------------------------------------------*/
function verifica_etapa(){          
    //alert(document.getElementById("et").value);
    /*
    if($("#cep").val() != ""){
        cadastra_endereco_familia();
    } */   
}

/*----------------------------------------------------------------------------
 função que habilita os campos da etapa 2, bem como muda o texto para etapa 2 
 e foca o cursor no cep
-----------------------------------------------------------------------------*/
function cadastra_endereco_familia()
{
    $("#logradouro").removeAttr('disabled');
    $("#numero").removeAttr('disabled');    
    $("#cidade").removeAttr('disabled');
    $("#bairro").removeAttr('disabled');
    $("#cep").removeAttr('disabled');
    $("#estado").removeAttr('disabled');
    $('#etapa').text("Etapa 2/3: Cadastro de Endereço Familiar");
    document.cadastro.cep.focus();
}

/*----------------------------------------------------------------------------
 função responsável por preencher a cidade, o bairro, o estado, o logradouro
 quando o cep é fornecido pelo usuário.
-----------------------------------------------------------------------------*/
function getEndereco() {
    // Se o campo CEP não estiver vazio
    if($.trim($("#cep").val()) != ""){
        /* 
                Para conectar no serviço e executar o json, precisamos usar a função
                getScript do jQuery, o getScript e o dataType:"jsonp" conseguem fazer o cross-domain, os outros
                dataTypes não possibilitam esta interação entre domínios diferentes
                Estou chamando a url do serviço passando o parâmetro "formato=javascript" e o CEP digitado no formulário
                http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val()
        */
        $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cep").val(), function(){
                // o getScript dá um eval no script, então é só ler!
                //Se o resultado for igual a 1
                if(resultadoCEP["resultado"]){
                        // troca o valor dos elementos
                        $("#logradouro").val(unescape(resultadoCEP["tipo_logradouro"])+": "+unescape(resultadoCEP["logradouro"]));
                        $("#bairro").val(unescape(resultadoCEP["bairro"]));
                        //$("#estado").val(unescape(resultadoCEP["uf"]));                        
                        //$("#cidade").val(unescape(resultadoCEP["cidade"]));                                                                        
                        
                }else{
                        alert("Endereço não encontrado");
                }
        });				
    }			
}

/*----------------------------------------------------------------------------
 função que ao ser preenchido o campo #estado, este dado é enviado para 
 vcCidades.php para que as cidades deste estado sejam buscadas no banco 
 de dados e exibidas ao usuário.
-----------------------------------------------------------------------------*/
$(document).ready(function(){    
    $('#estado').change(function(){
        $('#cidade').load('vcCidades.php?estado='+$('#estado').val() );

    });
    
    $('#estadoNatal').change(function(){
        $('#cidadeNatal').load('vcCidades.php?estado='+$('#estadoNatal').val() );

    });  
});     


//verifica se o login do funcionario nao esta em branco, no cadastro de funcionario
function valida_cadastro_funcionario_login(){        
    if(($("#usuario").val()=="")|| ($("#senha").val()=="")){
        alert("Preencha os campos obrigatórios!");        
        return false;
    }    
    return true;
}

function valida_dados_individualmente(){
    if(valida_etapa_1()==true){                                                                
        return true;                
    }else{                
        return false;
    }
}

function altera_titular(){          
    if($("#titularAntigo").val()!=$("#titular").val()){//se mudou o titular
        $("#pessoas").load("../controle/cMontaPessoasFamilia.php", {id_familia:$("#idFamilia").val()});
    }    
}

function valida_titular(){
    //alert($("#grauParentesco[]").val());
    var e= document.cadastro.elements.length;
    var cnt=0;
    var titulares = 0;

    for(cnt=0;cnt<e;cnt++)
    {             
       if(document.cadastro.elements[cnt].value == 'TITULAR'){
           titulares += 1;           
       }
    }
    if(titulares == 0){
        alert("ERRO.: uma família tem que ter um TITULAR cadastrado");
        return false;
    }else{
        if(titulares > 1){
            alert("ERRO.: uma família não pode ter mais de um TITULAR cadastrado");
            return false;
        }
    }
    return true;
}

function valida_edita_familia(){
    if(valida_etapa_1()){
        return true;
    }
            //&& verifica_existencia_titular()==true){    
    return false;           
}