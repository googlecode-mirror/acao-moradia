
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
require_once '../bd/DBConnection.php';

class VCurso extends Common {

    function initiateEditor() {
        //nome,vagas,data_inicio,carga_horaria,pre_requisitos,ter,qui,data_termino
        $tableColumns['id_curso'] = array('display_text' => 'Id curso', 'perms' => 'VQXSHOMI', 'req' => true);
        $tableColumns['nome'] = array('display_text' => 'Nome', 'perms' => 'EVTAXQSHOMI', 'req' => true, 'input_info' => 'maxlength="100"');        
        $tableColumns['data_inicio'] = array('display_text' => 'Data de início', 'perms' => 'EVTAXQSHOM', 'req' => true, 'display_mask' => 'date_format(date(`data_inicio`),"%d/%m/%Y")', 'calendar' => array('format' => '%d/%m/%Y', 'reset' => true));
        $tableColumns['data_termino'] = array('display_text' => 'Data de término', 'perms' => 'EVTAXQSHOM', 'req' => true, 'display_mask' => 'date_format(date(`data_termino`),"%d/%m/%Y")', 'calendar' => array('format' => '%d/%m/%Y', 'reset' => true));

        $tableColumns['carga_horaria'] = array('display_text' => 'Carga<br> horária', 'perms' => 'EVTAXQSHOM');
        $tableColumns['pre_requisitos'] = array('display_text' => 'Pré-requisitos', 'perms' => 'EVTAXQSHOM');

        $tableColumns['seg'] = array('display_text' => 'Seg', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(seg = '0','','<center>X</center>')");
        $tableColumns['ter'] = array('display_text' => 'Ter', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(ter = '0','','<center>X</center>')");
        $tableColumns['qua'] = array('display_text' => 'Qua', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(qua = '0','','<center>X</center>')");
        $tableColumns['qui'] = array('display_text' => 'Qui', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(qui = '0','','<center>X</center>')");
        $tableColumns['sex'] = array('display_text' => 'Sex', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(sex = '0','','<center>X</center>')");
        $tableColumns['sab'] = array('display_text' => 'Sab', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(sab = '0','','<center>X</center>')");
        $tableColumns['dom'] = array('display_text' => 'Dom', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1', 'un_checked_value' => '0'), 'display_mask' => "IF(dom = '0','','<center>X</center>')");
        //$tableColumns['dom'] = array('display_text' => 'Dom', 'perms' => 'EVTAXQSHOM', 'checkbox' => array('checked_value' => '1','un_chec
        //ked_value' => '0'), 'display_mask' => "IF(dom = '0','','<style type=\"text/css\"><!--p {font-weight: bold;font-size:1.4em}--></style><p>S</p>')");
        $tableColumns['vagas'] = array('display_text' => 'Total de <br>Vagas', 'perms' => 'EVTAXQSHOM', 'req' => true, 'val_fun' => array(&$this, 'valVagas'));
        $userColumns[] = array('call_back_fun' => array(&$this,'valVagasDisp'), 'title' => 'Vagas<br>Disponíveis');
        $userColumns[] = array('call_back_fun' => array(&$this,'valListaEspera'), 'title' => 'Lista de <br>espera');
        $tableName = 'curso';
        $primaryCol = 'id_curso';
        $errorFun = array(&$this, 'logError');
        
        if($_SESSION['nivel'] == 'ADMINISTRADOR'){
            $permissions = 'EAVIDXSQHO';
        }else{
            $permissions = 'VIXSQHO';
        }
        
        $this->Editor = new AjaxTableEditor($tableName, $primaryCol, $errorFun, $permissions, $tableColumns);
        $this->Editor->setConfig('tableInfo', 'cellpadding="1" width="780" class="mateTable"');
        $this->Editor->setConfig('orderByColumn', 'nome');
        $this->Editor->setConfig('addRowTitle', 'Adicionar curso');
        $this->Editor->setConfig('editRowTitle', 'Editar curso');
        $this->Editor->setConfig('defaultJsCalFormat', '%B %d, %Y');        
        $this->Editor->setConfig('userColumns',$userColumns); 
        $this->setConfig();       
    }

    function valVagas($col, $val, $info) {
        if (preg_match("/^\d+$/", $val)) {
            return true;
        }
        return false;
    }
    
    function valVagasDisp($row) {         
         $res = mysql_fetch_assoc(mysql_query("select count(*) as ocupadas from curso_has_pessoa where situacao_matricula='MATRICULADO' and id_curso=".$row['id_curso']));
         $html = '<td>'.($row['vagas']-$res['ocupadas']).'</td>'; 
         //$html = '<td>'.($res['ocupadas']).'</td>';          
         return $html; 
        //return mysql_query("select count(*) from curso_has_pessoa where id_curso=".$info['id_curso']);
    }
    
    function valListaEspera($row) {         
         $res = mysql_fetch_assoc(mysql_query("select count(*) as ocupadas from curso_has_pessoa where situacao_matricula='LISTA ESPERA'"));         
         $html = '<td>'.($res['ocupadas']).'</td>';          
         return $html; 
        //return mysql_query("select count(*) from curso_has_pessoa where id_curso=".$info['id_curso']);
    }

    //todo construtor que utiliza o plugin mate-2.2 deverá chamar o $this->display();
    function VCurso() {
        if(!isset($_SESSION))
            session_start();
        if(!isset($_SESSION['nivel'])){
            header("Location: vLogin.php");
        }
        $this->display();
    }

}

$x = new VCurso();
?>