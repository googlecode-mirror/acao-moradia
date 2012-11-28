<?php    
    include_once '../bd/ProgramaDAO.php';
    class CPrograma{                                     
        private $_programaDAO;
                
        public function buscaTodosProgramas()
        {
            $this->_programaDAO = new ProgramaDAO();
            return $this->_programaDAO->buscaTodosProgramas();
        }
    }

?>
