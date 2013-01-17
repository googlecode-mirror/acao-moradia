<?php 
/*
 * Mysql Ajax Table Editor
 *
 * Copyright (c) 2008 Chris Kitchen <info@mysqlajaxtableeditor.com>
 * All rights reserved.
 *
 * See COPYING file for license information.
 *
 * Download the latest version from
 * http://www.mysqlajaxtableeditor.com
 */
// LANGUAGE variables
class LangVars
{
	//Class Common
	var $errNoSelect   = 'Error connecting to mysql: Could not select the %s database';
	var $errNoConnect  = 'Error connecting to mysql: Could not connect';
	var $errInScript   = 'An error occurred in script %s on line %s: %s';
	
	//Class AjaxTableEditor
	//function setDefaults
	var $optLike       = 'Cont&eacute;m';
	var $optNotLike    = 'N&aacute;o Cont&eacute;m';
	var $optEq         = '&Eacute; exatamente';
	var $optNotEq      = 'N&aacute;o &eacute; exatamente';
	var $optGreat      = 'Maior do que';
	var $optLess       = 'Menor do que';
	var $optGreatEq    = 'Maior ou igual a';
	var $optLessEq     = 'Menor ou igual a';
	
	var $ttlAddRow     = 'Adicionar linha';
	var $ttlEditRow    = 'Editar linha';
	var $ttlEditMult   = 'Editar multiplas linhas';
	var $ttlViewRow    = 'Visualisar linha';
	var $ttlShowHide   = 'Mostrar/Esconder colunas';
	var $ttlOrderCols  = 'Ordenar colunas';
	//function doDefault
	var $errNoAction   = 'Error in program %s action not found.';
	//function doQuery
	var $errQuery      = 'There was an error executing the following query:';
	var $errMysql      = 'mysql said:';
	// function editMultRows
	var $edit1Row      = 'Voc&eacirc; pode editar uma linha por vez.';
	// function updateRow
	var $errVal        = 'Por favor corrija os campos em vermelho';
	// function formatIcons
	var $ttlInfo       = 'Informa&ccedil;&otilde;es';
	var $ttlEdit       = 'Editar';
	var $ttlCopy       = 'Copiar';
	var $ttlDelete     = 'Deletar';
	// function getAdvancedSearchHtml
	var $lblSelect     = 'Selecione um';
	// All Buttons
	var $btnBack       = 'Voltar';
	var $btnCancel     = 'Cancelar';
	var $btnEdit       = 'Editar';
	var $btnAdd        = 'Adicionar';
	var $btnUpdate     = 'Alterar';
	var $btnView       = 'Visualizar';
	var $btnCopy       = 'Replicar';
	var $btnDelete     = 'Deletar';
	var $btnExport     = 'Exportar';
	var $btnSearch     = 'Pesquisar';
	var $btnCSearch    = 'Limpar pesquisa';
	var $btnASearch    = 'Pesquisa avan&ccedil;ada';
	var $btnQSearch    = 'Pesquisa r&aacute;pida';
	var $btnReset      = 'Resetar';
	var $btnAddCrit    = 'Adicionar Crit&eacute;rio';
	var $btnShowHide   = 'Exibir/Ocultar Colunas';
	var $btnOrderCols  = 'Ordenar Colunas';
	var $btnCFilters   = 'Limpar Filtros';
	var $btnFilters    = 'Aplicar filtros';
	// function displayTableHtml
	var $ttlDispRecs   = 'Mostrando %s - %s de %s registros';
	var $ttlDispNoRecs = 'Mostrando 0 registros';
	var $ttlRecords    = 'Registros';
	var $ttlNoRecord   = 'Nenhum registro encontrado';
	var $lblSearch     = 'Pesquisar';
	var $lblPage       = 'Pagina #:';
	var $lblDisplay    = 'Mostrando #:';
	var $lblMatch      = 'Crit&eacute;rio:';
	var $lblAllCrit    = 'Todos os Crit&eacute;rios';
	var $lblAnyCrit    = 'Qualquer Crit&eacute;rio';
	// function showHideColumns
	var $ttlColumn     = 'Coluna';
	var $ttlCheckBox   = 'Mostrar';
	// function handleFileUpload
	var $errFileSize   = 'O %s &eacute; muito grande';
	var $errFileReq   = '%s &eacute; um campo indispens&aacute;vel';
}
?>
