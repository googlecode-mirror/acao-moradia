
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

class VFamilia extends Common {
    
    function initiateEditor() {        
        $tableColumns['id_familia'] = array('display_text' => 'ID', 'perms' => 'VTXQSHOM');
        $userColumns[] = array('call_back_fun' => array(&$this,'getTitular'), 'title' => 'Titular');
        $tableColumns['cep'] = array('display_text' => 'CEP', 'perms' => 'VTXQSHOM');
        $tableColumns['logradouro'] = array('display_text' => 'Logradouro', 'perms' => 'VTXQSHOM');
        $tableColumns['numero'] = array('display_text' => 'Nº', 'perms' => 'VTXQSHOM');
        
        $tableColumns['cod_cidade'] = array( 
            'display_text' => 'Cidade',
            'perms' => 'EVCTAXQ',
            'join' => array(
                 'table' => 'cidade',
                 'column' => 'cod_cidade',
                 'display_mask' => 'concat(cidade.nome)',
                 'type' => 'left'
            ),                        
        );       
        
        
        $tableName = 'familia';
        $primaryCol = 'id_familia';
        $errorFun = array(&$this, 'logError');        
        $permissions = 'VIDXSQHO';

        $this->Editor = new AjaxTableEditor($tableName, $primaryCol, $errorFun, $permissions, $tableColumns);
        $this->Editor->setConfig('tableInfo', 'cellpadding="1" width="800" class="mateTable"');
        $this->Editor->setConfig('orderByColumn', 'id_familia');        
        $this->Editor->setConfig('removeIcons', 'CD');        
        $this->Editor->setConfig('modifyRowSets', array(&$this, 'changeBgColor'));
        $this->Editor->setConfig('userColumns',$userColumns); 
//        $userIcons[] = array( 
//            'icon_html' => 
//            '<li class="viewFull">
//                <a title="Visualização completa"></a>
//            </li>',
//            'class' => 'viewFull', 
//            'call_back_fun' => array(&$this,'viewFull'),
//            'title' => 'Visualização completa', 
//        ); 
        $userIcons[] = array( 
            'format_fun' => array(&$this,'viewFull')            
        ); 
        $this->Editor->setConfig('userIcons',$userIcons); 
        $this->Editor->setConfig('displayNum','8'); 
        $this->setConfig();
    }     
    
    function viewFull($info) 
    { 
        $iconHtml = '';
        $numIcons = 0;
        //$iconHtml .= '<li class="viewFull"><a href="javascript: void(0);" onclick="window.location=\'vFamiliaInteira.php?id_familia='.$info['id_familia'].'\';" title="Visualisação completa"></a></li>';        
        $iconHtml .= '<li class="viewFull"><a href="vFamiliaInteira.php?id_familia='.$info['id_familia'].'" title="Visualisação completa"></a></li>';
        
        $numIcons++;      
        return array('icon_html' => $iconHtml, 'num_icons' => $numIcons);
    } 
    
    function getTitular($row) {         
         $res = mysql_fetch_assoc(mysql_query("select p.nome from pessoa p, familia f where f.id_familia=$row[id_familia] and f.id_familia = p.id_familia and p.grau_parentesco='TITULAR'"));
         $html = '<td>'.$res['nome'].'</td>'; 
         return $html; 
        //return mysql_query("select count(*) from curso_has_pessoa where id_curso=".$info['id_curso']);
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
    function VFamilia() { 
        session_start();
        $_SESSION['botao'] = 'cadastrar_familia';        
        $this->display();  
        $_SESSION['botao'] ='';
    }

}

$x = new VFamilia();
?>