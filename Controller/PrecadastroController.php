<?php

require_once '../DAO/PrecadastroDAO.php';
    
class PrecadastroController {
    public function ListarTipoAnimal(){
        $objdao = new PrecadastroDAO();
        return $objdao->ListarTipoAnimal();
    }
    
    public function ListarPorteAnimal(){
        $objdao = new PrecadastroDAO();
        return $objdao->ListarPorteAnimal();
    }
    
    public function FiltrarCidade($cod_estado){
        $objdao = new PrecadastroDAO();
        return $objdao->FiltrarCidade($cod_estado);
    }
}
