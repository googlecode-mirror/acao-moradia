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
require_once '../bd/bd.php';
class Common
{		
	// Mysql Variables
	var $mysqlUser = 'root';
	var $mysqlDb = 'acao_moradia';
	var $mysqlHost = 'localhost';
	var $mysqlDbPass = '';
	
	var $langVars;
	var $dbc;
	
        var $Editor;
        
	function mysqlConnect()
	{	
                $senha = new Senha();
                $this->mysqlDbPass = $senha->getSenha();
		if($this->dbc = mysql_connect($this->mysqlHost, $this->mysqlUser, $this->mysqlDbPass)) 
		{				
			mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");			
			if(!mysql_select_db ($this->mysqlDb))
			{
				$this->logError(sprintf($this->langVars->errNoSelect,$this->mysqlDb),__FILE__, __LINE__);
			}
		}
		else
		{
			$this->logError($this->langVars->errNoConnect,__FILE__, __LINE__);
		}						
	}
	
	function logError($message, $file, $line)
	{
		$message = sprintf($this->langVars->errInScript,$file,$line,$message);
		var_dump($message);
		die;
	}


	function displayHeaderHtml()
	{
		?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>	
                <title>Ação Moradia</title>                        
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">                                                
                        <link rel="shortcut icon" href="../imagens/favicon.ico" />
                        <link href="../css/stylesNew.css" rel="stylesheet" type="text/css" />
                        <link href="../css/button.css" rel="stylesheet" type="text/css" />                                                                        
                        
			<link href="../mate-2.2/css/table_styles.css" rel="stylesheet" type="text/css" />
			<link href="../mate-2.2/css/icon_styles.css" rel="stylesheet" type="text/css" />
						                                                
                        <script type="text/javascript" src="../mate-2.2/js/prototype.js"></script>
			<script type="text/javascript" src="../mate-2.2/js/scriptaculous-js/scriptaculous.js"></script>
			<script type="text/javascript" src="../mate-2.2/js/lang/lang_vars-en.js"></script>
			<script type="text/javascript" src="../mate-2.2/js/ajax_table_editor.js"></script>
			
			<!-- calendar files -->
			<link rel="stylesheet" type="text/css" media="all" href="../mate-2.2/js/jscalendar/skins/aqua/theme.css" title="win2k-cold-1" /> 
			<script type="text/javascript" src="../mate-2.2/js/jscalendar/calendar.js"></script>
			<script type="text/javascript" src="../mate-2.2/js/jscalendar/lang/calendar-en.js"></script>
			<script type="text/javascript" src="../mate-2.2/js/jscalendar/calendar-setup.js"></script>
                        
            
                                                                                                                                                                                                                     
		</head>	
		<body>                
    
		<?php
	}	
	
        function setConfig(){
            $this->Editor->setConfig('iconTitle','Ações'); 
        }
        function displayHtml() {            
        ?>	                    
        <div class="wrap">
            <?php
            require("../visao/vLayoutBody.php");
            ?>
            <div class="content">
                <?php
                require("../visao/vLayoutMargin.php");
                ?>              
				<br /><br /><br />
                <div class="bloco" style="border: #b1b1b1 solid 2px;">
                    <div align="left" style="position: relative;"><div id="ajaxLoader1"><img src="../mate-2.2/images/ajax_loader.gif" alt="Loading..." /></div></div>
                    
                    <div id="historyButtonsLayer" align="left">
                    </div>

                    <div id="historyContainer">
                        <div id="information">
                        </div>

                        <div id="titleLayer" style="font-weight: bold; font-size: 25px; text-align: center; color: blue; font-family: serif">
                        </div>

                        <div id="tableLayer" align="center">
                        </div>

                        <div id="recordLayer" align="center">
                        </div>		

                        <div id="searchButtonsLayer" align="center">
                        </div>
                    </div>

                    <script type="text/javascript">
                        trackHistory = false;
                        var ajaxUrl = '<?php 
                        $ajaxUrl = $_SERVER['PHP_SELF'];
                        if(count($_GET) > 0)
                        {
                           $queryStrArr = array();
                           foreach($_GET as $var => $val)
                           {
                              $queryStrArr[] = $var.'='.urlencode($val);
                           }
                           $ajaxUrl .= '?'.implode('&',$queryStrArr);
                        }
                        echo $ajaxUrl;
                        ?>';
                        toAjaxTableEditor('update_html','');
                    </script>                    
                </div>                          
            </div>
        </div>

        <?php
    }
        
    function displayFooterHtml()
    {
            ?>
            </body>
            <footer>
                <?php
                    require("../visao/vLayoutFooter.php");
                ?>  
            </footer>
            </html>
            <?php
    }	
    
    function display()    
    {                        
        if (isset($_POST['json'])) {            
            // Initiating lang vars here is only necessary for the logError, and mysqlConnect functions in Common.php. 
            // If you are not using Common.php or you are using your own functions you can remove the following line of code.
            $this->langVars = new LangVars();
            $this->mysqlConnect();
            if (ini_get('magic_quotes_gpc')) {
                $_POST['json'] = stripslashes($_POST['json']);
            }
            if (function_exists('json_decode')) {
                $data = json_decode($_POST['json']);
            } else {
                require_once('../mate-2.2/php/JSON.php');
                $js = new Services_JSON();
                $data = $js->decode($_POST['json']);
            }
            if (empty($data->info) && strlen(trim($data->info)) == 0) {
                $data->info = '';
            }
            $this->initiateEditor();
            $this->Editor->main($data->action, $data->info);
            if (function_exists('json_encode')) {
                echo json_encode($this->Editor->retArr);
            } else {
                echo $js->encode($this->Editor->retArr);
            }
        } else if (isset($_GET['export'])) {            
            ob_start();
            $this->mysqlConnect();
            $this->initiateEditor();
            echo $this->Editor->exportInfo();
            header("Cache-Control: no-cache, must-revalidate");
            header("Pragma: no-cache");
            header("Content-type: application/x-msexcel");
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $this->Editor->tableName . '.csv"');
            exit();
        } else {            
            $this->displayHeaderHtml();            
            $this->displayHtml();
            $this->displayFooterHtml();
        }    
    }
    
    /**
     * Verifica se o usuário está logado no sistema
     */
    function is_logado(){
        session_start();
        if(!isset($_SESSION['nivel'])){
            header('Location: ../visao/vLogin.php');
        }
    }

}
?>
