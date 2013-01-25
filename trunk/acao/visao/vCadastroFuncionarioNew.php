
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

require_once('../mate-2.2/Common.php');
require_once('../mate-2.2/php/lang/LangVars-en.php');
require_once('../mate-2.2/php/AjaxTableEditor.php');

class VLogin extends Common {

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

        $tableColumns['usuario'] = array('display_text' => 'Usuário', 'perms' => 'EVTAXQSHOM', 'req' => true, 'input_info' => 'maxlength="50"');
        $tableColumns['senha'] = array('display_text' => 'Senha', 'perms' => 'EVAXQSHOM', 'req' => true, 'mysql_add_fun' => 'PASSWORD', 'mysql_edit_fun' => 'PASSWORD', 'format_input_fun' => array(&$this, 'formatPassword'));
        $tableColumns['nivel'] = array('display_text' => 'N&iacute;vel', 'perms' => 'EVTAXQSHOM', 'select_array' => array('ATENDENTE' => 'ATENDENTE', 'ADMINISTRADOR' => 'ADMINISTRADOR'), 'req' => true);

        $tableName = 'login';
        $primaryCol = 'usuario';
        $errorFun = array(&$this, 'logError');        
        $permissions = 'EACVIDXSQHO';

        $this->Editor = new AjaxTableEditor($tableName, $primaryCol, $errorFun, $permissions, $tableColumns);
        $this->Editor->setConfig('tableInfo', 'cellpadding="1" width="700" class="mateTable"');
        $this->Editor->setConfig('orderByColumn', 'usuario');
        $this->Editor->setConfig('addRowTitle', 'Adicionar login');
        $this->Editor->setConfig('editRowTitle', 'Editar login');
        $this->Editor->setConfig('removeIcons', 'C');
        $this->Editor->setConfig('modifyRowSets', array(&$this, 'changeBgColor'));
        $this->setConfig();
    }

    //colocando o campo password
    function formatPassword($col, $val, $row) {
        return '<input type="password" id="' . $col . '" value="' . $val . '" />';
    }

    function changeBgColor($rowSets, $rowInfo, $rowNum) {
        if ($rowInfo['nivel'] == 'ADMINISTRADOR') {
            $rowSets['bgcolor'] = '#ffffff';
        }else{
            $rowSets['bgcolor'] = '#E8E7E7';
        }
        return $rowSets;
    }

    //todo construtor que utiliza o plugin mate-2.2 deverá chamar o $this->display();
    function VLogin() {
        $this->display();
    }

}

$x = new VLogin();
?>