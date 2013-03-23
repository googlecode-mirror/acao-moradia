
/**
 *  Máscara para o campo data dd/mm/aaaa hh:mm:ss
 *  Exemplo: <input maxlength="16" name="datahora" onKeyPress="DataHora(event, this)">
 */
jQuery(function(){
    jQuery("#cpf").mask("999.999.999-99");
    jQuery("#cep").mask("99999-999");
    jQuery("#telefone").mask("(99) 9999-9999?9");
    jQuery("#telefone_residencial").mask("(99) 9999-9999?9");
    jQuery("#dataNascimento").mask("99/99/9999");
    jQuery("#numero").mask("9?99999");
});

/**
 *  Valida uma data.
 */
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

/**
 *  Valida o campo nome: não pode ser vazio.
 */
function valida_nome(){
    if($("#nome").val()==""){
        alert("Preencha o campo nome.");        
        document.cadastro.nome.focus();
        return false;
    }     
    return true;
}

/**
 *  função que valida a primeira etapa de cadastrar os dados da familia.
 */
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

/**
 *  Valida a segunda etapa do cadastro de familia.
 */
function valida_etapa_2(){        
    return valida_nome();            
    
}


/**
 *  Controla a validação das etapas do cadastro de famílias.
 */
//var msg_confirm = "Clique em OK para incluir outras pessoas.\n\nClique em Cancelar ou em Fechar(X) para ir ao cadastro socioeconômico"
var msg_confirm = "Clique em OK para INCLUIR outras pessoas.\n\nClique em Cancelar ou em Fechar(X) para TERMINAR O CADASTRO";
function controla(){                  
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
                    //window.location("../visao/vFamiliaInteira.php?id_familia="+$("idFamilia").val());
                }//               return true;
            }else{                
                return false;
            }        
        break;
        default:
            return false;
    }
}

/**
 *  Função responsável por preencher a cidade, o bairro, o estado, o logradouro
 *  quando o cep é fornecido pelo usuário.
 */
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

/**
 *  Função que ao ser preenchido o campo #estado, este dado é enviado para 
 *  vcCidades.php para que as cidades deste estado sejam buscadas no banco 
 *  de dados e exibidas ao usuário.
 */
$(document).ready(function(){    
    $('#estado').change(function(){
        $('#cidade').load('vcCidades.php?estado='+$('#estado').val() );

    });
    
    $('#estadoNatal').change(function(){
        $('#cidadeNatal').load('vcCidades.php?estado='+$('#estadoNatal').val() );

    });  
});     


/**
 *  Verifica se está ok os dados ao editar uma pessoa.
 */
function valida_dados_individualmente(){
    if(valida_etapa_1()==true){                                                                
        return true;                
    }else{                
        return false;
    }
}

/**
 *  Verifica se o titular da família foi alterado ao editar uma família.
 */
function altera_titular(){          
    if($("#titularAntigo").val()!=$("#titular").val()){//se mudou o titular
        $("#pessoas").load("../controle/cMontaPessoasFamilia.php", {id_familia:$("#idFamilia").val()});
    }    
}

/**
 *  Verifica se existe um titular na família, pois é necessário.
 */
function valida_titular(){    
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

/**
 *  Valida dados ao editar uma família.
 */
function valida_edita_familia(){
    if(valida_etapa_1()){
        return true;
    }            
    return false;           
}

/**
 *  Exibe uma mensagem de confirmação para desvincular uma pessoa a um curso.
 */
function confirmaExclusaoPessoaCurso(){
    if(confirm("Você realmente deseja retirar esta pessoa deste curso?")){
        return true;
    }else{
        return false;
    }
}

/**
 *  Exibe uma mensagem de confirmação para desvincular uma pessoa a um curso.
 */
function updateTable(){                
    $.ajax({
        type      : 'post', 
        url       : '../controle/cMontaTabelaCurso.php', 
        data      : 'idCurso='+ $('#idCurso').val()+'&idPessoa='+ $('#idPessoa').val(), 
        dataType  : 'html', 
        success : function(txt){
            $('#showtable').html(txt);
        }                    
    });                     
}

//auto complete
function lookupperson(pessoa) {
    if(pessoa.length == 0) {
        // Hide the suggestion box.
        $('#suggestions').hide();
    } else {
        $.post("vAutoCompletePessoas.php", {queryString: ""+pessoa+""}, function(data){
            if(data.length >0) {
                $('#suggestions').show();
                $('#autoSuggestionsList').html(data);
            }
        });
    }
} // lookup

/**
 * Preenche campo pessoa em vIncluirPessoaCurso.php
 */
function fill(thisValue) {
    $('#pessoa').val(thisValue);                                
}

/**
 * Preenche campo idPessoa em vIncluirPessoaCurso.php
 */
function fill2(thisValue) {                
    $('#idPessoa').val(thisValue);                
}

/**
 * Preenche campo descricao em vIncluirPessoaCurso.php
 */
function fill3(thisValue) {                
    $( "#descricao" ).html( thisValue );
    setTimeout("$('#suggestions').hide();", 200);
}

/**
 * Se a tecla for esc ou backsepace esconde a sugestao em vIncluirPessoaCurso.php
 */
function tratarTecla(tecla, evento){
    if(evento.keyCode == "27" || evento.keyCode == "8"){
        $('#suggestions').hide();                    
    }
}

/**
 * Valida o aluno em vIncluirPessoaCurso.php. A pessoa deve selecionar uma pessoa que está na
 * lista de sugestão para pegar o id da pessoa selecionada.
 */
function valida_aluno(){
    if($('#idPessoa').val() == '-1'){
        alert("Você deve selecionar uma pessoa que está na lista de sugestão.");
        $("#pessoa").val('');
        $("#pessoa").focus();
        return false;
    }
    return true;              
}            