
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
require_once '../controle/cFuncoes.php';

class VCurso extends Common {

    function initiateEditor() {
        //nome,vagas,data_inicio,carga_horaria,pre_requisitos,ter,qui,data_termino
        $tableColumns['id_curso'] = array('display_text' => 'Id curso', 'perms' => 'VQXSHOMI', 'req' => true);
        $tableColumns['nome'] = array('display_text' => 'Nome', 'perms' => 'EVTAXQSHOMI', 'req' => true, 'input_info' => 'maxlength="100"');
        $tableColumns['vagas'] = array('display_text' => 'Vagas', 'perms' => 'EVTAXQSHOM', 'req' => true, 'val_fun' => array(&$this, 'valVagas'));
        $tableColumns['data_inicio'] = array('display_text' => 'Data de início', 'perms' => 'EVTAXQSHOM', 'req' => true, 'display_mask' => 'date_format(date(`data_inicio`),"%d/%m/%Y")', 'calendar' => array('format' => '%d/%m/%Y', 'reset' => true));
        $tableColumns['data_termino'] = array('display_text' => 'Data de término', 'perms' => 'EVTAXQSHOM', 'req' => true, 'display_mask' => 'date_format(date(`data_termino`),"%d/%m/%Y")', 'calendar' => array('format' => '%d/%m/%Y', 'reset' => true));

        $tableColumns['carga_horaria'] = array('display_text' => 'Carga horária', 'perms' => 'EVTAXQSHOM');
        $tableColumns['pre_requisitos'] = array('display_text' => 'Pré-requisitos', 'perms' => 'EVTAXQSHOM');

        $tableColumns['seg'] = array('display_text' => 'Seg', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(seg = '0','','<center>X</center>')");
        $tableColumns['ter'] = array('display_text' => 'Ter', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(ter = '0','','<center>X</center>')");
        $tableColumns['qua'] = array('display_text' => 'Qua', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(qua = '0','','<center>X</center>')");
        $tableColumns['qui'] = array('display_text' => 'Qui', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(qui = '0','','<center>X</center>')");
        $tableColumns['sex'] = array('display_text' => 'Sex', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(sex = '0','','<center>X</center>')");
        $tableColumns['sab'] = array('display_text' => 'Sab', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(sab = '0','','<center>X</center>')");
        $tableColumns['dom'] = array('display_text' => 'Dom', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(dom = '0','','<center>X</center>')");
        //$tableColumns['dom'] = array('display_text' => 'Dom', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1','un_checked_value' => '0'), 'display_mask' => "IF(dom = '0','','<style type=\"text/css\"><!--p {font-weight: bold;font-size:1.4em}--></style><p>S</p>')");

        $tableName = 'curso';
        $primaryCol = 'id_curso';
        $errorFun = array(&$this, 'logError');
        $permissions = 'EAVIDXSQHO';

        $this->Editor = new AjaxTableEditor($tableName, $primaryCol, $errorFun, $permissions, $tableColumns);
        $this->Editor->setConfig('tableInfo', 'cellpadding="1" width="780" class="mateTable"');
        $this->Editor->setConfig('orderByColumn', 'nome');
        $this->Editor->setConfig('addRowTitle', 'Adicionar curso');
        $this->Editor->setConfig('editRowTitle', 'Editar curso');
        $this->Editor->setConfig('defaultJsCalFormat', '%B %d, %Y');
    }

    function valVagas($col, $val, $info) {
        if (preg_match("/^\d+$/", $val)) {
            return true;
        }
        return false;
    }

    //todo construtor que utiliza o plugin mate-2.2 deverá chamar o $this->display();
    function VCurso() {
        $this->display();
    }

}

$x = new VCurso();
?>