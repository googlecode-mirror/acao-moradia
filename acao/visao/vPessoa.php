<?php
/**
* VPessoa.php - o usuário(atendente e admin) poderá visualizar todas as pessoa cadastradas no sistema
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

class VPessoa extends Common {

    function initiateEditor() {                
        if(isset($_GET['id_pessoa'])){
            $this->id_pessoa = $_GET['id_pessoa'];
        }
        //nome,vagas,data_inicio,carga_horaria,pre_requisitos,ter,qui,data_termino
        $tableColumns['id_pessoa'] = array('display_text' => 'Id pessoa', 'perms' => 'QXSHOMI', 'style' => 'text-align:center;font-weight:bold;font-size:16px;white-space:normal;');        
        $tableColumns['nome'] = array('display_text' => 'Nome Completo', 'perms' => 'TVQXSHOMI');
        $tableColumns['grau_parentesco'] = array('display_text' => 'Tipo', 'perms' => 'TVQXSHOMI');
        $tableColumns['ativo'] = array('display_text' => 'Ativo', 'perms' => 'TVQXSHOMI',
        'display_mask' => "IF(ativo = '1','Sim','Não')",  'col_header_info' => 'style="width: 30px;"');
//        $tableColumns['id_familia'] = array('display_text' => 'Id família', 'perms' => 'TVQXSHOMI');        
        $tableColumns['data_cadastro'] = array('display_text' => 'Data Cad.', 'perms' => 'TVQXSHOMI', 'display_mask' => 'date_format(date(`data_cadastro`),"%d/%m/%Y"   )',  'col_header_info' => 'style="width: 50px;"');
        $tableColumns['last_modified'] = array('display_text' => 'Última modificação', 'perms' => 'TVQXSHOMI', 'display_mask' => 'date_format(`last_modified`,"%d/%m/%Y %H:%i:%s")',  'col_header_info' => 'style="width: 90px;"');
        $tableColumns['data_nascimento'] = array('display_text' => 'Data Nasc.', 'perms' => 'TVQXSHOMI', 'display_mask' => 'IF(date_format(date(`data_nascimento`),"%d/%m/%Y")="00/00/0000","",date_format(date(`data_nascimento`),"%d/%m/%Y"))',  'col_header_info' => 'style="width: 50px;"');
        $tableColumns['telefone'] = array('display_text' => 'Telefone', 'perms' => 'TVQXSHOMI',  'col_header_info' => 'style="width: 95px;"');
            //'col_header_info' =>'style="text-align:center;font-weight:bold;"');
        $tableColumns['estado_civil'] = array('display_text' => 'Estado Civil', 'perms' => 'TVQXSHOMI');
        $tableColumns['raca'] = array('display_text' => 'Raça', 'perms' => 'TVQXSHOMI',  'col_header_info' => 'style="width: 60px;"');
        $tableColumns['religiao'] = array('display_text' => 'Religião', 'perms' => 'TVQXSHOMI');
        $tableColumns['carteira_profissional'] = array('display_text' => 'Carteira<br> Profissão', 'perms' => 'TVQXSHOMI',  'col_header_info' => 'style="width: 60px;"');
        $tableColumns['titulo_eleitor'] = array('display_text' => 'Título de eleitor', 'perms' => 'TVQXSHOMI',  'col_header_info' => 'style="width: 90px;"');
        $tableColumns['certidao_nascimento'] = array('display_text' => 'Certidão <br>de Nasc.', 'perms' => 'TVQXSHOMI',  'col_header_info' => 'style="width: 50px;"');
        $tableColumns['data_saida'] = array('display_text' => 'Data da <br>inatividade', 'perms' => 'TVQXSHOMI', 'display_mask' => 'date_format(`data_saida`,"%d/%m/%Y %H:%i:%s")',  'col_header_info' => 'style="width: 90px;"');
        
        $tableColumns['id_familia'] = array( 
            'display_text' => 'ID Familia, Logradouro, Nº, Bairro', 
            'perms' => 'EVCTAXQ', 
            'join' => array( 
                 'table' => 'familia', 
                 'column' => 'id_familia', 
                 'display_mask' => "concat(familia.id_familia,' ', familia.logradouro,', ',familia.numero,', ',familia.bairro)", 
                 'type' => 'left' 
            ) 
        );        
        
//        $tableColumns['cidade_natal'] = array( 
//            'display_text' => 'Cidade Natal', 
//            'perms' => 'EVCTAXQ', 
//            'join' => array( 
//                 'table' => 'cidade', 
//                 'column' => 'cod_cidade', 
//                 'display_mask' => "concat(cidade.nome)", 
//                 'type' => 'left',
//                 'alias' => 'cidade' 
//            ) 
//        );
        $tableColumns['cidade_natal'] = array( 
            'perms' => 'EVCAXQ'              
        );
        
        $userColumns['estado_natal'] = array('call_back_fun' => array(&$this,'getEstados'), 'title' => 'Cidade-Estado<br />Natal');
        
        $tableColumns['cpf'] = array('display_text' => 'CPF', 'perms' => 'TVQXSHOMI',  'col_header_info' => 'style="width: 90px;"');
        $tableColumns['rg'] = array('display_text' => 'RG', 'perms' => 'TVQXSHOMI',  'col_header_info' => 'style="width: 105px;"');
        $tableColumns['sexo'] = array('display_text' => 'Sexo', 'perms' => 'TVQXSHOMI',  'col_header_info' => 'style="width: 30px;"');
        
        $userColumns['programas'] = array('call_back_fun' => array(&$this,'getProgramas'), 'title' => 'Programas Sociais');         
        //$tableColumns['cidade_natal'] = array('display_text' => 'Sexo', 'perms' => 'TVQXSHOMI');
        
        $tableName = 'pessoa';
        $primaryCol = 'id_pessoa';
        $errorFun = array(&$this, 'logError');
        $permissions = 'IXSQHOV';        

        $this->Editor = new AjaxTableEditor($tableName, $primaryCol, $errorFun, $permissions, $tableColumns);
        $this->Editor->setConfig('tableInfo', 'cellpadding="3" width="2500" class="mateTable"');
        $this->Editor->setConfig('orderByColumn', 'id_pessoa');
        $this->Editor->setConfig('modifyRowSets', array(&$this, 'changeBgColor'));
        $this->Editor->setConfig('displayNum','10'); 
        $this->Editor->setConfig('userColumns',$userColumns); 
        $this->Editor->setConfig('tableTitle', 'Listagem de Pessoas');
        $userIcons[] = array( 
            'format_fun' => array(&$this,'edit')            
        ); 
        $this->Editor->setConfig('userIcons',$userIcons); 
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
    
    function edit($info) 
    { 
        $iconHtml = '';
        $numIcons = 0;
        //$iconHtml .= '<li class="viewFull"><a href="javascript: void(0);" onclick="window.location=\'vFamiliaInteira.php?id_familia='.$info['id_familia'].'\';" title="Visualisação completa"></a></li>';        
        $iconHtml .= '<li class="edit"><a href="vEditaPessoa.php?id_pessoa='.$info['id_pessoa'].'" title="Editar Pessoa"></a></li>';
        
        $numIcons++;      
        return array('icon_html' => $iconHtml, 'num_icons' => $numIcons);
    }
    
    function getProgramas($row) 
    {          
        require_once '../bd/PessoaHasProgramaDAO.php';
        $p = new PessoaHasProgramaDAO();
        $res = $p->buscaProgramasById($row['id_pessoa']);
        $programas = '';
        while($programa = mysql_fetch_assoc($res)){            
            $programas.="<li>".$programa['nome']."</li>";
        }
        $html = '<td>'.$programas.'</td>'; 
        return $html; 
    }
    
    function getEstados($row) 
    {   
        $linha="";
        if($row['cidade_natal'] != ""){
            require_once '../bd/CidadeDAO.php';
            require_once '../bd/EstadoDAO.php';
            $c = new CidadeDAO();
            $e = new EstadoDAO();

            $cidade = mysql_fetch_array($c->buscaCidadebyCod($row['cidade_natal']));
            $estado = mysql_fetch_array($e->buscaEstadobyCod($cidade['cod_estado']));
            $linha .= $cidade['nome'].'-'.$estado['sigla'];                                 
        }
        return '<td>'.$linha.'</td>';         ; 
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
        $this->is_logado();
        $this->isVpessoa = TRUE;
        $this->display();
    }
   
}

$x = new VPessoa();
?>