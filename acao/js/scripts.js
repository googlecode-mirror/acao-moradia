/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */         

/*-----------------------------------------------------------------------
  Máscara para o campo data dd/mm/aaaa hh:mm:ss
  Exemplo: <input maxlength="16" name="datahora" onKeyPress="DataHora(event, this)">
-----------------------------------------------------------------------*/

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

function valida_etapa_1(){        
    if($("#nome").val()==""){
        alert("Preencha o campo nome.");        
        document.cadastro.nome.focus();
        return false;
    }                 
    
    if($("#cidadeNatal").val()=="" || $("#estadoNatal").val()==""){
        alert("Preencha os campos de naturalidade.");        
        document.cadastro.cidadeNatal.focus();
        return false;
    }                 
        
    
    return true;
}

function valida_etapa_2(){            
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
    if($("#cidade").val()==""){
        alert("Preencha o campo cidade.");        
        document.cadastro.cidade.focus();
        return false;
    }
    if($("#bairro").val()==""){
        alert("Preencha o campo bairro.");        
        document.cadastro.bairro.focus();
        return false;
    }    
    if($("#estado").val()==""){
        alert("Preencha o campo estado.");        
        document.cadastro.estado.focus();
        return false;
    }
    return true;
}

function controla(){          
    //alert(document.getElementById("et").value);
    switch($("#et").val()){        
        case "1":                       
            if(valida_etapa_1()==true){                
                cadastra_endereco_familia();                      
                document.getElementById("et").value='2';//alterar o valor do campo hidden com id #et para 2                                    
                return false;
            }else{
                return false;
            }
        case "2":             
            if(valida_etapa_1()==true && valida_etapa_2()==true){
                if(confirm("Deseja prosseguir para o cadastro socio-econômico")){
                    document.getElementById("et").value='3';                 
                    //redirecionar para pesquisa socio-economica
                }else{//vai persistir no banco os dados até a etapa 2
                    return true;
                }    
            }else{
                return false;
            }
        default:
            return false;
    }
}

function verifica_etapa(){          
    //alert(document.getElementById("et").value);
    if($("#cep").val() != ""){
        cadastra_endereco_familia();
    }    
}

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

// Função única que fará a transação
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
                        $("#cidade").val(unescape(resultadoCEP["cidade"]));                        
                        $("#estado").val(unescape(resultadoCEP["uf"]));
                }else{
                        alert("Endereço não encontrado");
                }
        });				
    }			
}