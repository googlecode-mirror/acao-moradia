<?php
    include_once 'DBConnection.php';
    DataBase::createConection();
    class CursoDAO{
        
        private $_ins= "INSERT INTO `curso`(`nome`, `vagas`, `data_inicio`, `carga_horaria`, `pre_requisitos`, `dias_semana`, `data_termino`) VALUES";
        private $_rem= "DELETE FROM curso WHERE `nome`= ";
        //private $_alt= "UPDATE curso set";
        //private $_sel= "SELECT * FROM curso";
        
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
    }
?>