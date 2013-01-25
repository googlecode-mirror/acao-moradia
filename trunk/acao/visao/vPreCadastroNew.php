
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

class VCurso extends Common {

    function initiateEditor() {
        
        //nome,vagas,data_inicio,carga_horaria,pre_requisitos,ter,qui,data_termino
        $tableColumns['id_pessoa'] = array('display_text' => 'Id pessoa', 'perms' => 'QXSHOMI', 'style' => 'text-align:center;font-weight:bold;font-size:16px;white-space:normal;');
        $tableColumns['nome'] = array('display_text' => 'Nome', 'perms' => 'TVQXSHOMI');
//        $tableColumns['id_familia'] = array('display_text' => 'Id família', 'perms' => 'TVQXSHOMI');
        $tableColumns['cpf'] = array('display_text' => 'CPF', 'perms' => 'TVQXSHOMI');
        $tableColumns['data_cadastro'] = array('display_text' => 'Data Cadastro', 'perms' => 'TVQXSHOMI', 'display_mask' => 'date_format(date(`data_cadastro`),"%d/%m/%Y")');
        $tableColumns['data_nascimento'] = array('display_text' => 'Data Nascimento', 'perms' => 'TVQXSHOMI', 'display_mask' => 'date_format(date(`data_nascimento`),"%d/%m/%Y")');
        $tableColumns['rg'] = array('display_text' => 'RG', 'perms' => 'TVQXSHOMI');
        $tableColumns['telefone'] = array('display_text' => 'Tel', 'perms' => 'TVQXSHOMI');
            //'col_header_info' =>'style="text-align:center;font-weight:bold;"');
        $tableColumns['estado_civil'] = array('display_text' => 'Estado Civil', 'perms' => 'TVQXSHOMI');
  
        
        $tableColumns['id_familia'] = array( 
            'display_text' => 'ID Familia, Logradouro, Nº', 
            'perms' => 'EVCTAXQ', 
            'join' => array( 
                 'table' => 'familia', 
                 'column' => 'id_familia', 
                 'display_mask' => "concat(familia.id_familia,' ', familia.logradouro,', ',familia.numero)", 
                 'type' => 'left' 
            ) 
        );
        
        $tableName = 'pessoa';
        $primaryCol = 'id_pessoa';
        $errorFun = array(&$this, 'logError');
        $permissions = 'XSQHO';

        $this->Editor = new AjaxTableEditor($tableName, $primaryCol, $errorFun, $permissions, $tableColumns);
        $this->Editor->setConfig('tableInfo', 'cellpadding="3" width="950" class="mateTable"');
        $this->Editor->setConfig('orderByColumn', 'id_pessoa');
        $this->Editor->setConfig('modifyRowSets', array(&$this, 'changeBgColor'));
        /*
        $userIcons[] = array( 
           'icon_html' => '<a onclick="iconAction()"; class="full-person" title="icon-title"></a>'
        ); 
        $this->Editor->setConfig('userIcons',$userIcons); 
        */
        $this->setConfig();
    }
    private $cor1 = '#ffffff';  //branco
    private $cor2 = '#E8E7E7';  //cinza
    private $ultimo_id = -1;
    private $ultima_cor = '#ffffff';           
    
    function changeBgColor($rowSets, $rowInfo, $rowNum) {
        if ($this->ultimo_id == -1) {
            $rowSets['bgcolor'] = $this->ultima_cor;
            $this->ultimo_id = $rowInfo['id_familia'];
        }else{
            if($this->ultimo_id != $rowInfo['id_familia']){
                if($this->ultima_cor == $this->cor1){                    
                    $this->ultima_cor = $this->cor2;
                }else{
                    $this->ultima_cor = $this->cor1;
                }                
                $this->ultimo_id = $rowInfo['id_familia'];
            }
            $rowSets['bgcolor'] = $this->ultima_cor;            
        }
        return $rowSets;
    }


    //todo construtor que utiliza o plugin mate-2.2 deverá chamar o $this->display();
    function VCurso() {
        $this->display();
    }

}

$x = new VCurso();
?>