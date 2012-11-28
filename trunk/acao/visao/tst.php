<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="pt-BR">
	<head>
    	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    	<meta name="author" content="Filipe Tagliatti - www.criandowebsite.com" />
        <meta name="robots" content="noindex,nofollow" />
	
		<title>Mascaras em Javascript com Masked Input</title>
        
        <script src="jquery.js" type="text/javascript"></script>
        <script src="jquery.maskedinput.js" type="text/javascript"></script>

		<style type="text/css">
		<!--
            div {
                width: 310px;
                margin: 0 auto;
            }
            label {
                float: left;
                margin: 0 0 5px 0;
            }
            input {
                float: right;
            }
            .clear {
                clear: both;
            }
		-->
		</style>
		
        <script>
        	jQuery(function(){
        	    jQuery("#cpf").mask("999.999.999-99");
        		jQuery("#cpf-sem-underline").mask("999.999.999-99", {placeholder:" "});
                jQuery("#nascimento").mask("99/99/9999");
                jQuery("#placa").mask("aaa-9999");
                jQuery("#cep").mask("99999-999");
                jQuery("#cnpj").mask("99.999.999/9999-99");
                jQuery("#telefone").mask("(99) 9999-9999?9");
                jQuery("#fax").mask("(99) 9999-9999");
                jQuery("#inscricao-estadual").mask("999.999.999.999");
        	});
        </script>
	</head>
	<body>
        <div>
            <label>CPF </label><input type="text" name="cpf" id="cpf" /> <br class="clear" />
            <label>CPF (sem underline(_))</label><input type="text" name="cpf-sem-underline" id="cpf-sem-underline" /> <br class="clear" />
            <label>Data de Nascimento </label><input type="text" name="nascimento" id="nascimento" /> <br class="clear" />
            <label>Placa (auto movel) </label><input type="text" name="placa" id="placa" /> <br class="clear" />
            <label>CEP </label><input type="text" name="cep" id="cep" /> <br class="clear" />
            <label>CNPJ </label><input type="text" name="cnpj" id="cnpj" /> <br class="clear" />
            <label>Telefone </label><input type="text" name="telefone" id="telefone" /> <br class="clear" />
            <label>FAX </label><input type="text" name="fax" id="fax" /> <br class="clear" />
            <label>Inscricao Estadual </label><input type="text" name="inscricao-estadual" id="inscricao-estadual" /> <br class="clear" />
        </div>	
	</body>
</html>