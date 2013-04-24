
<?php
/**
 * Arquivo Utilizado por realizar CRUD(Create, Read, Update, Delete) em Programa.
 * Foi utilizado o plugin MySQL Ajax Table Editor para agilizar o desenvolvimento.
 */

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

require_once('../mate-2.2/Common.php');
require_once('../mate-2.2/php/lang/LangVars-en.php');
require_once('../mate-2.2/php/AjaxTableEditor.php');

class VCadastroPrograma extends Common {
        
    function initiateEditor() {
        /*
          $tableColumns['id'] = array('display_text' => 'ID', 'perms' => 'TVQSXO');
          $tableColumns['first_name'] = array('display_text' => 'First Name', 'perms' => 'EVCTAXQSHO');
          $tableColumns['last_name'] = array('display_text' => 'Last Name', 'perms' => 'EVCTAXQSHO');
          $tableColumns['email'] = array('display_text' => 'Email', 'perms' => 'EVCTAXQSHO');
          $tableColumns['department'] = array('display_text' => 'Department', 'perms' => 'EVCTAXQSHO', 'select_array' => array('Accounting' => 'Accounting', 'Marketing' => 'Marketing', 'Sales' => 'Sales', 'Production' => 'Production'));
          $tableColumns['hire_date'] = array('display_text' => 'Hire Date', 'perms' => 'EVCTAXQSHO', 'display_mask' => 'date_format(hire_date,"%d %M %Y")', 'calendar' => '%d %B %Y','col_header_info' => 'style="width: 250px;"');

          $tableName = 'employees';
          $primaryCol = 'id';
          $errorFun = array(&$this,'logError');
          $permissions = 'EAVIDQCSXHO';

          $this->Editor = new AjaxTableEditor($tableName,$primaryCol,$errorFun,$permissions,$tableColumns);
          $this->Editor->setConfig('tableInfo','cellpadding="1" width="1000" class="mateTable"');
          $this->Editor->setConfig('orderByColumn','first_name');
          $this->Editor->setConfig('addRowTitle','Add Employee');
          $this->Editor->setConfig('editRowTitle','Edit Employee');
          //$this->Editor->setConfig('iconTitle','Edit Employee');
         */

        $tableColumns['id_programa'] = array('display_text' => 'ID Programa', 'perms' => 'DVTXQSHOM');
        $tableColumns['nome'] = array('display_text' => 'Nome do Programa Social', 'perms' => 'EVTAXQSHOM', 'req' => true, 'input_info' => 'size="40" maxlength="100"');        
        $userColumns[] = array('call_back_fun' => array(&$this,'preencherNroPessoas'), 'title' => 'Nº de pessoas participantes');
        $tableName = 'programa';
        $primaryCol = 'id_programa';
        $errorFun = array(&$this, 'logError');
        if($_SESSION['nivel'] == 'ADMINISTRADOR'){
            $permissions = 'EAVIDXSQHO';
        }else{
            $permissions = 'VIXSQHO';
        }        

        $this->Editor = new AjaxTableEditor($tableName, $primaryCol, $errorFun, $permissions, $tableColumns);
        $this->Editor->setConfig('tableInfo', 'cellpadding="1" width="700" class="mateTable"');
        $this->Editor->setConfig('orderByColumn', 'nome');
        $this->Editor->setConfig('addRowTitle', 'Adicionar Programa Social');
        $this->Editor->setConfig('editRowTitle', 'Editar Programa Social');        
        $this->Editor->setConfig('removeIcons','C');  
        $this->Editor->setConfig('tableTitle','Cadastro de Programas Sociais');
        $this->Editor->setConfig('userColumns',$userColumns); 

    }

    //colocando o campo password
    function formatPassword($col, $val, $row) {
        return '<input type="password" id="' . $col . '" value="' . $val . '" />';
    }
    
    function preencherNroPessoas($row) {
        $res = mysql_fetch_assoc(mysql_query("SELECT COUNT( * ) AS ocupadas
            FROM pessoa_has_programa
            WHERE id_programa =".$row['id_programa'].
            " AND id_pessoa
            IN (
            SELECT id_pessoa
            FROM pessoa
            WHERE ativo = 
            TRUE
            )"));
        $html = '<td>'.($res['ocupadas']).'</td>';
        return $html;
    }

    //todo construtor que utiliza o plugin mate-2.2 deverá chamar o $this->display();
    function VCadastroPrograma() {
        if(!isset($_SESSION))
            session_start();
        if(!isset($_SESSION['nivel'])){
            header("Location: vLogin.php");
        }
        $this->display();
    }
}
$x = new VCadastroPrograma();
?>