
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

class VPessoa extends Common {

    function initiateEditor() {                
        if(isset($_GET['id_pessoa'])){
            $this->id_pessoa = $_GET['id_pessoa'];
        }
        //nome,vagas,data_inicio,carga_horaria,pre_requisitos,ter,qui,data_termino
        $tableColumns['id_pessoa'] = array('display_text' => 'Id pessoa', 'perms' => 'QXSHOMI', 'style' => 'text-align:center;font-weight:bold;font-size:16px;white-space:normal;');
        $tableColumns['nome'] = array('display_text' => 'Nome', 'perms' => 'TVQXSHOMI');        
        $tableColumns['grau_parentesco'] = array('display_text' => 'Tipo', 'perms' => 'TVQXSHOMI');
        $tableColumns['ativo'] = array('display_text' => 'Ativo', 'perms' => 'TVQXSHOMI',
        'display_mask' => "IF(ativo = '1','Sim','Não')");
//        $tableColumns['id_familia'] = array('display_text' => 'Id família', 'perms' => 'TVQXSHOMI');        
        $tableColumns['data_cadastro'] = array('display_text' => 'Data Cad.', 'perms' => 'TVQXSHOMI', 'display_mask' => 'date_format(date(`data_cadastro`),"%d/%m/%Y")');
        $tableColumns['last_modified'] = array('display_text' => 'Última modificação', 'perms' => 'TVQXSHOMI', 'display_mask' => 'date_format(`last_modified`,"%d/%m/%Y %H:%i:%s")');
        $tableColumns['data_nascimento'] = array('display_text' => 'Data Nasc.', 'perms' => 'TVQXSHOMI', 'display_mask' => 'date_format(date(`data_nascimento`),"%d/%m/%Y")');        
        $tableColumns['telefone'] = array('display_text' => 'Telefone', 'perms' => 'TVQXSHOMI');
            //'col_header_info' =>'style="text-align:center;font-weight:bold;"');
        $tableColumns['estado_civil'] = array('display_text' => 'Estado Civil', 'perms' => 'TVQXSHOMI');
        $tableColumns['raca'] = array('display_text' => 'Raça', 'perms' => 'TVQXSHOMI');
        $tableColumns['religiao'] = array('display_text' => 'Religião', 'perms' => 'TVQXSHOMI');
        $tableColumns['carteira_profissional'] = array('display_text' => 'Carteira Profissional', 'perms' => 'TVQXSHOMI');
        $tableColumns['titulo_eleitor'] = array('display_text' => 'Título de eleitor', 'perms' => 'TVQXSHOMI');
        $tableColumns['certidao_nascimento'] = array('display_text' => 'Certidão de Nasc.', 'perms' => 'TVQXSHOMI');
        $tableColumns['data_saida'] = array('display_text' => 'Data da inatividade', 'perms' => 'TVQXSHOMI');
        
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
        $tableColumns['cpf'] = array('display_text' => 'CPF', 'perms' => 'TVQXSHOMI');
        $tableColumns['rg'] = array('display_text' => 'RG', 'perms' => 'TVQXSHOMI');
        $tableColumns['sexo'] = array('display_text' => 'Sexo', 'perms' => 'TVQXSHOMI');
        //$tableColumns['cidade_natal'] = array('display_text' => 'Sexo', 'perms' => 'TVQXSHOMI');
        
        $tableName = 'pessoa';
        $primaryCol = 'id_pessoa';
        $errorFun = array(&$this, 'logError');
        $permissions = 'XSQHO';

        $this->Editor = new AjaxTableEditor($tableName, $primaryCol, $errorFun, $permissions, $tableColumns);
        $this->Editor->setConfig('tableInfo', 'cellpadding="3" width="1200" class="mateTable"');
        $this->Editor->setConfig('orderByColumn', 'id_pessoa');
        $this->Editor->setConfig('modifyRowSets', array(&$this, 'changeBgColor'));
        $this->Editor->setConfig('displayNum','10'); 
        /*
        $userIcons[] = array( 
           'icon_html' => '<a onclick="iconAction()"; class="full-person" title="icon-title"></a>'
        ); 
        $this->Editor->setConfig('userIcons',$userIcons); 
        */
        if($this->id_pessoa != '-1')
            $this->Editor->setConfig('sqlFilters',"id_pessoa = '$this->id_pessoa'"); 
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

    private $id_pessoa = '-1';
    //todo construtor que utiliza o plugin mate-2.2 deverá chamar o $this->display();
    function VPessoa() {        
        $this->display();
    }
   
}
//require_once '../bd/Debug.php';
//Debug::alert($_GET['id_pessoa']);

$x = new VPessoa();
?>