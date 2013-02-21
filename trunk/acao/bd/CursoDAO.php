<?php
    include_once 'DBConnection.php';
    DataBase::createConection();
    class CursoDAO{
        
        private $_ins= "INSERT INTO `curso`(`nome`, `vagas`, `data_inicio`, `carga_horaria`, `pre_requisitos`, `dias_semana`, `data_termino`) VALUES";
        private $_rem= "DELETE FROM curso WHERE `nome`= ";
        //private $_alt= "UPDATE curso set";
        private $_sel= "SELECT * FROM curso";
        
        public function cadastraCurso($nome, $vagas, $dataInicio, $cargaHoraria, $preRequisitos, $diasSemana, $dataTermino){
            $this->_ins.= " ('$nome', '$vagas', '$dataInicio', '$cargaHoraria', '$preRequisitos', '$diasSemana', '$dataTermino')";
            $_res= mysql_query($this->_ins);
            if($_res != TRUE){
                echo "falha ao cadastrar";
                }
                else{
                    echo "Cadastrado com sucesso!";
                
            }
            return $_res;
        }
        
        public function cadastraCurso2($curso) {
            return $this->cadastraCurso($curso->getNome(), $curso->getVagas(), $curso->getDataInicio(), $curso->getCargaHoraria(), $curso->getPreRequisitos(), $curso->getDiasSemana(), $curso->getDataTermino());
        }
         
        public function deletaCurso($nome) {
            $this->_ins.= " ('$nome')";
            $res= mysql_query($this->ins);
            if($_res != TRUE){
                echo "falha ao cadastrar";
                }
                else{
                    echo "Cadastrado com sucesso!";
                
            }
            return $_res;            
        }
        
        public function deletaCurso2($curso) {
            return $this->deletaCurso($curso->getNome());
        }
        
        public function buscaDados($idCurso){ 
             $select = "SELECT   IF(c.seg = '0','','SEG ') as seg, 
                    IF(c.ter = '0','','TER ') as ter, 
                    IF(c.qua = '0','','QUA ') as qua, 
                    IF(c.qui = '0','','QUI ') as qui, 
                    IF(c.sex = '0','','SEX ') as sex, 
                    IF(c.sab = '0','','SAB ') as sab, 
                    IF(c.dom = '0','','DOM ') as dom,                           
                    c.nome,
                    c.vagas,
                    c.data_inicio,
                    c.carga_horaria,
                    c.data_termino,
                    c.pre_requisitos
            FROM curso c 
            WHERE c.id_curso=$idCurso";
             
            $res= mysql_query($select);
            if($res != TRUE){
                echo "falha na operação";                                
            }else{
                return mysql_fetch_assoc($res);
            }
        }
    }
?>